<?php 

namespace Controller;
use Model\NotificationEmailModel;
class NotificationemailController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Emails Notificacione"]["Listar"])){
			header("location:/");	
		}
		$NotiNotificationEmailModel = new NotificationEmailModel();
		$rolList = $NotiNotificationEmailModel->all();
		return $this->renderHtml("notificationemail/index", ["emails"=>$rolList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Emails Notificacione"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("notificationemail/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Emails Notificacione"]["Crear"])){
			header("location:/");	
		}
		$NotiNotificationEmailModel = new NotificationEmailModel();
		if(!$NotiNotificationEmailModel->create($params["post"])){
			throw new \Exception("No fue posible crear el rol, verifique la información proporcionada", 500);
		}else{
			header("location:/notificationemail/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Emails Notificacione"]["Editar"])){
			header("location:/");	
		}
		$NotiNotificationEmailModel = new NotificationEmailModel();
		$rolRes = $NotiNotificationEmailModel->find($params["params"][2]);
		if(empty($rolRes)){
			throw new \Exception("Rol no encontrado", 404);
		}
		if(!$NotiNotificationEmailModel->update($params["post"], $rolRes["id"])){
			throw new \Exception("No fue posible actualizar el rol, verifique la información proporcionada", 500);
		}else{
			header("location:/notificationemail/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Emails Notificacione"]["Editar"])){
			header("location:/");	
		}
		$NotiNotificationEmailModel = new NotificationEmailModel();
		$rol = $NotiNotificationEmailModel->find($params["params"][2]);
		if(empty($rol)){
			throw new \Exception("Rol no encontrado", 404);
		}
		return $this->renderHtml("notificationemail/edit", ["rol" => $rol]);
	}
}