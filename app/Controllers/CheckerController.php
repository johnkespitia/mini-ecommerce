<?php

namespace Controller;

use Model\HistoryModel;
use Model\GeneralSettingModel;
class CheckerController extends Controller{

	public function __construct(){
		if(empty($_SESSION)){
			header("location:/");	
		}
	}

	public function indexAction($params = []){
		$historyModel = new HistoryModel;
		$historyList = $historyModel->findBy([
			["user_id", HistoryModel::EQUAL, $_SESSION['id']]
		]);
		$generalSettingsModel = new GeneralSettingModel;
		$generalCnfList = $generalSettingsModel->all();
		$configs = [];
		foreach ($generalCnfList as $value) {
			$configs[$value['name']]=$value["value"];
		}
		return $this->renderHtml("checker/index", [ "historyList" => $historyList, "configs" => $configs ]);
	}
}