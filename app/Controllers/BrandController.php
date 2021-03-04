<?php 

namespace Controller;
use Model\BrandModel;
class BrandController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Marca"]["Listar"])){
			header("location:/");	
		}
		$BrandModel = new BrandModel();
		$rolList = $BrandModel->all();
		return $this->renderHtml("brand/index", ["rolList"=>$rolList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Marca"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("brand/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Marca"]["Crear"])){
			header("location:/");	
		}
		$BrandModel = new BrandModel();
		if(!$BrandModel->create($params["post"])){
			throw new \Exception("No fue posible crear la marca, verifique la información proporcionada ", 500);
		}else{
			header("location:/brand/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Marca"]["Editar"])){
			header("location:/");	
		}
		$BrandModel = new BrandModel();
		$rolRes = $BrandModel->find($params["params"][2]);
		if(empty($rolRes)){
			throw new \Exception("Marca no encontrada", 404);
		}
		if(!$BrandModel->update($params["post"], $rolRes["id"])){
			throw new \Exception("No fue posible actualizar la marca, verifique la información proporcionada", 500);
		}else{
			header("location:/brand/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Marca"]["Editar"])){
			header("location:/");	
		}
		$BrandModel = new BrandModel();
		$rol = $BrandModel->find($params["params"][2]);
		if(empty($rol)){
			throw new \Exception("Marca no encontrada", 404);
		}
		return $this->renderHtml("brand/edit", ["rol" => $rol]);
	}
}