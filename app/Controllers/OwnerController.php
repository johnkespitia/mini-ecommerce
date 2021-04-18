<?php 

namespace Controller;
use Model\CarOwnerModel;
class OwnerController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Propietarios"]["Listar"])){
			header("location:/");	
		}
		$CarOwnerModel = new CarOwnerModel();
		$cityList = $CarOwnerModel->all();
		return $this->renderHtml("car_owner/index", ["cityList"=>$cityList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Propietarios"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("car_owner/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Propietarios"]["Crear"])){
			header("location:/");	
		}
		$CarOwnerModel = new CarOwnerModel();
		if(!$CarOwnerModel->create($params["post"])){
			throw new \Exception("No fue posible crear la propietario, verifique la información proporcionada", 500);
		}else{
			header("location:/owner/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Propietarios"]["Editar"])){
			header("location:/");	
		}
		$CarOwnerModel = new CarOwnerModel();
		$cityRes = $CarOwnerModel->find($params["params"][2]);
		if(empty($cityRes)){
			throw new \Exception("propietario no encontrada", 404);
		}
		if(!$CarOwnerModel->update($params["post"], $cityRes["id"])){
			throw new \Exception("No fue posible actualizar la propietario, verifique la información proporcionada", 500);
		}else{
			header("location:/owner/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Propietarios"]["Editar"])){
			header("location:/");	
		}
		$CarOwnerModel = new CarOwnerModel();
		$city = $CarOwnerModel->find($params["params"][2]);
		if(empty($city)){
			throw new \Exception("propietario no encontrada", 404);
		}
		return $this->renderHtml("car_owner/edit", ["city" => $city]);
	}
}