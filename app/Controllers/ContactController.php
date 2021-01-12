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

		$params["post"]["user_id"] = $_SESSION["id"];
		$contactModel = new ContactModel();
		$customerList = $contactModel->create($params["post"]);
		$this->repeatedEvents($params["post"]["repeat_times"],$params["post"]["repeat_period"],$params["post"]);
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
		$customerList = $contactModel->update($params["post"], $contact["id"]);
		header("location:/contact/");
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
			throw new \Exception("Error creando el seguimiento, valide los datos", 401);
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

	public function sendreminderAction($params){
		$contactModel = new ContactModel();
		$dateFilter=date("Y-m-d H:i:00");
		$mailer = new MailService();
		//<option value='10 minutos'>10 minutos antes</option>
		echo "Sending reminder 10 mins<br>";
		$contactResult = $contactModel->findBy([
			["datetime_start",ContactModel::EQUAL, date('Y-m-d H:i:s', strtotime($dateFilter. '+ 10 minutes'))]
		]);
		foreach ($contactResult as $contact) {
			$content = $this->renderEmail("mail/reminder",["contact"=>$contact]);
			$title="Recordatorio de evento con {$contact["customer"]} por medio de {$contact["method"]} dentro de {$contact["reminder"]}";
			$mailer->sendMail($contact["user_email"],$title,$content);
		}
		//<option value='1 hora'>1 hora antes</option>
		echo "Sending reminder 1 hour<br>";
		$contactResult = $contactModel->findBy([
			["datetime_start",ContactModel::EQUAL, date('Y-m-d H:i:s', strtotime($dateFilter. '+ 1 hour'))]
		]);
		foreach ($contactResult as $contact) {
			$content = $this->renderEmail("mail/reminder",["contact"=>$contact]);
			$title="Recordatorio de evento con {$contact["customer"]} por medio de {$contact["method"]} dentro de {$contact["reminder"]}";
			$mailer->sendMail($contact["user_email"],$title,$content);
		}
		//<option value='1 día'>1 día antes</option>
		echo "Sending reminder 1 day<br>";
		$contactResult = $contactModel->findBy([
			["datetime_start",ContactModel::EQUAL, date('Y-m-d H:i:s', strtotime($dateFilter. '+ 1 day'))]
		]);
		foreach ($contactResult as $contact) {
			$content = $this->renderEmail("mail/reminder",["contact"=>$contact]);
			$title="Recordatorio de evento con {$contact["customer"]} por medio de {$contact["method"]} dentro de {$contact["reminder"]}";
			$mailer->sendMail($contact["user_email"],$title,$content);
		}
		//<option value='2 días'>2 días antes</option>
		echo "Sending reminder 2 days<br>";
		$contactResult = $contactModel->findBy([
			["datetime_start",ContactModel::EQUAL, date('Y-m-d H:i:s', strtotime($dateFilter. '+ 2 days'))]
		]);
		foreach ($contactResult as $contact) {
			$content = $this->renderEmail("mail/reminder",["contact"=>$contact]);
			$title="Recordatorio de evento con {$contact["customer"]} por medio de {$contact["method"]} dentro de {$contact["reminder"]}";
			$mailer->sendMail($contact["user_email"],$title,$content);
		}
		//<option value='3 días'>3 días antes</option>
		echo "Sending reminder 3 days<br>";
		$contactResult = $contactModel->findBy([
			["datetime_start",ContactModel::EQUAL, date('Y-m-d H:i:s', strtotime($dateFilter. '+ 3 days'))]
		]);
		foreach ($contactResult as $contact) {
			$content = $this->renderEmail("mail/reminder",["contact"=>$contact]);
			$title="Recordatorio de evento con {$contact["customer"]} por medio de {$contact["method"]} dentro de {$contact["reminder"]}";
			$mailer->sendMail($contact["user_email"],$title,$content);
		}
		die;
	}
	
}