<?php

namespace Controller;

use Model\FuelCarModel;
use Model\CarModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FuelController extends Controller
{

	public function indexAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Combustible"]["Listar"])) {
			header("location:/");
		}
		$carModel = new CarModel();
		$genCar = $carModel->all();
		$CarList = [];
		foreach ($genCar as $c) {
			$CarList[] = $c;
		}
		$FuelCarModel = new FuelCarModel();
		if (!empty($params["post"])) {
			$filters = [];
			$exportXls =  !empty($params["post"]["export-excel"]);
			unset($params["post"]["export-excel"]);
			foreach ($params["post"] as $field => $value) {
				if ($field == "date_report_min" && !empty($value)) {
					$filters[] = [
						"date_fuel", FuelCarModel::GTE, $value
					];
				} else if ($field == "date_report_max" && !empty($value)) {
					$filters[] = [
						"date_fuel", FuelCarModel::LTE, $value
					];
				} else {
					if (!empty($value)) {
						$filters[] = [
							$field, FuelCarModel::EQUAL, $value
						];
					}
				}
			}
			$reportList = $FuelCarModel->findBy($filters);
			if (!empty($exportXls)) {
				$this->exportxls($reportList);
			}
		} else {
			$reportList = $FuelCarModel->all();
			return $this->renderHtml("fuel/index", ["employeesList" => $reportList, "CarList" => $CarList]);
		}
	}

	public function newAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Combustible"]["Crear"])) {
			header("location:/");
		}
		return $this->renderHtml("fuel/new", []);
	}

	public function deleteAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Combustible"]["Editar"])) {
			header("location:/");
		}
		$FuelCarModel = new FuelCarModel();
		$FuelCarModel->delete($params["params"][2]);
		header("location:/fuel/");
	}

	public function storeAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Combustible"]["Crear"])) {
			header("location:/");
		}
		$FuelCarModel = new FuelCarModel();
		if (!$FuelCarModel->create($params["post"])) {
			throw new \Exception("No fue posible crear el empleado, verifique la información proporcionada", 500);
		} else {
			header("location:/fuel/");
		}
	}

	public function updateAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Combustible"]["Editar"])) {
			header("location:/");
		}
		$employe = new FuelCarModel();
		$employeRes = $employe->find($params["params"][2]);
		if (empty($employeRes)) {
			throw new \Exception("Empleado no encontrado", 404);
		}
		if (!$employe->update($params["post"], $employeRes["id"])) {
			throw new \Exception("No fue posible actualizar el Empleado, verifique la información proporcionada", 500);
		} else {
			header("location:/employe/");
		}
	}


	public function editAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Combustible"]["Editar"])) {
			header("location:/");
		}
		$employe = new FuelCarModel();
		$user = $employe->find($params["params"][2]);
		if (empty($user)) {
			throw new \Exception("Empleado no encontrado", 404);
		}
		return $this->renderHtml("fuel/edit", ["customer" => $user]);
	}



	protected function uploadXls($files)
	{
		$file_name = $files['name'];
		$file_tmp = $files['tmp_name'];
		$filePath = $_ENV["STORAGE_FILES"] . "/fuel/" . time() . $file_name;
		move_uploaded_file($file_tmp, $filePath);
		return $filePath;
	}

	public function loadfileAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Combustible"]["Crear"])) {
			header("location:/");
		}
		return $this->renderHtml("fuel/loadfile", []);
	}


	public function storexlsAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Combustible"]["Crear"])) {
			header("location:/");
		}
		$load_file = $this->uploadXls($params["files"]["load_file"]);
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($load_file);
		$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		$FuelCarModel = new FuelCarModel();
		$CarModel = new CarModel();
		$errorMessage = [];
		$successMessage = [];
		foreach ($sheetData as $key => $value) {
			if ($key == 1) {
				continue;
			}
			$carValid = $CarModel->findBy([
				["c.dni", CarModel::EQUAL, $value["C"]]
			], true);
			if (empty($carValid->getReturn())) {
				$errorMessage[$key] = "tiene errores, no se pudo insertar, vehículo no encontrado ";
			} else {
				$timestampDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["B"], $_ENV["APP_TIMEZONE"]);
				if ($timestampDate < 0) {
					$timestampDate = strtotime($value["B"]);
				}
				$data = [
					"provider" => $value["A"],
					"date_fuel" => date("Y-m-d", $timestampDate),
					"car" => $carValid->getReturn()["id"],
					"article_code" => $value["D"],
					"ticket" => $value["E"],
					"vale" => $value["F"],
					"value" => $value["G"],
					"quantity" => $value["H"],
					"full" => $value["I"],
					"observations" => $value["J"],
					"image" => "",
				];
				if (!$FuelCarModel->create($data)) {
					$errorMessage[$key] = "tiene errores, no se pudo insertar " . $FuelCarModel->getLastError()[2];
				} else {
					$successMessage[$key] = "Registrado correctamente";
				}
			}
		}
		return $this->renderHtml("fuel/loadfile", ["errorMessage" => $errorMessage, "successMessage" => $successMessage]);
	}

	protected function exportxls($filterData = [])
	{
		$spreadsheet = new Spreadsheet();
		$spreadsheet->getProperties()
			->setCreator($_ENV["SITE_NAME"])
			->setLastModifiedBy($_ENV["SITE_NAME"])
			->setTitle("Listado completo de cargues de combustible")
			->setSubject("Listado completo de cargues de combustible")
			->setDescription(
				"Listado completo de cargues de combustible"
			)
			->setCategory("cargues de combustible");
		$sheet = $spreadsheet->getActiveSheet();

		// Set the value of cell A1 
		$sheet->setCellValue("A1", "#");
		$sheet->setCellValue("B1", "Vehículo");
		$sheet->setCellValue("C1", "Fecha de Tanqueo");
		$sheet->setCellValue("D1", "Proveedor");
		$sheet->setCellValue("E1", "Combustible");
		$sheet->setCellValue("F1", "Articulo");
		$sheet->setCellValue("G1", "Cantidad (GLS)");
		$sheet->setCellValue("H1", "Tanque lleno");
		$sheet->setCellValue("I1", "# Tiquete");
		$sheet->setCellValue("J1", "# Vale");
		$sheet->setCellValue("K1", "Archivo Tiquete");
		$sheet->setCellValue("L1", "Observaciones");
		foreach ($filterData as $key => $prd) {
			$cellNumber = $key + 2;
			$sheet->setCellValue("A{$cellNumber}", $prd["id"]);
			$sheet->setCellValue("B{$cellNumber}", $prd["dni"]);
			$sheet->setCellValue("C{$cellNumber}",  \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(strtotime($prd["date_fuel"])));
			$sheet->getStyle("C{$cellNumber}")
				->getNumberFormat()
				->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
			$sheet->setCellValue("D{$cellNumber}", $prd["provider"]);
			$sheet->setCellValue("E{$cellNumber}", $prd["fuel_type_name"]);
			$sheet->setCellValue("F{$cellNumber}", $prd["article_code"]);
			$sheet->setCellValue("G{$cellNumber}", $prd["quantity"]);
			$sheet->setCellValue("H{$cellNumber}", ($prd["full"] == 1) ? "SI" : "NO");
			$sheet->setCellValue("I{$cellNumber}", $prd["ticket"]);
			$sheet->setCellValue("J{$cellNumber}", $prd["vale"]);
			$sheet->setCellValue("K{$cellNumber}", $prd["image"]);
			$sheet->setCellValue("L{$cellNumber}", $prd["observations"]);
		}
		// Write an .xlsx file  
		$writer = new Xlsx($spreadsheet);

		// Save .xlsx file to the current directory 
		$filePath = $_ENV["STORAGE_FILES"] . "/fuel/fuel-export.xlsx";
		$writer->save($filePath);
		header("location:/files/fuel/fuel-export.xlsx");
	}
}
