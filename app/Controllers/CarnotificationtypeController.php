<?php 

namespace Controller;
use Model\NotificationTypeModel;
class CarnotificationtypeController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo Notificación"]["Listar"])){
			header("location:/");	
		}
		$NotificationTypeModel = new NotificationTypeModel();
		$rolList = $NotificationTypeModel->all();
		return $this->renderHtml("carnotificationtype/index", ["rolList"=>$rolList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo Notificación"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("carnotificationtype/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo Notificación"]["Crear"])){
			header("location:/");	
		}
		$NotificationTypeModel = new NotificationTypeModel();
		if(!$NotificationTypeModel->create($params["post"])){
			throw new \Exception("No fue posible crear el rol, verifique la información proporcionada", 500);
		}else{
			header("location:/carnotificationtype/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo Notificación"]["Editar"])){
			header("location:/");	
		}
		$NotificationTypeModel = new NotificationTypeModel();
		$rolRes = $NotificationTypeModel->find($params["params"][2]);
		if(empty($rolRes)){
			throw new \Exception("Rol no encontrado", 404);
		}
		if(!$NotificationTypeModel->update($params["post"], $rolRes["id"])){
			throw new \Exception("No fue posible actualizar el rol, verifique la información proporcionada", 500);
		}else{
			header("location:/carnotificationtype/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Tipo Notificación"]["Editar"])){
			header("location:/");	
		}
		$NotificationTypeModel = new NotificationTypeModel();
		$rol = $NotificationTypeModel->find($params["params"][2]);
		if(empty($rol)){
			throw new \Exception("Rol no encontrado", 404);
		}
		return $this->renderHtml("carnotificationtype/edit", ["rol" => $rol]);
	}
}