<?php 

namespace Controller;
use Model\RolModel;
class RolController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
		$RolModel = new RolModel();
		$rolList = $RolModel->all();
		return $this->renderHtml("rol/index", ["rolList"=>$rolList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
		return $this->renderHtml("rol/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
		$RolModel = new RolModel();
		if(!$RolModel->create($params["post"])){
			throw new \Exception("No fue posible crear el rol, verifique la información proporcionada", 500);
		}else{
			header("location:/rol/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION) || ($_SESSION["rol_id"] != 1 )){
			header("location:/");	
		}
		$RolModel = new RolModel();
		$rolRes = $RolModel->find($params["params"][2]);
		if(empty($rolRes)){
			throw new \Exception("Rol no encontrado", 404);
		}
		if(!$RolModel->update($params["post"], $rolRes["id"])){
			throw new \Exception("No fue posible actualizar el rol, verifique la información proporcionada", 500);
		}else{
			header("location:/rol/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION) || ($_SESSION["rol_id"] != 1 )){
			header("location:/");	
		}
		$RolModel = new RolModel();
		$rol = $RolModel->find($params["params"][2]);
		if(empty($rol)){
			throw new \Exception("Rol no encontrado", 404);
		}
		return $this->renderHtml("rol/edit", ["rol" => $rol]);
	}
}