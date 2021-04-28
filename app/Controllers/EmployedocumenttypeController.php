<?php 

namespace Controller;
use Model\EmployeDocumentTypeModel;
class EmployedocumenttypeController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Documento"]["Listar"])){
			header("location:/");	
		}
		$EmployeDocumentTypeModel = new EmployeDocumentTypeModel();
		$rolList = $EmployeDocumentTypeModel->all();
		return $this->renderHtml("employedocumenttype/index", ["rolList"=>$rolList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Documento"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("employedocumenttype/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Documento"]["Crear"])){
			header("location:/");	
		}
		$EmployeDocumentTypeModel = new EmployeDocumentTypeModel();
		if(!$EmployeDocumentTypeModel->create($params["post"])){
			throw new \Exception("No fue posible crear el rol, verifique la información proporcionada", 500);
		}else{
			header("location:/employedocumenttype/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Documento"]["Editar"])){
			header("location:/");	
		}
		$EmployeDocumentTypeModel = new EmployeDocumentTypeModel();
		$rolRes = $EmployeDocumentTypeModel->find($params["params"][2]);
		if(empty($rolRes)){
			throw new \Exception("Rol no encontrado", 404);
		}
		if(!$EmployeDocumentTypeModel->update($params["post"], $rolRes["id"])){
			throw new \Exception("No fue posible actualizar el rol, verifique la información proporcionada", 500);
		}else{
			header("location:/employedocumenttype/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo de Documento"]["Editar"])){
			header("location:/");	
		}
		$EmployeDocumentTypeModel = new EmployeDocumentTypeModel();
		$rol = $EmployeDocumentTypeModel->find($params["params"][2]);
		if(empty($rol)){
			throw new \Exception("Rol no encontrado", 404);
		}
		return $this->renderHtml("employedocumenttype/edit", ["rol" => $rol]);
	}
}