<?php 

namespace Controller;
use Model\TrailerTypeModel;
class TrailertypeController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Trailer"]["Listar"])){
			header("location:/");	
		}
		$TrailerTypeModel = new TrailerTypeModel();
		$carTypeList = $TrailerTypeModel->all();
		return $this->renderHtml("trailertype/index", ["carTypeList"=>$carTypeList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Trailer"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("trailertype/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Trailer"]["Crear"])){
			header("location:/");	
		}
		$carType = new TrailerTypeModel();
		if(!$carType->create($params["post"])){
			throw new \Exception("No fue posible crear el tipo de vehículo, verifique la información proporcionada", 500);
		}else{
			header("location:/trailertype/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Trailer"]["Editar"])){
			header("location:/");	
		}
		$carType = new TrailerTypeModel();
		$carTypeRes = $carType->find($params["params"][2]);
		if(empty($carTypeRes)){
			throw new \Exception("User not found", 404);
		}
		if(!$carType->update($params["post"], $carTypeRes["id"])){
			throw new \Exception("No fue posible actualizar el tipo de vehículo, verifique la información proporcionada", 500);
		}else{
			header("location:/trailertype/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Trailer"]["Editar"])){
			header("location:/");	
		}
		$CarType = new TrailerTypeModel();
		$user = $CarType->find($params["params"][2]);
		if(empty($user)){
			throw new \Exception("Vehículo no encontrado", 404);
		}
		return $this->renderHtml("trailertype/edit", ["customer"=>$user]);
	}

	public function deleteAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Trailer"]["Eliminar"])){
			header("location:/");	
		}
		$CarType = new TrailerTypeModel();
		$user = $CarType->find($params["params"][2]);
		if(empty($user)){
			throw new \Exception("User not found", 404);
		}
		
		if(!$CarType->delete($user["id"])){
			throw new \Exception("No fue posible eliminar el tipo de vehículo, verifique que no tenga eventos creados", 404);
		}else{
			header("location:/trailertype/");
		}
	}

}