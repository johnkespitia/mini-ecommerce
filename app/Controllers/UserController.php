<?php 

namespace Controller;
use Model\UserModel;
class UserController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
		$userModel = new UserModel();
		$userList = $userModel->all();
		return $this->renderHtml("user/index", ["userList"=>$userList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
		return $this->renderHtml("user/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
		$userModel = new UserModel();
		$params["post"]["password"] = md5($params["post"]["password"]);
		if(!$userModel->create($params["post"])){
			throw new \Exception("No fue posible crear el usuario, verifique la información proporcionada", 404);
		}else{
			header("location:/user/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION) || ($_SESSION["rol_id"] != 1 && $_SESSION["rol_id"] != $params["params"][2] )){
			header("location:/");	
		}
		$userModel = new UserModel();
		$user = $userModel->find($params["params"][2]);
		if(empty($user)){
			throw new \Exception("User not found", 404);
		}
		$params["post"]["password"] = (!empty($params["post"]["password"]))?md5($params["post"]["password"]):$user["password"];
		if(!$userModel->update($params["post"], $user["id"])){
			throw new \Exception("No fue posible actualizar el usuario, verifique la información proporcionada", 404);
		}else{
			header("location:/user/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION) || ($_SESSION["rol_id"] != 1 && $_SESSION["rol_id"] != $params["params"][2] )){
			header("location:/");	
		}
		$userModel = new UserModel();
		$user = $userModel->find($params["params"][2]);
		if(empty($user)){
			throw new \Exception("User not found", 404);
		}
		return $this->renderHtml("user/edit", ["customer"=>$user]);
	}

	public function deleteAction($params = []){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
		$userModel = new userModel();
		$user = $userModel->find($params["params"][2]);
		if(empty($user)){
			throw new \Exception("User not found", 404);
		}
		
		if(!$userModel->delete($user["id"])){
			throw new \Exception("No fue posible eliminar el usuario, verifique que no tenga eventos creados", 404);
		}else{
			header("location:/user/");
		}
	}

}