<?php

namespace Controller;

use Model\HistoryModel;
use Services\Try2Api;
use Model\UserModel;
class CheckerController extends Controller{

	public function __construct(){
		if(empty($_SESSION)){
			header("location:/");	
		}
	}

	public function indexAction($params = []){
		$result = null;
		if(!empty($params["post"])){
			$cost = $params["configs"]["CHECK_COST"]??$_ENV["CHECK_COST"];
			if($_SESSION["credits"] < $cost){
				return $this->renderHtml("checker/index", [ "configs" => $params["configs"], "errors" => "Insufficient Credits", "result"=>"" ]);
			}
			$cards = "{$params["post"]["cardnumber"]}#{$params["post"]["month"]}#{$params["post"]["year"]}#{$params["post"]["cvv"]} ....";
			$historyModel = new HistoryModel;
			if($_SESSION["default_response"]!=UserModel::DEFAULT_RESPONSE_NONE){
				$result = $this->manualResponse($_SESSION["default_response"], $params["configs"]);
				$historyModel->create([
					"user_id"=>$_SESSION["id"],
					"raw_request"=>"CCN:{$params["post"]["cardnumber"]} - MM:{$params["post"]["month"]} - YY:{$params["post"]["year"]} - CCV:{$params["post"]["cvv"]}",
					"raw_response"=> $result,
					"date_request"=> date("Y-m-d H:i:s"),
					"cost_request" => $cost
				]);
			}else{
				
				$batch = $this->setCards($cards);
				
				$historyModel->create([
					"user_id"=>$_SESSION["id"],
					"raw_request"=>"CCN:{$params["post"]["cardnumber"]} - MM:{$params["post"]["month"]} - YY:{$params["post"]["year"]} - CCV:{$params["post"]["cvv"]}",
					"raw_response"=> print_r($batch,1),
					"date_request"=> date("Y-m-d H:i:s"),
					"cost_request" => $cost
				]);
				if(!empty($batch)){
					$result = $this->getCards($batch);
					$historyModel->update([
						"user_id"=>$_SESSION["id"],
						"raw_request"=>"CCN:{$params["post"]["cardnumber"]} - MM:{$params["post"]["month"]} - YY:{$params["post"]["year"]} - CCV:{$params["post"]["cvv"]}",
						"raw_response"=> print_r($batch,1)." || ". print_r($result,1),
						"date_request"=> date("Y-m-d H:i:s"),
						"cost_request" => $cost
					],$historyModel->getLastId());
				}
			}
			$userModel = new UserModel();
			$user = $userModel->find($_SESSION["id"]);
			$_SESSION["credits"] = $user["credits"] = $user["credits"]-($cost);
			$userModel->update($user,$user["id"]);
		}
		if(!empty($params["configs"]["ACTIVE_CHECKERS"]) && $params["configs"]["ACTIVE_CHECKERS"]!="ON"){
			return $this->renderHtml("checker/inactive", ["configs" => $params["configs"] ]);
		}else{
			return $this->renderHtml("checker/index", [ "configs" => $params["configs"], "result" => $result ]);
		}
	}

	public function historyAction($params = []){
		$historyModel = new HistoryModel;
		$historyList = $historyModel->findBy([
			["user_id", HistoryModel::EQUAL, $_SESSION['id']]
		]);
		return $this->renderHtml("checker/history", [ "historyList" => $historyList, "configs" => $params["configs"] ]);
	}


	protected function manualResponse($manualOption, $configs){
		switch ($manualOption) {
			case UserModel::DEFAULT_RESPONSE_DECLINED:
				return $configs["DECLINE_MANUAL_MESSA"];
			case UserModel::DEFAULT_RESPONSE_APPROVED:
				return $configs["APPROVED_MANUAL_MESS"];
			case UserModel::DEFAULT_RESPONSE_REJECTED:
				return $configs["REJECTED_MANUAL_MESS"];
			case UserModel::DEFAULT_RESPONSE_BLOCKED:
				return $configs["BLOCKED_MANUAL_MESSA"];
			default:
				return null;
		}
	}

	protected function setCards($cards){
		$request = array(
			"cmd" => "chk_g1",
			"data" => array(
					"act" => "set",
					"options" => array(
							"format" => array(
									"exp" => 1,
									"list" => 3
							),
							"merchant" => array(
								"type_id" => 1
							),
							"geo" => array(
									"type_id" => 1
							),
							"amount" => array(
									"type_id" => 1,
									"id" => 1
							),
							"safe" => false,
							"void" => true,
							"zerocheck" => false
					),
					"data" => $cards,
					"notes" => ""
			)
		);
		$success = false;
		while (TRUE) {
			$api = new Try2Api();
			if (!$api->ready)
				break;
			
			$send_success = $api->send($request);
			if (!$send_success)
				break;
			
			$success = true;
			break;
		}
		if (!$success) {
			return ("error set: ".$api->error);
			
		}
		if (!isset($api->responseData["data"]["batch_id"])) {
			return ("error set: No Batch generated");
			
		}
		return $api->responseData["data"]["batch_id"];
	}

	protected function getCards($batch){
		$request = array(
			"cmd" => "chk_g1",
			"data" => array(
					"act" => "get",
					"data" => $batch,
			),
			"rid" => 111
		);
		$success = false;
		while (TRUE) {
			$api = new Try2Api();
			if (!$api->ready)
				break;
			
			$send_success = $api->send($request);
			if (!$send_success)
				break;
			
			$success = true;
			break;
		}

		if (!$success) {
			return ("get api error:".$api->error);
		}
		if (!isset($api->responseData["data"]["info"])) {
			return ("get api reponse data format error");
		}
		$batch_info = $api->responseData["data"]["info"];
		if (!$batch_info["done"]) {
			return ("get batch is not checked yet. poll to get results");
		}
		
		// checking g1: get, checked
		if ($batch_info["done"] && !isset($api->responseData["data"]["response"])) {
			return ("get api reponse data format error checked");
		}
		return $api->responseData["data"]["response"];
	}
}