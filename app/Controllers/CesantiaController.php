<?php 

namespace Controller;
use Model\CesantiasModel;
class CesantiaController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Cesantias"]["Listar"])){
			header("location:/");	
		}
		$CesantiasModel = new CesantiasModel();
		$cityList = $CesantiasModel->all();
		return $this->renderHtml("cesantias/index", ["cityList"=>$cityList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Cesantias"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("cesantias/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Cesantias"]["Crear"])){
			header("location:/");	
		}
		$CesantiasModel = new CesantiasModel();
		if(!$CesantiasModel->create($params["post"])){
			throw new \Exception("No fue posible crear la Cesantias, verifique la información proporcionada", 500);
		}else{
			header("location:/cesantias/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Cesantias"]["Editar"])){
			header("location:/");	
		}
		$CesantiasModel = new CesantiasModel();
		$cityRes = $CesantiasModel->find($params["params"][2]);
		if(empty($cityRes)){
			throw new \Exception("Cesantias no encontrada", 404);
		}
		if(!$CesantiasModel->update($params["post"], $cityRes["id"])){
			throw new \Exception("No fue posible actualizar la Cesantias, verifique la información proporcionada", 500);
		}else{
			header("location:/cesantias/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Cesantias"]["Editar"])){
			header("location:/");	
		}
		$CesantiasModel = new CesantiasModel();
		$city = $CesantiasModel->find($params["params"][2]);
		if(empty($city)){
			throw new \Exception("Cesantias no encontrada", 404);
		}
		return $this->renderHtml("cesantias/edit", ["city" => $city]);
	}
}