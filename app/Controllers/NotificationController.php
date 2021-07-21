<?php
namespace Controller;
use Model\ContactModel;
use Model\ContactResultModel;
use Model\CustomerModel;
use Model\OrderModel;
use Services\MailService;

class NotificationController extends Controller{


	public function createnewsletterAction($params=[]){
		if(empty($_SESSION)){
			header("location:/");	
		}
		$customerModel = new CustomerModel();
		return $this->renderHtml("notifications/newsletter", $params);
	}
	public function unsuscribeAction($params=[]){
		$customerModel = new CustomerModel();
		$customerResult= $customerModel->findBy([
			["email", CustomerModel::EQUAL, $params["params"][2]]
		], true);
		$customer = $customerResult->getReturn();
		if(empty($customer)){
			return $this->renderEmail("notifications/unsuscribe-locked", ["customer"=>$customer]);
		}
		if(!empty($params["post"])){
			if($params["post"]["confirm"] == "si" && $params["post"]["confirm"] == "si" && $customer["id"] == $params["post"]["id"]){
				$customer["newsletter"]="0";
				$customerModel->update($customer, $customer["id"]);
				return $this->renderEmail("notifications/unsuscribe-confirm", ["customer"=>$customer]);
			}else{
				return $this->renderEmail("notifications/unsuscribe-reject", ["customer"=>$customer]);
			}
		}else{
			if($customer["newsletter"]==1){
				return $this->renderEmail("notifications/unsuscribe", ["customer"=>$customer]);
			}else{
				return $this->renderEmail("notifications/unsuscribe-locked", ["customer"=>$customer]);
			}
		}
	}

	public function sendAction($params=[]){
		if(empty($_SESSION)){
			header("location:/");	
		}
		set_time_limit( 0 );
		$attachments = $this->uploadAttachmentFiles($_FILES["load_file"]);
		$customerModel=new CustomerModel();
		$customerList = $customerModel->findBy([
			["newsletter", CustomerModel::EQUAL, 1]
		]);
		$mailer = new MailService();
		$emailAddresses=[];
		foreach ($attachments as $file) {
			$mailer->addAttachment($file);
		}
		foreach ($customerList as $customer) {
			$contentreplace = str_replace("[[cliente]]", $customer["name"] ,$params["post"]["body"]);
			$content = $this->renderEmail("mail/newsletter",["body"=>$contentreplace, "email"=>$customer["email"]]);
			$mailer->sendMail($customer["email"],$params["post"]["subject"],$content);
		}
		return $this->renderHtml("notifications/newsletter", ["status"=>"ok"]);
	}


	public function sendreminderAction($params=[]){
		set_time_limit( 0 );
		if($params["params"][2]!= md5($_ENV["SITE_HASH"])){
			throw new \Exception("Acceso no autorizado", 403);
		}
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

	protected function uploadAttachmentFiles($files){
		$filesList = [];
		for ($i=0; $i < count($files["name"]); $i++) { 
			$file_name = $files['name'][$i];
			$file_tmp = $files['tmp_name'][$i];
			$nameFile = time().$file_name;
			$filePath=$_ENV["STORAGE_FILES"]."/attachments/".$nameFile;
			move_uploaded_file($file_tmp,$filePath);
			$filesList[]=$filePath;
		}		
		return $filesList;
	}
	
}