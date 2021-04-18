<?php 

namespace Controller;
use Model\CajaCompensacionModel;
class CajacompensacionController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Caja de Compensacion"]["Listar"])){
			header("location:/");	
		}
		$CajaCompensacionModel = new CajaCompensacionModel();
		$cityList = $CajaCompensacionModel->all();
		return $this->renderHtml("cajacompensacion/index", ["cityList"=>$cityList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Caja de Compensacion"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("cajacompensacion/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Caja de Compensacion"]["Crear"])){
			header("location:/");	
		}
		$CajaCompensacionModel = new CajaCompensacionModel();
		if(!$CajaCompensacionModel->create($params["post"])){
			throw new \Exception("No fue posible crear la Caja de Compensacion, verifique la información proporcionada", 500);
		}else{
			header("location:/cajacompensacion/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Caja de Compensacion"]["Editar"])){
			header("location:/");	
		}
		$CajaCompensacionModel = new CajaCompensacionModel();
		$cityRes = $CajaCompensacionModel->find($params["params"][2]);
		if(empty($cityRes)){
			throw new \Exception("Caja de Compensacion no encontrada", 404);
		}
		if(!$CajaCompensacionModel->update($params["post"], $cityRes["id"])){
			throw new \Exception("No fue posible actualizar la Caja de Compensacion, verifique la información proporcionada", 500);
		}else{
			header("location:/cajacompensacion/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Caja de Compensacion"]["Editar"])){
			header("location:/");	
		}
		$CajaCompensacionModel = new CajaCompensacionModel();
		$city = $CajaCompensacionModel->find($params["params"][2]);
		if(empty($city)){
			throw new \Exception("Caja de Compensacion no encontrada", 404);
		}
		return $this->renderHtml("cajacompensacion/edit", ["city" => $city]);
	}
}