<?php 

namespace Controller;
use Model\ServiceTypeModel;
class ServicetypeController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Servicio"]["Listar"])){
			header("location:/");	
		}
		$ServiceTypeModel = new ServiceTypeModel();
		$rolList = $ServiceTypeModel->all();
		return $this->renderHtml("servicetype/index", ["rolList"=>$rolList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Servicio"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("servicetype/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Servicio"]["Crear"])){
			header("location:/");	
		}
		$ServiceTypeModel = new ServiceTypeModel();
		if(!$ServiceTypeModel->create($params["post"])){
			throw new \Exception("No fue posible crear el Tipo de Servicio, verifique la información proporcionada ", 500);
		}else{
			header("location:/servicetype/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Servicio"]["Editar"])){
			header("location:/");	
		}
		$ServiceTypeModel = new ServiceTypeModel();
		$rolRes = $ServiceTypeModel->find($params["params"][2]);
		if(empty($rolRes)){
			throw new \Exception("Tipo de Servicio no encontrada", 404);
		}
		if(!$ServiceTypeModel->update($params["post"], $rolRes["id"])){
			throw new \Exception("No fue posible actualizar el Tipo de Servicio, verifique la información proporcionada ", 500);
		}else{
			header("location:/servicetype/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Servicio"]["Editar"])){
			header("location:/");	
		}
		$ServiceTypeModel = new ServiceTypeModel();
		$rol = $ServiceTypeModel->find($params["params"][2]);
		if(empty($rol)){
			throw new \Exception("Tipo de Servicio no encontrado", 404);
		}
		return $this->renderHtml("servicetype/edit", ["rol" => $rol]);
	}
}