<?php
namespace Controller;
use Model\ContactModel;
use Model\ContactResultModel;
use Model\CustomerModel;
use Model\OrderModel;
use Services\MailService;

class NotificationController extends Controller{

	public function sendreminderAction($params){
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
	
}