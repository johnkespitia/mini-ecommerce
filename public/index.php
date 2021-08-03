<?php
require __DIR__ . '/../vendor/autoload.php';
session_start();
use Controller\ExceptionController;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();

if($_ENV['SITE_ENVIRONMENT']=="DEV"){
	error_reporting(E_ALL);
	ini_set("display_errors",1);
}

$paths = array(__DIR__."/../app/Models/Yaml");
$isDevMode = $_ENV['SITE_ENVIRONMENT']=="DEV";

// the connection configuration
$dbParams = array(
    'driver'   =>"pdo_mysql",
    'host'   => $_ENV["DATABASE_HOST"],
    'user'     => $_ENV["DATABASE_USER"],
    'password' => $_ENV["DATABASE_PASSWORD"],
    'dbname'   => $_ENV["DATABASE_DBNAME"],
);

$config = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);


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
		$handler->setEntityManager($entityManager);
		if(method_exists($handler, $action)){
			echo $handler->$action(["post"=>$_POST, "get"=>$_GET, "params"=>$url]);			
			return;
		}
	}
	$run = new ExceptionController();
	echo $run->errorAction(["error"=>"PAGE NOT FOUND", "code"=> 404]);
} catch (\Exception $e) {
	$run = new ExceptionController();
	echo $run->errorAction(["error"=>$e->getMessage(), "code"=> 500]);
}
