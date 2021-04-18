<?php 

namespace Controller;
use Model\PositionModel;
class PositionController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Cargo"]["Listar"])){
			header("location:/");	
		}
		$PositionModel = new PositionModel();
		$cityList = $PositionModel->all();
		return $this->renderHtml("position/index", ["cityList"=>$cityList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Cargo"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("position/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Cargo"]["Crear"])){
			header("location:/");	
		}
		$PositionModel = new PositionModel();
		if(!$PositionModel->create($params["post"])){
			throw new \Exception("No fue posible crear la Cargo, verifique la información proporcionada", 500);
		}else{
			header("location:/position/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Cargo"]["Editar"])){
			header("location:/");	
		}
		$PositionModel = new PositionModel();
		$cityRes = $PositionModel->find($params["params"][2]);
		if(empty($cityRes)){
			throw new \Exception("Cargo no encontrada", 404);
		}
		if(!$PositionModel->update($params["post"], $cityRes["id"])){
			throw new \Exception("No fue posible actualizar la Cargo, verifique la información proporcionada", 500);
		}else{
			header("location:/position/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Cargo"]["Editar"])){
			header("location:/");	
		}
		$PositionModel = new PositionModel();
		$city = $PositionModel->find($params["params"][2]);
		if(empty($city)){
			throw new \Exception("Cargo no encontrada", 404);
		}
		return $this->renderHtml("position/edit", ["city" => $city]);
	}
}