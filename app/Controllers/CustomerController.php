<?php

namespace Controller;
use Model\CustomerModel;
use Model\CityModel;
class CustomerController extends Controller{
	public function indexAction($params = []){
		$customerModel = new CustomerModel();
		$customerList = $customerModel->all();
		$cityModel = new cityModel();
		$cityList = [];
		$genCity = $cityModel->all();
		foreach ($genCity as $c) {
			$cityList[] = $c;
		}
		return $this->renderHtml("customer/index", ["customerList"=>$customerList, "cityList"=>$cityList]);
	}

	public function newAction($params = []){
		$cityModel = new cityModel();
		$cityList = $cityModel->all();
		return $this->renderHtml("customer/new", ["cityList"=>$cityList]);
	}

	public function storeAction($params = []){
		$customerModel = new CustomerModel();
		$params["post"]["password"] = md5($params["post"]["password"].$params["post"]["email"]);
		$customerList = $customerModel->create($params["post"]);
		header("location:/customer/");
	}

	public function updateAction($params = []){
		$customerModel = new CustomerModel();
		$customer = $customerModel->find($params["params"][2]);
		if(empty($customer)){
			throw new \Exception("Cliente no encontrado", 404);
		}
		$params["post"]["password"] = (!empty($params["post"]["password"]))?md5($params["post"]["password"].$params["post"]["email"]):$customer["password"];
		$customerList = $customerModel->update($params["post"], $customer["id"]);
		header("location:/customer/");
	}


	public function editAction($params = []){
		$customerModel = new CustomerModel();
		$customer = $customerModel->find($params["params"][2]);
		if(empty($customer)){
			throw new \Exception("Cliente no encontrado", 404);
		}
		$cityModel = new cityModel();
		$cityList = $cityModel->all();
		return $this->renderHtml("customer/edit", ["cityList"=>$cityList, "customer"=>$customer]);
	}

	public function deleteAction($params = []){
		$customerModel = new CustomerModel();
		$customer = $customerModel->find($params["params"][2]);
		if(empty($customer)){
			throw new \Exception("Cliente no encontrado", 404);
		}
		$customer = $customerModel->delete($customer["id"]);
		header("location:/customer/");
	}

}