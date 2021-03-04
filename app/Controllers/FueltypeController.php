<?php 

namespace Controller;
use Model\FuelTypeModel;
class FueltypeController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Combustible"]["Listar"])){
			header("location:/");	
		}
		$FuelTypeModel = new FuelTypeModel();
		$rolList = $FuelTypeModel->all();
		return $this->renderHtml("fueltype/index", ["rolList"=>$rolList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Combustible"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("fueltype/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Combustible"]["Crear"])){
			header("location:/");	
		}
		$FuelTypeModel = new FuelTypeModel();
		if(!$FuelTypeModel->create($params["post"])){
			throw new \Exception("No fue posible crear el rol, verifique la información proporcionada", 500);
		}else{
			header("location:/fueltype/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Combustible"]["Editar"])){
			header("location:/");	
		}
		$FuelTypeModel = new FuelTypeModel();
		$rolRes = $FuelTypeModel->find($params["params"][2]);
		if(empty($rolRes)){
			throw new \Exception("Rol no encontrado", 404);
		}
		if(!$FuelTypeModel->update($params["post"], $rolRes["id"])){
			throw new \Exception("No fue posible actualizar el rol, verifique la información proporcionada", 500);
		}else{
			header("location:/fueltype/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Combustible"]["Editar"])){
			header("location:/");	
		}
		$FuelTypeModel = new FuelTypeModel();
		$rol = $FuelTypeModel->find($params["params"][2]);
		if(empty($rol)){
			throw new \Exception("Rol no encontrado", 404);
		}
		return $this->renderHtml("fueltype/edit", ["rol" => $rol]);
	}
}