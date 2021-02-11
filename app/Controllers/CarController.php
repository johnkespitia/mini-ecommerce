<?php 

namespace Controller;
use Model\CarTypeModel;
use Model\CarModel;
class CarController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
		$carModel = new CarModel();
		$carList = $carModel->all();
		return $this->renderHtml("car/index", ["carList"=>$carList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
		$carTypeModel = new CarTypeModel();
		$carTypeList = $carTypeModel->findBy([
			["status",CarTypeModel::EQUAL, 1]
		]);
		return $this->renderHtml("car/new", ["carTypeList"=>$carTypeList]);
	}

	public function storeAction($params = []){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
		$carModel = new CarModel();
		if(!$carModel->create($params["post"])){
			throw new \Exception("No fue posible crear el vehículo, verifique la información proporcionada", 500);
		}else{
			header("location:/car/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION) || ($_SESSION["rol_id"] != 1 && $_SESSION["rol_id"] != $params["params"][2] )){
			header("location:/");	
		}
		$car = new CarModel();
		$carRes = $car->find($params["params"][2]);
		if(empty($carRes)){
			throw new \Exception("User not found", 404);
		}
		if(!$car->update($params["post"], $carRes["id"])){
			throw new \Exception("No fue posible actualizar el vehículo, verifique la información proporcionada", 500);
		}else{
			header("location:/car/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION) || ($_SESSION["rol_id"] != 1 && $_SESSION["rol_id"] != $params["params"][2] )){
			header("location:/");	
		}
		$carTypeModel = new CarTypeModel();
		$carTypeList = $carTypeModel->findBy([
			["status",CarTypeModel::EQUAL, 1]
		]);
		$Car = new CarModel();
		$user = $Car->find($params["params"][2]);
		if(empty($user)){
			throw new \Exception("Vehículo no encontrado", 404);
		}
		return $this->renderHtml("car/edit", ["customer" => $user, "carTypeList"=> $carTypeList]);
	}

	public function deleteAction($params = []){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
		$CarType = new CarTypeModel();
		$user = $CarType->find($params["params"][2]);
		if(empty($user)){
			throw new \Exception("Vehículo no encontrado", 404);
		}
		
		if(!$CarType->delete($user["id"])){
			throw new \Exception("No fue posible eliminar el vahículo, verifique que no tenga eventos creados", 404);
		}else{
			header("location:/car/");
		}
	}

}