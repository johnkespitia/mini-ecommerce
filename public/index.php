<?php
require __DIR__ . '/../vendor/autoload.php';
use Controller\ExceptionController;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();
error_reporting(E_ALL);
ini_set("display_errors",1);
$environment = $_ENV['SITE_ENVIRONMENT'];
try {
	$url = isset($_SERVER["PATH_INFO"])? explode('/', ltrim($_SERVER["PATH_INFO"],'/')):"/";
	$controller = "Controller\\".$_ENV['DEFAULT_CONTROLLER']."Controller";	
	$action = $_ENV['DEFAULT_ACTION']."Action";	
	if(!empty($url[0]) && $url[0]!="/"){
		$controller = "Controller\\".ucfirst($url[0])."Controller";	
	}
	if(!empty($url[1])){
		$action = $url[1]."Action";
	}
	if(class_exists($controller)){
		$handler = new $controller();
		if(method_exists($handler, $action)){
			echo $handler->$action();			
			return;
		}
	}
	$run = new ExceptionController();
	echo $run->errorAction(["error"=>"PAGE NOT FOUND", "code"=> 404]);
} catch (\Exception $e) {
	$run = new ExceptionController();
	echo $run->errorAction(["error"=>$e->getMessage(), "code"=> 500]);
}
