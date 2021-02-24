<?php 

namespace Controller;
use Model\CityModel;
class CityController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Ciudades"]["Listar"])){
			header("location:/");	
		}
		$cityModel = new CityModel();
		$cityList = $cityModel->all();
		return $this->renderHtml("city/index", ["cityList"=>$cityList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Ciudades"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("city/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Ciudades"]["Crear"])){
			header("location:/");	
		}
		$cityModel = new CityModel();
		if(!$cityModel->create($params["post"])){
			throw new \Exception("No fue posible crear la ciudad, verifique la información proporcionada", 500);
		}else{
			header("location:/city/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Ciudades"]["Editar"])){
			header("location:/");	
		}
		$cityModel = new CityModel();
		$cityRes = $cityModel->find($params["params"][2]);
		if(empty($cityRes)){
			throw new \Exception("Ciudad no encontrada", 404);
		}
		if(!$cityModel->update($params["post"], $cityRes["id"])){
			throw new \Exception("No fue posible actualizar la ciudad, verifique la información proporcionada", 500);
		}else{
			header("location:/city/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Ciudades"]["Editar"])){
			header("location:/");	
		}
		$cityModel = new CityModel();
		$city = $cityModel->find($params["params"][2]);
		if(empty($city)){
			throw new \Exception("Ciudad no encontrada", 404);
		}
		return $this->renderHtml("city/edit", ["city" => $city]);
	}
}