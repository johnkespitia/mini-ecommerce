<?php

namespace Controller;

use Model\CustomerModel;
use Model\CarModel;
use Model\ReportGroupModel;
use Model\DailyModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller
{
	public function indexAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Planillas"]["Listar"])) {
			header("location:/");
		}

		$customerModel = new CustomerModel();
		$genCust = $customerModel->all();
		$customerList = [];
		foreach ($genCust as $c) {
			$customerList[] = $c;
		}

		$carModel = new CarModel();
		$genCar = $carModel->all();
		$CarList = [];
		foreach ($genCar as $c) {
			$CarList[] = $c;
		}

		$reportGroupModel = new ReportGroupModel();
		if (!empty($params["post"])) {
			$filters = [];
			$exportXls =  !empty($params["post"]["export-excel"]);
			unset($params["post"]["export-excel"]);
			if (!empty($exportXls)) {
				$this->exportxls($params["post"]);
			}
			foreach ($params["post"] as $field => $value) {
				if ($field == "date_report_min" && !empty($value)) {
					$filters[] = [
						"g.date_report", ReportGroupModel::GTE, $value
					];
				} else if ($field == "date_report_max" && !empty($value)) {
					$filters[] = [
						"g.date_report", ReportGroupModel::LTE, $value
					];
				} else {
					if (!empty($value)) {
						$filters[] = [
							$field, ReportGroupModel::EQUAL, $value
						];
					}
				}
			}
			$reportList = $reportGroupModel->findBy($filters);
		} else {
			$reportList = $reportGroupModel->all();
		}
		return $this->renderHtml("group-report/index", ["reportList" => $reportList, "customerList" => $customerList, "carList" => $CarList]);
	}

	public function newAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Planillas"]["Crear"])) {
			header("location:/");
		}
		$customerModel = new CustomerModel();
		$genCust = $customerModel->all();
		$customerList = [];
		foreach ($genCust as $c) {
			$customerList[] = $c;
		}

		$carModel = new CarModel();
		$genCar = $carModel->all();
		$CarList = [];
		foreach ($genCar as $c) {
			$CarList[] = $c;
		}

		return $this->renderHtml("group-report/new", ["customerList" => $customerList, "carList" => $CarList]);
	}

	public function storeAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Planillas"]["Crear"])) {
			header("location:/");
		}
		$reportGroupModel = new ReportGroupModel();
		if (!$reportGroupModel->create($params["post"])) {
			throw new \Exception("Error al registrar la planilla, verifique la información proporcionada", 403);
		} else {
			header("location:/report/");
		}
	}

	public function updateAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Planillas"]["Editar"])) {
			header("location:/");
		}
		$reportModel = new ReportGroupModel();
		$report = $reportModel->find($params["params"][2]);
		if (empty($report)) {
			throw new \Exception("Planilla no encontrada", 404);
		}
		if (!$reportModel->update($params["post"], $report["id"])) {
			throw new \Exception("Error al actualizar la planilla, verifique la información proporcionada", 403);
		} else {
			header("location:/report/");
		}
	}


	public function editAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Planillas"]["Editar"])) {
			header("location:/");
		}
		$customerModel = new CustomerModel();
		$genCust = $customerModel->all();
		$customerList = [];
		foreach ($genCust as $c) {
			$customerList[] = $c;
		}

		$carModel = new CarModel();
		$genCar = $carModel->all();
		$CarList = [];
		foreach ($genCar as $c) {
			$CarList[] = $c;
		}

		$reportGroupModel = new ReportGroupModel();
		$report = $reportGroupModel->find($params["params"][2]);
		if (empty($report)) {
			throw new \Exception("Planilla no encontrada", 404);
		}
		return $this->renderHtml("group-report/edit", ["customerList" => $customerList, "carList" => $CarList,  "report" => $report]);
	}

	protected function exportxls($filterGroup = [])
	{
		$dailyModel = new DailyModel();
		foreach ($filterGroup as $field => $value) {
			if ($field == "date_report_min" && !empty($value)) {
				$filters[] = [
					"rg.date_report", ReportGroupModel::GTE, $value
				];
			} else if ($field == "date_report_max" && !empty($value)) {
				$filters[] = [
					"rg.date_report", ReportGroupModel::LTE, $value
				];
			} else {
				if (!empty($value)) {
					$filters[] = [
						"rg.{$field}", ReportGroupModel::EQUAL, $value
					];
				}
			}
		}
		$dailyList = $dailyModel->findBy($filters);
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
}
