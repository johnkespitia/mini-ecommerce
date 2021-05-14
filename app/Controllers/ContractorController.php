<?php 

namespace Controller;
use Model\ContractorModel;
class ContractorController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Contratista"]["Listar"])){
			header("location:/");	
		}
		$ContractorModel = new ContractorModel();
		$rolList = $ContractorModel->all();
		return $this->renderHtml("contractor/index", ["rolList"=>$rolList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Contratista"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("contractor/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Contratista"]["Crear"])){
			header("location:/");	
		}
		$ContractorModel = new ContractorModel();
		if(!$ContractorModel->create($params["post"])){
			throw new \Exception("No fue posible crear el rol, verifique la información proporcionada", 500);
		}else{
			header("location:/contractor/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Contratista"]["Editar"])){
			header("location:/");	
		}
		$ContractorModel = new ContractorModel();
		$rolRes = $ContractorModel->find($params["params"][2]);
		if(empty($rolRes)){
			throw new \Exception("Rol no encontrado", 404);
		}
		if(!$ContractorModel->update($params["post"], $rolRes["id"])){
			throw new \Exception("No fue posible actualizar el rol, verifique la información proporcionada", 500);
		}else{
			header("location:/contractor/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Contratista"]["Editar"])){
			header("location:/");	
		}
		$ContractorModel = new ContractorModel();
		$rol = $ContractorModel->find($params["params"][2]);
		if(empty($rol)){
			throw new \Exception("Rol no encontrado", 404);
		}
		return $this->renderHtml("contractor/edit", ["rol" => $rol]);
	}
}