<?php

namespace Controller;

use Model\UserModel;
use Services\MailService;

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
			$userModel = new UserModel;
			$userSearch = $userModel->findBy([
				["email",UserModel::CONTAIN,$params["post"]["email"]],
				["password",UserModel::CONTAIN,md5($params["post"]["password"])],
				["status",UserModel::EQUAL,1],
			], true);
			$userAuth = $userSearch->getReturn();
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