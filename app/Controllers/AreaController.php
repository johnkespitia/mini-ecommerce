<?php 

namespace Controller;
use Model\AreaModel;
class AreaController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Area"]["Listar"])){
			header("location:/");	
		}
		$AreaModel = new AreaModel();
		$cityList = $AreaModel->all();
		return $this->renderHtml("areas/index", ["cityList"=>$cityList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Area"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("areas/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Area"]["Crear"])){
			header("location:/");	
		}
		$AreaModel = new AreaModel();
		if(!$AreaModel->create($params["post"])){
			throw new \Exception("No fue posible crear la Area, verifique la información proporcionada", 500);
		}else{
			header("location:/area/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Area"]["Editar"])){
			header("location:/");	
		}
		$AreaModel = new AreaModel();
		$cityRes = $AreaModel->find($params["params"][2]);
		if(empty($cityRes)){
			throw new \Exception("Area no encontrada", 404);
		}
		if(!$AreaModel->update($params["post"], $cityRes["id"])){
			throw new \Exception("No fue posible actualizar la Area, verifique la información proporcionada", 500);
		}else{
			header("location:/area/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Area"]["Editar"])){
			header("location:/");	
		}
		$AreaModel = new AreaModel();
		$city = $AreaModel->find($params["params"][2]);
		if(empty($city)){
			throw new \Exception("Area no encontrada", 404);
		}
		return $this->renderHtml("areas/edit", ["city" => $city]);
	}
}