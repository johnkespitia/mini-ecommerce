<?php 

namespace Controller;
use Model\DocumentTypeModel;
class DocumenttypeController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Documento"]["Listar"])){
			header("location:/");	
		}
		$DocumentTypeModel = new DocumentTypeModel();
		$rolList = $DocumentTypeModel->all();
		return $this->renderHtml("documenttype/index", ["rolList"=>$rolList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Documento"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("documenttype/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Documento"]["Crear"])){
			header("location:/");	
		}
		$DocumentTypeModel = new DocumentTypeModel();
		if(!$DocumentTypeModel->create($params["post"])){
			throw new \Exception("No fue posible crear el rol, verifique la información proporcionada", 500);
		}else{
			header("location:/documenttype/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Documento"]["Editar"])){
			header("location:/");	
		}
		$DocumentTypeModel = new DocumentTypeModel();
		$rolRes = $DocumentTypeModel->find($params["params"][2]);
		if(empty($rolRes)){
			throw new \Exception("Rol no encontrado", 404);
		}
		if(!$DocumentTypeModel->update($params["post"], $rolRes["id"])){
			throw new \Exception("No fue posible actualizar el rol, verifique la información proporcionada", 500);
		}else{
			header("location:/documenttype/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Documento"]["Editar"])){
			header("location:/");	
		}
		$DocumentTypeModel = new DocumentTypeModel();
		$rol = $DocumentTypeModel->find($params["params"][2]);
		if(empty($rol)){
			throw new \Exception("Rol no encontrado", 404);
		}
		return $this->renderHtml("documenttype/edit", ["rol" => $rol]);
	}
}