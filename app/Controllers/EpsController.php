<?php 

namespace Controller;
use Model\EpsModel;
class EpsController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Eps"]["Listar"])){
			header("location:/");	
		}
		$EpsModel = new EpsModel();
		$cityList = $EpsModel->all();
		return $this->renderHtml("eps/index", ["cityList"=>$cityList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Eps"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("eps/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Eps"]["Crear"])){
			header("location:/");	
		}
		$EpsModel = new EpsModel();
		if(!$EpsModel->create($params["post"])){
			throw new \Exception("No fue posible crear la Eps, verifique la información proporcionada", 500);
		}else{
			header("location:/eps/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Eps"]["Editar"])){
			header("location:/");	
		}
		$EpsModel = new EpsModel();
		$cityRes = $EpsModel->find($params["params"][2]);
		if(empty($cityRes)){
			throw new \Exception("Eps no encontrada", 404);
		}
		if(!$EpsModel->update($params["post"], $cityRes["id"])){
			throw new \Exception("No fue posible actualizar la Eps, verifique la información proporcionada", 500);
		}else{
			header("location:/eps/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Eps"]["Editar"])){
			header("location:/");	
		}
		$EpsModel = new EpsModel();
		$city = $EpsModel->find($params["params"][2]);
		if(empty($city)){
			throw new \Exception("Eps no encontrada", 404);
		}
		return $this->renderHtml("eps/edit", ["city" => $city]);
	}
}