<?php 

namespace Controller;
use Model\ArlModel;
class ArlController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Arl"]["Listar"])){
			header("location:/");	
		}
		$ArlModel = new ArlModel();
		$cityList = $ArlModel->all();
		return $this->renderHtml("arl/index", ["cityList"=>$cityList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Arl"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("arl/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Arl"]["Crear"])){
			header("location:/");	
		}
		$ArlModel = new ArlModel();
		if(!$ArlModel->create($params["post"])){
			throw new \Exception("No fue posible crear la Area, verifique la información proporcionada", 500);
		}else{
			header("location:/arl/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Arl"]["Editar"])){
			header("location:/");	
		}
		$ArlModel = new ArlModel();
		$cityRes = $ArlModel->find($params["params"][2]);
		if(empty($cityRes)){
			throw new \Exception("Area no encontrada", 404);
		}
		if(!$ArlModel->update($params["post"], $cityRes["id"])){
			throw new \Exception("No fue posible actualizar la Area, verifique la información proporcionada", 500);
		}else{
			header("location:/arl/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Arl"]["Editar"])){
			header("location:/");	
		}
		$ArlModel = new ArlModel();
		$city = $ArlModel->find($params["params"][2]);
		if(empty($city)){
			throw new \Exception("Area no encontrada", 404);
		}
		return $this->renderHtml("arl/edit", ["city" => $city]);
	}
}