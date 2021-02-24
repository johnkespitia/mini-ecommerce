<?php

namespace Controller;

use Model\CityModel;
use Model\DailyModel;
use Model\EmployeModel;
use Model\ReportGroupModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DailyController extends Controller
{
	public function indexAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Planillas"]["Listar"])) {
			header("location:/");
		}
		$modelGroupReport = new ReportGroupModel();
		$group = $modelGroupReport->find($params["params"][2]);

		if (empty($group)) {
			throw new \Exception("Planilla no encontrada", 404);
		}

		$employeModel = new EmployeModel();
		$genemploye = $employeModel->all();
		$employeList = [];
		foreach ($genemploye as $c) {
			$employeList[] = $c;
		}

		$ctyeModel = new CityModel();
		$genCty = $ctyeModel->all();
		$ctyList = [];
		foreach ($genCty as $c) {
			$ctyList[] = $c;
		}


		$dailyModel = new DailyModel();
		$dailyList = $dailyModel->findBy([["d.report_group", DailyModel::EQUAL, $params["params"][2]]]);
		return $this->renderHtml("daily/index", ["ctyList" => $ctyList, "employeList" => $employeList, "dailyList" => $dailyList, "group" => $group]);
	}

	public function newAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Planillas"]["Crear"])) {
			header("location:/");
		}
		$modelGroupReport = new ReportGroupModel();
		$group = $modelGroupReport->find($params["params"][2]);

		if (empty($group)) {
			throw new \Exception("Planilla no encontrada", 404);
		}
		$employeModel = new EmployeModel();
		$genemploye = $employeModel->all();
		$employeList = [];
		foreach ($genemploye as $c) {
			$employeList[] = $c;
		}

		$ctyeModel = new CityModel();
		$genCty = $ctyeModel->all();
		$ctyList = [];
		foreach ($genCty as $c) {
			$ctyList[] = $c;
		}
		return $this->renderHtml("daily/new", ["ctyList" => $ctyList, "employeList" => $employeList, "group" => $group]);
	}

	public function storeAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Planillas"]["Crear"])) {
			header("location:/");
		}
		$dailyModel = new DailyModel();
		if (!$dailyModel->create($params["post"])) {
			throw new \Exception("Error al registrar el reporte diario, verifique la información proporcionada", 403);
		} else {
			header("location:/daily/index/{$params["post"]["report_group"]}");
		}
	}

	public function exportxlsAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Planillas"]["Listar"])) {
			header("location:/");
		}
		$modelGroupReport = new ReportGroupModel();
		$group = $modelGroupReport->find($params["params"][2]);

		if (empty($group)) {
			throw new \Exception("Planilla no encontrada", 404);
		}
		$dailyModel = new DailyModel();
		$dailyList = $dailyModel->findBy([[
			"report_group", DailyModel::EQUAL, $params["params"][2]
		]]);
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
		$sheet->setCellValue("A1", "Planilla #");
		$sheet->setCellValue("B1", "Registro #");
		$sheet->setCellValue("C1", "Fecha de reporte");
		$sheet->setCellValue("D1", "Tipo de Servicio");
		$sheet->setCellValue("E1", "Área");
		$sheet->setCellValue("F1", "Origen");
		$sheet->setCellValue("G1", "Destino");
		$sheet->setCellValue("H1", "Cliente");
		$sheet->setCellValue("I1", "Ciudad Cliente");
		$sheet->setCellValue("J1", "NIT/DNI Cliente");
		$sheet->setCellValue("K1", "Email Cliente");
		$sheet->setCellValue("L1", "Teléfono Cliente");
		$sheet->setCellValue("M1", "Dirección Cliente");
		$sheet->setCellValue("N1", "Tipo de Vehículo");
		$sheet->setCellValue("O1", "Placa Vehículo");
		$sheet->setCellValue("P1", "Modelo Vehículo");
		$sheet->setCellValue("Q1", "Empleado");
		$sheet->setCellValue("R1", "Empleado Identificación");
		$sheet->setCellValue("S1", "Empleado Email");
		$sheet->setCellValue("T1", "Hora de Inicio AM");
		$sheet->setCellValue("U1", "Hora de Final AM");
		$sheet->setCellValue("V1", "Tiempo de Almuerzo");
		$sheet->setCellValue("W1", "Hora de Inicio PM");
		$sheet->setCellValue("X1", "Hora de Final PM");
		$sheet->setCellValue("Y1", "Horas Trabajadas");
		$sheet->setCellValue("Z1", "Horas de disponibilidad");
		$sheet->setCellValue("AA1", "Kilometros Inicio");
		$sheet->setCellValue("AB1", "Kilometros final");
		$sheet->setCellValue("AC1", "Total Kilometros");
		$sheet->setCellValue("AD1", "Cantidad de personas");
		foreach ($dailyList as $key => $prd) {
			$cellNumber = $key + 2;
			$sheet->setCellValue("A{$cellNumber}", $prd["report_group"]);
			$sheet->setCellValue("B{$cellNumber}", $prd["id"]);
			$sheet->setCellValue("C{$cellNumber}",  \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(strtotime($prd["date_report"])));
			$sheet->getStyle("C{$cellNumber}")
				->getNumberFormat()
				->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
			$sheet->setCellValue("D{$cellNumber}", $prd["service_type"]);
			$sheet->setCellValue("E{$cellNumber}", $prd["area"]);
			$sheet->setCellValue("F{$cellNumber}", $prd["origin_name"]);
			$sheet->setCellValue("G{$cellNumber}", $prd["destination_name"]);
			$sheet->setCellValue("H{$cellNumber}", $prd["client_name"]);
			$sheet->setCellValue("I{$cellNumber}", $prd["client_city"]);
			$sheet->setCellValue("J{$cellNumber}", $prd["client_dni"]);
			$sheet->setCellValue("K{$cellNumber}", $prd["client_email"]);
			$sheet->setCellValue("L{$cellNumber}", $prd["client_phone"]);
			$sheet->setCellValue("M{$cellNumber}", $prd["client_address"]);
			$sheet->setCellValue("N{$cellNumber}", $prd["type_car"]);
			$sheet->setCellValue("O{$cellNumber}", $prd["car_dni"]);
			$sheet->setCellValue("P{$cellNumber}", $prd["modelo"]);
			$sheet->setCellValue("Q{$cellNumber}", $prd["employe_name"]);
			$sheet->setCellValue("R{$cellNumber}", $prd["employe_dni"]);
			$sheet->setCellValue("S{$cellNumber}", $prd["employe_email"]);
			$sheet->setCellValue("T{$cellNumber}", $prd["time_start_am"]);
			$sheet->setCellValue("U{$cellNumber}", $prd["time_end_am"]);
			$sheet->setCellValue("V{$cellNumber}", $prd["lunch_time"]);
			$sheet->setCellValue("W{$cellNumber}", $prd["time_start_pm"]);
			$sheet->setCellValue("X{$cellNumber}", $prd["time_end_pm"]);
			$sheet->setCellValue("Y{$cellNumber}", $prd["worked_hours"]);
			$sheet->setCellValue("Z{$cellNumber}", $prd["abble_hours"]);
			$sheet->setCellValue("AA{$cellNumber}", $prd["km_start"]);
			$sheet->setCellValue("AB{$cellNumber}", $prd["km_end"]);
			$sheet->setCellValue("AC{$cellNumber}", $prd["km_end"] - $prd["km_start"]);
			$sheet->setCellValue("AD{$cellNumber}", $prd["people"]);
		}
		// Write an .xlsx file  
		$writer = new Xlsx($spreadsheet);

		// Save .xlsx file to the current directory 
		$filePath = $_ENV["STORAGE_FILES"] . "/daily/daily-export.xlsx";
		$writer->save($filePath);
		header("location:/files/daily/daily-export.xlsx");
	}



	public function updateAction($params = [])
	{
		if(empty($_SESSION["permissions"]["Planillas"]["Editar"])){
			header("location:/");	
		}
		$dailyModel = new DailyModel();
		$daily = $dailyModel->find($params["params"][2]);
		if (empty($daily)) {
			throw new \Exception("Reporte no encontrado", 404);
		}
		if (!$dailyModel->update($params["post"], $daily["id"])) {
			throw new \Exception("Error al actualizar el reporte, verifique la información proporcionada", 403);
		} else {
			header("location:/daily/index/" . $params["post"]["report_group"]);
		}
	}


	public function editAction($params = [])
	{
		if(empty($_SESSION["permissions"]["Planillas"]["Editar"])){
			header("location:/");	
		}
		$employeModel = new EmployeModel();
		$genemploye = $employeModel->all();
		$employeList = [];
		foreach ($genemploye as $c) {
			$employeList[] = $c;
		}

		$ctyeModel = new CityModel();
		$genCty = $ctyeModel->all();
		$ctyList = [];
		foreach ($genCty as $c) {
			$ctyList[] = $c;
		}
		$dailyModel = new DailyModel();
		$daily = $dailyModel->find($params["params"][2]);
		if (empty($daily)) {
			throw new \Exception("Reporte diario no encontrado", 404);
		}
		return $this->renderHtml("daily/edit", ["ctyList" => $ctyList, "employeList" => $employeList, "daily" => $daily]);
	}

	public function deleteAction($params = [])
	{
		if(empty($_SESSION["permissions"]["Planillas"]["Eliminar"])){
			header("location:/");	
		}
		$dailyModel = new DailyModel();
		$daily = $dailyModel->find($params["params"][2]);
		if (empty($daily)) {
			throw new \Exception("Reporte no encontrado", 404);
		}
		if (!$dailyModel->delete($daily["id"])) {
			throw new \Exception("Error al eliminar el reporte", 403);
		} else {
			header("location:/daily/");
		}
	}

	public function storexlsAction($params = [])
	{
		if(empty($_SESSION["permissions"]["Planillas"]["Crear"])){
			header("location:/");	
		}
		$load_file = $this->uploadXls($_FILES);
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($load_file);
		$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, false, true);
		$cityModel = new CityModel();
		$employeModel = new EmployeModel();
		$dailyModel = new DailyModel();
		$groupReportModel = new ReportGroupModel();
		$errorMessage = [];
		$successMessage = [];
		foreach ($sheetData as $key => $value) {
			if ($key == 1) {
				continue;
			}
			$origin = $cityModel->findBy([
				["name", CityModel::EQUAL, $value["C"]]
			], true);
			$destination = $cityModel->findBy([
				["name", CityModel::EQUAL, $value["D"]]
			], true);
			$employee = $employeModel->findBy([
				["dni", EmployeModel::EQUAL, $value["E"]]
			], true);
			$planilla = $groupReportModel->find($value["A"]);

			if (empty($origin->getReturn())) {
				$errorMessage[$key] = "tiene errores, no se pudo insertar Ciudad Origen no válida";
			} elseif (empty($destination->getReturn())) {
				$errorMessage[$key] = "tiene errores, no se pudo insertar Ciudad Destino no válida";
			} elseif (empty($employee->getReturn())) {
				$errorMessage[$key] = "tiene errores, no se pudo insertar Empleado no válido";
			} elseif (empty($planilla)) {
				$errorMessage[$key] = "tiene errores, no se pudo insertar Planilla no válida";
			} else {
				$data = [
					"report_group" => $planilla["id"],
					"origin" => $origin->getReturn()["id"],
					"destination" => $destination->getReturn()["id"],
					"employe" => $employee->getReturn()["id"],
					"date_report" => date("Y-m-d", \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["B"], $_ENV["APP_TIMEZONE"])),
					"time_start_am" => $value["F"],
					"time_end_am" => $value["G"],
					"time_start_pm" => $value["I"],
					"time_end_pm" => $value["J"],
					"lunch_time" => $value["H"],
					"worked_hours" => $value["K"],
					"abble_hours" => $value["L"],
					"km_start" => $value["M"],
					"km_end" => $value["N"],
					"people" => $value["O"],
				];
				if (!$dailyModel->create($data)) {
					$errorMessage[$key] = "tiene errores, no se pudo insertar " . $dailyModel->getLastError()[2];
				} else {
					$successMessage[$key] = "Registrados correctamente";
				}
			}
		}
		return $this->renderHtml("daily/loadfile", ["errorMessage" => $errorMessage, "successMessage" => $successMessage, "group" => $planilla]);
	}

	public function loadfileAction($params = [])
	{
		if(empty($_SESSION["permissions"]["Planillas"]["Crear"])){
			header("location:/");	
		}
		$modelGroupReport = new ReportGroupModel();
		$group = $modelGroupReport->find($params["params"][2]);

		if (empty($group)) {
			throw new \Exception("Planilla no encontrada", 404);
		}
		return $this->renderHtml("daily/loadfile", ["group" => $group]);
	}

	protected function uploadXls($files)
	{
		$file_name = $_FILES['load_file']['name'];
		$file_tmp = $_FILES['load_file']['tmp_name'];
		$filePath = $_ENV["STORAGE_FILES"] . "/daily/" . time() . $file_name;
		move_uploaded_file($file_tmp, $filePath);
		return $filePath;
	}
}
