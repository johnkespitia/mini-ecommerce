<?php

namespace Controller;
use Model\CustomerModel;
use Model\CarModel;
use Model\EmployeModel;
use Model\DailyModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DailyController extends Controller{
	public function __construct(){
		if(empty($_SESSION)){
			header("location:/");	
		}
	}
	public function indexAction($params = []){
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
		
		$employeModel = new EmployeModel();
		$genemploye = $employeModel->all();
		$employeList=[];
		foreach ($genemploye as $c) {
			$employeList[] = $c;
		}
		
		$dailyModel = new DailyModel();
		$dailyList = $dailyModel->all();
		return $this->renderHtml("daily/index", ["customerList"=>$customerList, "carList"=>$CarList, "employeList"=>$employeList, "dailyList"=>$dailyList]);
	}

	public function newAction($params = []){
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
		
		$employeModel = new EmployeModel();
		$genemploye = $employeModel->all();
		$employeList=[];
		foreach ($genemploye as $c) {
			$employeList[] = $c;
		}
		return $this->renderHtml("daily/new", ["customerList"=>$customerList, "carList"=>$CarList, "employeList"=>$employeList]);
	}

	public function exportxlsAction($params=[]){
		$dailyModel = new DailyModel();
		$dailyList = $dailyModel->all();
		$spreadsheet = new Spreadsheet();
 
		$spreadsheet->getProperties()
			->setCreator($_ENV["SITE_NAME"])
			->setLastModifiedBy($_ENV["SITE_NAME"])
			->setTitle("Listado completo de reporte diario")
			->setSubject("Listado completo de reporte diario")
			->setDescription(
				"Listado completo de reporte diario"
			)
			->setCategory("Reporte Diario");
		$sheet = $spreadsheet->getActiveSheet(); 
		
		// Set the value of cell A1 
		$sheet->setCellValue("A1", "ID"); 
		$sheet->setCellValue("B1", "Fecha de reporte"); 
		$sheet->setCellValue("C1", "Tipo de Servicio"); 
		$sheet->setCellValue("D1", "Área"); 
		$sheet->setCellValue("E1", "Cliente"); 
		$sheet->setCellValue("F1", "Ciudad Cliente"); 
		$sheet->setCellValue("G1", "NIT/DNI Cliente"); 
		$sheet->setCellValue("H1", "Email Cliente"); 
		$sheet->setCellValue("I1", "Teléfono Cliente"); 
		$sheet->setCellValue("J1", "Dirección Cliente"); 
		$sheet->setCellValue("K1", "Tipo de Vehículo"); 
		$sheet->setCellValue("L1", "Placa Vehículo"); 
		$sheet->setCellValue("M1", "Modelo Vehículo"); 
		$sheet->setCellValue("N1", "Empleado"); 
		$sheet->setCellValue("O1", "Empleado Identificación"); 
		$sheet->setCellValue("P1", "Empleado Email"); 
		$sheet->setCellValue("Q1", "Hora de Inicio AM"); 
		$sheet->setCellValue("R1", "Hora de Final AM"); 
		$sheet->setCellValue("S1", "Tiempo de Almuerzo"); 
		$sheet->setCellValue("T1", "Hora de Inicio PM"); 
		$sheet->setCellValue("U1", "Hora de Final PM"); 
		$sheet->setCellValue("V1", "Horas Trabajadas"); 
		$sheet->setCellValue("W1", "Horas de disponibilidad"); 
		$sheet->setCellValue("X1", "Kilometros Inicio"); 
		$sheet->setCellValue("Y1", "Kilometros final"); 
		$sheet->setCellValue("Z1", "Cantidad de personas"); 
		foreach ($dailyList as $key => $prd) {
			$cellNumber=$key+2; 
			$sheet->setCellValue("A{$cellNumber}", $prd["id"]); 
			$sheet->setCellValue("B{$cellNumber}", $prd["date_report"]); 
			$sheet->setCellValue("C{$cellNumber}", $prd["service_type"]); 
			$sheet->setCellValue("D{$cellNumber}", $prd["area"]); 
			$sheet->setCellValue("E{$cellNumber}", $prd["client_name"]); 
			$sheet->setCellValue("F{$cellNumber}", $prd["client_city"]); 
			$sheet->setCellValue("G{$cellNumber}", $prd["client_dni"]); 
			$sheet->setCellValue("H{$cellNumber}", $prd["client_email"]); 
			$sheet->setCellValue("I{$cellNumber}", $prd["client_phone"]); 
			$sheet->setCellValue("J{$cellNumber}", $prd["client_address"]); 
			$sheet->setCellValue("K{$cellNumber}", $prd["type_car"]); 
			$sheet->setCellValue("K{$cellNumber}", $prd["car_dni"]); 
			$sheet->setCellValue("L{$cellNumber}", $prd["modelo"]); 
			$sheet->setCellValue("M{$cellNumber}", $prd["employe_name"]); 
			$sheet->setCellValue("N{$cellNumber}", $prd["employe_dni"]); 
			$sheet->setCellValue("O{$cellNumber}", $prd["employe_email"]); 
			$sheet->setCellValue("P{$cellNumber}", $prd["time_start_am"]); 
			$sheet->setCellValue("Q{$cellNumber}", $prd["time_end_am"]); 
			$sheet->setCellValue("R{$cellNumber}", $prd["lunch_time"]); 
			$sheet->setCellValue("S{$cellNumber}", $prd["time_start_pm"]); 
			$sheet->setCellValue("T{$cellNumber}", $prd["time_end_pm"]); 
			$sheet->setCellValue("V{$cellNumber}", $prd["worked_hours"]); 
			$sheet->setCellValue("W{$cellNumber}", $prd["abble_hours"]); 
			$sheet->setCellValue("X{$cellNumber}", $prd["km_start"]); 
			$sheet->setCellValue("Y{$cellNumber}", $prd["km_end"]); 
			$sheet->setCellValue("Z{$cellNumber}", $prd["people"]); 
			
		}	
		// Write an .xlsx file  
		$writer = new Xlsx($spreadsheet); 
		
		// Save .xlsx file to the current directory 
		$filePath = $_ENV["STORAGE_FILES"]."/daily/daily-export.xlsx";
		$writer->save($filePath); 
		header("location:/files/daily/daily-export.xlsx");
	}

	public function storeAction($params = []){
		$dailyModel = new DailyModel();
		if(!$dailyModel->create($params["post"])){
			throw new \Exception("Error al registrar el reporte diario, verifique la información proporcionada", 403);
		}else{
			header("location:/daily/");
		}
	}

	public function updateAction($params = []){
		$dailyModel = new DailyModel();
		$daily = $dailyModel->find($params["params"][2]);
		if(empty($daily)){
			throw new \Exception("Reporte no encontrado", 404);
		}
		if(!$dailyModel->update($params["post"], $daily["id"])){
			throw new \Exception("Error al actualizar el reporte, verifique la información proporcionada", 403);
		}else{
			header("location:/daily/");
		}
	}


	public function editAction($params = []){
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
		
		$employeModel = new EmployeModel();
		$genemploye = $employeModel->all();
		$employeList=[];
		foreach ($genemploye as $c) {
			$employeList[] = $c;
		}
		$dailyModel = new DailyModel();
		$daily = $dailyModel->find($params["params"][2]);
		if(empty($daily)){
			throw new \Exception("Reporte diario no encontrado", 404);
		}
		return $this->renderHtml("daily/edit", ["customerList"=>$customerList, "carList"=>$CarList, "employeList"=>$employeList, "daily"=>$daily]);
	}

	public function deleteAction($params = []){
		$dailyModel = new DailyModel();
		$daily = $dailyModel->find($params["params"][2]);
		if(empty($daily)){
			throw new \Exception("Reporte no encontrado", 404);
		}
		if(!$dailyModel->delete($daily["id"])){
			throw new \Exception("Error al eliminar el reporte", 403);
		}else{
			header("location:/daily/");
		}
	}
}