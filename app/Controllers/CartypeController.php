<?php 

namespace Controller;
use Model\CarTypeModel;
class CartypeController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Vehículos"]["Listar"])){
			header("location:/");	
		}
		$carTypeModel = new CarTypeModel();
		$carTypeList = $carTypeModel->all();
		return $this->renderHtml("cartypes/index", ["carTypeList"=>$carTypeList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Vehículos"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("cartypes/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Vehículos"]["Crear"])){
			header("location:/");	
		}
		$carType = new CarTypeModel();
		if(!$carType->create($params["post"])){
			throw new \Exception("No fue posible crear el tipo de vehículo, verifique la información proporcionada", 500);
		}else{
			header("location:/cartype/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Vehículos"]["Editar"])){
			header("location:/");	
		}
		$carType = new CarTypeModel();
		$carTypeRes = $carType->find($params["params"][2]);
		if(empty($carTypeRes)){
			throw new \Exception("User not found", 404);
		}
		if(!$carType->update($params["post"], $carTypeRes["id"])){
			throw new \Exception("No fue posible actualizar el tipo de vehículo, verifique la información proporcionada", 500);
		}else{
			header("location:/cartype/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Vehículos"]["Editar"])){
			header("location:/");	
		}
		$CarType = new CarTypeModel();
		$user = $CarType->find($params["params"][2]);
		if(empty($user)){
			throw new \Exception("Vehículo no encontrado", 404);
		}
		return $this->renderHtml("cartypes/edit", ["customer"=>$user]);
	}

	public function deleteAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Vehículos"]["Eliminar"])){
			header("location:/");	
		}
		$CarType = new CarTypeModel();
		$user = $CarType->find($params["params"][2]);
		if(empty($user)){
			throw new \Exception("User not found", 404);
		}
		
		if(!$CarType->delete($user["id"])){
			throw new \Exception("No fue posible eliminar el tipo de vehículo, verifique que no tenga eventos creados", 404);
		}else{
			header("location:/car/");
		}
	}

}