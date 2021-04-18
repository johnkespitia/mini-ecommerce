<?php 

namespace Controller;
use Model\PensionModel;
class PensionController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Pension"]["Listar"])){
			header("location:/");	
		}
		$PensionModel = new PensionModel();
		$cityList = $PensionModel->all();
		return $this->renderHtml("pension/index", ["cityList"=>$cityList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Pension"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("pension/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Pension"]["Crear"])){
			header("location:/");	
		}
		$PensionModel = new PensionModel();
		if(!$PensionModel->create($params["post"])){
			throw new \Exception("No fue posible crear la Pension, verifique la información proporcionada", 500);
		}else{
			header("location:/pension/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Pension"]["Editar"])){
			header("location:/");	
		}
		$PensionModel = new PensionModel();
		$cityRes = $PensionModel->find($params["params"][2]);
		if(empty($cityRes)){
			throw new \Exception("Pension no encontrada", 404);
		}
		if(!$PensionModel->update($params["post"], $cityRes["id"])){
			throw new \Exception("No fue posible actualizar la Pension, verifique la información proporcionada", 500);
		}else{
			header("location:/pension/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Pension"]["Editar"])){
			header("location:/");	
		}
		$PensionModel = new PensionModel();
		$city = $PensionModel->find($params["params"][2]);
		if(empty($city)){
			throw new \Exception("Pension no encontrada", 404);
		}
		return $this->renderHtml("pension/edit", ["city" => $city]);
	}
}