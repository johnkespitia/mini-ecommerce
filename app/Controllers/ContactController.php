<?php
namespace Controller;
use Model\ContactModel;
use Model\CustomerModel;
use Model\OrderModel;
class ContactController extends Controller{
	public function __construct(){
		if(empty($_SESSION)){
			header("location:/");	
		}
    }

    public function indexAction($params = []){
		$contactModel = new ContactModel();
		if($_SESSION["rol_id"]==1){
			$contactList = $contactModel->all();
		}else{
			$contactList = $contactModel->findBy([
				["user_id",ContactModel::EQUAL,$_SESSION["id"]]
			]);
		}
		return $this->renderHtml("contact/index",["contactList"=>$contactList]);
	}

	public function newAction($params = []){
		$customerModel = new CustomerModel();
		$customerList = [];
		$genCus = $customerModel->all();
		foreach ($genCus as $c) {
			$customerList[] = $c;
		}
		return $this->renderHtml("contact/new",["paramsEvent"=>$params["params"], "customerList"=>$customerList]);
	}

	public function storeAction($params = []){
		$customerModel = new CustomerModel();
		$customer = $customerModel->find($params["post"]["customer_id"]);
		if(empty($customer)){
			throw new \Exception("Cliente no encontrado", 404);
		}
		if($params["post"]["type"]=="Postventa" && !empty($params["post"]["order_id"])){
			$orderModel = new OrderModel();
			$order = $orderModel->find($params["post"]["order_id"]);
			if(empty($order)){
				throw new \Exception("Orden no encontrada", 404);
			}
		}else{
			$params["post"]["order_id"] = "NULL";	
		}

		$params["post"]["user_id"] = $_SESSION["id"];
		$contactModel = new ContactModel();
		$customerList = $contactModel->create($params["post"]);
		header("location:/contact/");
	}

	public function editAction($params = []){
		$contactModel = new ContactModel();
		if($_SESSION["rol_id"]==1){
			$contact = $contactModel->find($params["params"][2]);
		}else{
			$contact = $contactModel->findBy([
				["user_id",ContactModel::EQUAL,$_SESSION["id"]],
				["c.id",ContactModel::EQUAL,$params["params"][2]],
			], true);
		}
		if(empty($contact)){
			throw new \Exception("Evento no encontrado", 404);
		}
		$customerModel = new CustomerModel();
		$customerList = [];
		$genCus = $customerModel->all();
		foreach ($genCus as $c) {
			$customerList[] = $c;
		}
		return $this->renderHtml("contact/edit",["contact"=>$contact->getReturn(), "customerList"=>$customerList]);
	}

	public function updateAction($params = []){
		$contactModel = new ContactModel();
		if($_SESSION["rol_id"]==1){
			$contactS = $contactModel->find($params["params"][2]);
		}else{
			$contactS = $contactModel->findBy([
				["user_id",ContactModel::EQUAL,$_SESSION["id"]],
				["c.id",ContactModel::EQUAL,$params["params"][2]],
			], true);
		}
		if(empty($contactS)){
			throw new \Exception("Evento no encontrado", 404);
		}

		$contact = $contactS->getReturn();

		if($params["post"]["type"]=="Postventa" && !empty($params["post"]["order_id"])){
			$orderModel = new OrderModel();
			$order = $orderModel->find($params["post"]["order_id"]);
			if(empty($order)){
				throw new \Exception("Orden no encontrada", 404);
			}
		}else{
			$params["post"]["order_id"] = "NULL";	
		}
		$customerList = $contactModel->update($params["post"], $contact["id"]);
		header("location:/contact/");
	}
}