<?php

namespace Controller;
use Model\UserModel;
class CustomerController extends Controller{

	public function __construct(){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
	}

	public function indexAction($params = []){
		$customerModel = new UserModel();
		$customerList = $customerModel->all();
		return $this->renderHtml("customer/index", ["customerList"=>$customerList]);
	}

	public function newAction($params = []){
		return $this->renderHtml("customer/new", []);
	}

	public function storeAction($params = []){
		$customerModel = new UserModel();
		$params["post"]["password"] = md5($params["post"]["password"]);
		$customerList = $customerModel->create($params["post"]);
		header("location:/customer/");
	}

	public function updateAction($params = []){
		$customerModel = new UserModel();
		$customer = $customerModel->find($params["params"][2]);
		if(empty($customer)){
			throw new \Exception("User not found", 404);
		}
		$params["post"]["password"] = (!empty($params["post"]["password"]))?md5($params["post"]["password"]):$customer["password"];
		$customerList = $customerModel->update($params["post"], $customer["id"]);
		header("location:/customer/");
	}


	public function editAction($params = []){
		$customerModel = new UserModel();
		$customer = $customerModel->find($params["params"][2]);
		if(empty($customer)){
			throw new \Exception("User not found", 404);
		}
		return $this->renderHtml("customer/edit", ["customer"=>$customer]);
	}

	public function deleteAction($params = []){
		$customerModel = new CustomerModel();
		$customer = $customerModel->find($params["params"][2]);
		if(empty($customer)){
			throw new \Exception("User not found", 404);
		}
		$customer = $customerModel->delete($customer["id"]);
		header("location:/customer/");
	}

}