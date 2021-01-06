<?php 

namespace Controller;
use Model\UserModel;
class UserController extends Controller{

	public function __construct(){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
	}

	public function indexAction($params = []){
		$userModel = new UserModel();
		$userList = $userModel->all();
		return $this->renderHtml("user/index", ["userList"=>$userList]);
	}

	public function newAction($params = []){
		return $this->renderHtml("user/new", []);
	}

	public function storeAction($params = []){
		$userModel = new UserModel();
		$params["post"]["password"] = md5($params["post"]["password"]);
		$userList = $userModel->create($params["post"]);
		header("location:/user/");
	}

	public function updateAction($params = []){
		$userModel = new UserModel();
		$user = $userModel->find($params["params"][2]);
		if(empty($user)){
			throw new \Exception("User not found", 404);
		}
		$params["post"]["password"] = (!empty($params["post"]["password"]))?md5($params["post"]["password"]):$user["password"];
		$userList = $userModel->update($params["post"], $user["id"]);
		header("location:/user/");
	}


	public function editAction($params = []){
		$userModel = new UserModel();
		$user = $userModel->find($params["params"][2]);
		if(empty($user)){
			throw new \Exception("User not found", 404);
		}
		return $this->renderHtml("user/edit", ["customer"=>$user]);
	}

	public function deleteAction($params = []){
		$userModel = new userModel();
		$user = $userModel->find($params["params"][2]);
		if(empty($user)){
			throw new \Exception("User not found", 404);
		}
		$user = $userModel->delete($user["id"]);
		header("location:/user/");
	}

}