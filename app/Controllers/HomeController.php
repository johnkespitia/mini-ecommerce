<?php

namespace Controller;

use Services\MailService;
use Users;

class HomeController extends Controller{
	public function indexAction($params = []){
		if(empty($_SESSION)){
			return $this->renderHtml("home/login", $params);
		}else{
			return $this->renderHtml("home/index-logged", $params);
		}
		
	}

	public function loginAction($params = []){
		if(!empty($_SESSION)){
			header("location:/");	
		}
		print_r($params);
		if(!empty($params["post"])){
			$userAuth = $this->_entityManager->findOneBy(array('password' => md5($params["post"]["password"])));

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