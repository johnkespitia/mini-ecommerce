<?php
namespace Controller;
use Model\ContactModel;
use Model\ContactResultModel;
use Model\CustomerModel;
use Model\OrderModel;
use Services\MailService;

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
			if($customer["id"]!=$order["customer_id"]){
				throw new \Exception("Orden no corresponde al cliente", 404);
			}
		}else{
			$params["post"]["order_id"] = "NULL";	
		}
		if(strtotime($params["post"]["datetime_start"])>=strtotime($params["post"]["datetime_end"])){
			throw new \Exception("La Fecha de Fin debe ser mayor a la fecha de inicio", 401);
		}
		$params["post"]["user_id"] = $_SESSION["id"];
		$contactModel = new ContactModel();
		if(!$contactModel->create($params["post"])){
			throw new \Exception("Error al crear el evento, verifique la información proporcionada", 403);
		}else{
			$this->repeatedEvents($params["post"]["repeat_times"],$params["post"]["repeat_period"],$params["post"]);
			header("location:/contact/");
		}
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
		return $this->renderHtml("contact/edit",["contact"=>$contact, "customerList"=>$customerList]);
	}

	public function updateAction($params = []){
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
			if($customer["id"]!=$order["customer_id"]){
				throw new \Exception("Orden no corresponde al cliente", 404);
			}
		}else{
			$params["post"]["order_id"] = "NULL";	
		}
		if(strtotime($params["post"]["datetime_start"])>=strtotime($params["post"]["datetime_end"])){
			throw new \Exception("La Fecha de Fin debe ser mayor a la fecha de inicio", 401);
		}
		if(!$contactModel->update($params["post"], $contact["id"])){
			throw new \Exception("Error al editar el evento, verifique la información proporcionada", 403);
		}else{
			header("location:/contact/");
		}
	}

	public function customerAction($params = []){
		$customerModel = new CustomerModel();
		$customer = $customerModel->find($params["params"][2]);
		if(empty($customer)){
			throw new \Exception("Cliente no encontrado", 404);
		}
		$contactModel = new ContactModel();
		if($_SESSION["rol_id"]==1){
			$contactList = $contactModel->findBy([
				["c.customer_id",ContactModel::EQUAL,$params["params"][2]]
			]);
		}else{
			$contactList = $contactModel->findBy([
				["user_id",ContactModel::EQUAL,$_SESSION["id"]],
				["c.customer_id",ContactModel::EQUAL,$params["params"][2]]
			]);
		}
		return $this->renderHtml("contact/customer",["contactList"=>$contactList, "customer"=>$customer]);
	}

	public function orderAction($params = []){
		$orderModel = new OrderModel();
		$order = $orderModel->find($params["params"][2]);
		if(empty($order)){
			throw new \Exception("Pedido no encontrado", 404);
		}
		$contactModel = new ContactModel();
		if($_SESSION["rol_id"]==1){
			$contactList = $contactModel->findBy([
				["order_id",ContactModel::EQUAL,$params["params"][2]]
			]);
		}else{
			$contactList = $contactModel->findBy([
				["user_id",ContactModel::EQUAL,$_SESSION["id"]],
				["order_id",ContactModel::EQUAL,$params["params"][2]]
			]);
		}
		return $this->renderHtml("contact/order",["contactList"=>$contactList, "order"=>$order]);
	}

	public function resultsAction($params = []){
		$contactModel = new ContactModel();
		if($_SESSION["rol_id"]==1){
			$contact = $contactModel->find($params["params"][2]);
		}else{
			$contact = $contactModel->findBy([
				["user_id",ContactModel::EQUAL,$_SESSION["id"]],
				["order_id",ContactModel::EQUAL,$params["params"][2]]
			],true);
		}
		if(empty($contact)){
			throw new \Exception("Evento no encontrado", 404);
		}

		$resultModel = new ContactResultModel();
		$resultsList = $resultModel->findBy([
			["contact_id",ContactResultModel::EQUAL,$contact["id"]]
		]);


		return $this->renderHtml("contact/results",["contact"=>$contact, "resultsList"=>$resultsList]);
	}

	public function newresultAction($params = []){
		$contactModel = new ContactModel();
		if($_SESSION["rol_id"]==1){
			$contact = $contactModel->find($params["params"][2]);
		}else{
			$contact = $contactModel->findBy([
				["user_id",ContactModel::EQUAL,$_SESSION["id"]],
				["order_id",ContactModel::EQUAL,$params["params"][2]]
			],true);
		}
		if(empty($contact)){
			throw new \Exception("Evento no encontrado", 404);
		}

		return $this->renderHtml("contact/newresult",["contact"=>$contact]);
	}

	public function storeresultAction($params = []){
		$contactModel = new ContactModel();
		if($_SESSION["rol_id"]==1){
			$contact = $contactModel->find($params["params"][2]);
		}else{
			$contact = $contactModel->findBy([
				["user_id",ContactModel::EQUAL,$_SESSION["id"]],
				["id",ContactModel::EQUAL,$params["params"][2]]
			],true);
		}
		if(empty($contact)){
			throw new \Exception("Evento no encontrado", 404);
		}

		$params["post"]["user_id"]=$_SESSION["id"];
		$params["post"]["contact_id"]=$contact["id"];
		$resultModel = new ContactResultModel();
		if(!$resultModel->create($params["post"])){
			throw new \Exception("Error creando el seguimiento, valide los datos", 401);
		}else{
			header("location:/contact/results/{$contact["id"]}");
		}
	}
	
	public function editresultAction($params = []){
		$resultModel = new ContactResultModel();
		if($_SESSION["rol_id"]==1){
			$contactResult = $resultModel->find($params["params"][2]);
		}else{
			$contactResult = $resultModel->findBy([
				["user_id",ContactModel::EQUAL,$_SESSION["id"]],
				["id",ContactModel::EQUAL,$params["params"][2]]
			],true);
		}
		if(empty($contactResult)){
			throw new \Exception("Seguimiento no encontrado", 404);
		}

		return $this->renderHtml("contact/editresult",["contactResult"=>$contactResult]);
	}

	public function updateresultAction($params = []){
		$resultModel = new ContactResultModel();
		if($_SESSION["rol_id"]==1){
			$contactResult = $resultModel->find($params["params"][2]);
		}else{
			$contactResult = $resultModel->findBy([
				["user_id",ContactModel::EQUAL,$_SESSION["id"]],
				["id",ContactModel::EQUAL,$params["params"][2]]
			],true);
		}
		if(empty($contactResult)){
			throw new \Exception("Seguimiento no encontrado", 404);
		}

		$params["post"]["user_id"]=$contactResult["user_id"];
		$params["post"]["contact_id"]=$contactResult["contact_id"];
		$resultModel = new ContactResultModel();
		if(!$resultModel->update($params["post"],$contactResult["id"])){
			throw new \Exception("Error actualizando el seguimiento, valide los datos", 401);
		}else{
			header("location:/contact/results/{$contactResult["contact_id"]}");
		}
	}

	protected function repeatedEvents($times, $periods, $data){
		$contactModel = new ContactModel();
		for ($i=0; $i < $times; $i++) { 
			$data["datetime_start"]=date('Y-m-d H:i:s', strtotime($data["datetime_start"]. ' + '.$periods.' days'));
			$data["datetime_end"]=date('Y-m-d H:i:s', strtotime($data["datetime_end"]. ' + '.$periods.' days'));
			$data["repeat_period"] = 0;
			$data["repeat_times"] = 0;
			$contactModel->create($data);
		}
	}	
}