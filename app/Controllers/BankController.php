<?php 

namespace Controller;
use Model\BankModel;
class BankController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Banco"]["Listar"])){
			header("location:/");	
		}
		$BankModel = new BankModel();
		$cityList = $BankModel->all();
		return $this->renderHtml("position/index", ["cityList"=>$cityList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Banco"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("position/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Banco"]["Crear"])){
			header("location:/");	
		}
		$BankModel = new BankModel();
		if(!$BankModel->create($params["post"])){
			throw new \Exception("No fue posible crear la Banco, verifique la información proporcionada", 500);
		}else{
			header("location:/position/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Banco"]["Editar"])){
			header("location:/");	
		}
		$BankModel = new BankModel();
		$cityRes = $BankModel->find($params["params"][2]);
		if(empty($cityRes)){
			throw new \Exception("Banco no encontrada", 404);
		}
		if(!$BankModel->update($params["post"], $cityRes["id"])){
			throw new \Exception("No fue posible actualizar la Banco, verifique la información proporcionada", 500);
		}else{
			header("location:/position/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Banco"]["Editar"])){
			header("location:/");	
		}
		$BankModel = new BankModel();
		$city = $BankModel->find($params["params"][2]);
		if(empty($city)){
			throw new \Exception("Banco no encontrada", 404);
		}
		return $this->renderHtml("position/edit", ["city" => $city]);
	}
}