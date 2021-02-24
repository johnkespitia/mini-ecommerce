<?php

namespace Controller;
use Model\CustomerModel;
use Model\CarModel;
use Model\DailyModel;
use Model\ReportGroupModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller{
	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Planillas"]["Listar"])){
			header("location:/");	
		}
		$reportGroupModel = new ReportGroupModel();
		$reportList = $reportGroupModel->all();
		return $this->renderHtml("group-report/index", ["reportList"=>$reportList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Planillas"]["Crear"])){
			header("location:/");	
		}
		$customerModel = new CustomerModel();
		$genCust = $customerModel->all();
		$customerList=[];
		foreach ($genCust as $c) {
			$customerList[] = $c;
		}
		
		$carModel = new CarModel();
		$genCar = $carModel->all();
		$CarList=[];
		foreach ($genCar as $c) {
			$CarList[] = $c;
		}
		
		return $this->renderHtml("group-report/new", ["customerList"=>$customerList, "carList"=>$CarList]);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Planillas"]["Crear"])){
			header("location:/");	
		}
		$reportGroupModel = new ReportGroupModel();
		if(!$reportGroupModel->create($params["post"])){
			throw new \Exception("Error al registrar la planilla, verifique la información proporcionada", 403);
		}else{
			header("location:/report/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Planillas"]["Editar"])){
			header("location:/");	
		}
		$reportModel = new ReportGroupModel();
		$report = $reportModel->find($params["params"][2]);
		if(empty($report)){
			throw new \Exception("Planilla no encontrada", 404);
		}
		if(!$reportModel->update($params["post"], $report["id"])){
			throw new \Exception("Error al actualizar la planilla, verifique la información proporcionada", 403);
		}else{
			header("location:/report/");
		}
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Planillas"]["Editar"])){
			header("location:/");	
		}
		$customerModel = new CustomerModel();
		$genCust = $customerModel->all();
		$customerList=[];
		foreach ($genCust as $c) {
			$customerList[] = $c;
		}
		
		$carModel = new CarModel();
		$genCar = $carModel->all();
		$CarList=[];
		foreach ($genCar as $c) {
			$CarList[] = $c;
		}
		
		$reportGroupModel = new ReportGroupModel();
		$report = $reportGroupModel->find($params["params"][2]);
		if(empty($report)){
			throw new \Exception("Planilla no encontrada", 404);
		}
		return $this->renderHtml("group-report/edit", ["customerList"=>$customerList, "carList"=>$CarList,  "report"=>$report]);
	}
}