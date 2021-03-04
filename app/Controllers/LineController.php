<?php 

namespace Controller;
use Model\LineModel;
class LineController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Línea"]["Listar"])){
			header("location:/");	
		}
		$LineModel = new LineModel();
		$rolList = $LineModel->all();
		return $this->renderHtml("line/index", ["rolList"=>$rolList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Línea"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("line/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Línea"]["Crear"])){
			header("location:/");	
		}
		$LineModel = new LineModel();
		if(!$LineModel->create($params["post"])){
			throw new \Exception("No fue posible crear La línea, verifique la información proporcionada", 500);
		}else{
			header("location:/line/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Línea"]["Editar"])){
			header("location:/");	
		}
		$LineModel = new LineModel();
		$rolRes = $LineModel->find($params["params"][2]);
		if(empty($rolRes)){
			throw new \Exception("Línea no encontrada", 404);
		}
		if(!$LineModel->update($params["post"], $rolRes["id"])){
			throw new \Exception("No fue posible actualizar La línea, verifique la información proporcionada", 500);
		}else{
			header("location:/line/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Línea"]["Editar"])){
			header("location:/");	
		}
		$LineModel = new LineModel();
		$rol = $LineModel->find($params["params"][2]);
		if(empty($rol)){
			throw new \Exception("Línea no encontrada", 404);
		}
		return $this->renderHtml("line/edit", ["rol" => $rol]);
	}
}