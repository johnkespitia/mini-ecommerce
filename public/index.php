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
	$controller = "Controller\\".ucfirst($url[0])."Controller";
	$action = $url[1]."Action";
	if(class_exists($controller)){
		$handler = new $controller();
		if(method_exists($handler, $action)){
			echo $handler->$action();			
			return;
		}
	}
	$run = new ExceptionController();
	echo $run->errorAction(["error"=>"PAGE NOT FOUND"]);
} catch (\Exception $e) {
	$run = new ExceptionController();
	echo $run->errorAction(["error"=>$e->getMessage()]);
}
