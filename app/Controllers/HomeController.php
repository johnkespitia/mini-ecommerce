<?php

namespace Controller;

use Services\MailService;
use Users;

class HomeController extends Controller{
	public function indexAction($params = []){
		if(empty($_SESSION)){
			return $this->renderHtml("home/index", $params);
		}else{
			return $this->renderHtml("home/index-logged", $params);
		}
		
	}

	public function testemailAction($params = []){
		if(empty($_SESSION)){
			return $this->renderHtml("home/index", $params);
		}else{
			$mailer = new MailService();
			$content = $this->renderEmail("mail/test",[]);
			$mailer->testMail($_ENV["MAILER_USERNAME"],"test mail",$content);
		}
		
	}

	public function loginAction($params = []){
		if(!empty($_SESSION)){
			header("location:/");	
		}
		if(!empty($params["post"])){
			$userAuth = $this->_entityManager->findOneBy(array('password' => $params["post"]["password"]));
			print_r($userAuth); die;
			if(!empty($userAuth)){
				unset($userAuth["password"]);
				$_SESSION=$userAuth;
				header("location:/");
			}else{
				$params["errors"]="User not found";
			}
		}
		return $this->renderHtml("home/login", $params);
	}

	public function logoutAction($params = []){
		session_destroy();
		header("location:/");
	}
}