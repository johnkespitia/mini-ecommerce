<?php

namespace Controller;

use Model\CarTypeModel;
use Model\CarModel;
use Model\FuelTypeModel;
use Model\ServiceTypeModel;
use Model\BrandModel;
use Model\LineModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CarController extends Controller
{

	public function indexAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Listar"])) {
			header("location:/");
		}
		$carModel = new CarModel();
		$carList = $carModel->all();
		return $this->renderHtml("car/index", ["carList" => $carList]);
	}

	public function newAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Crear"])) {
			header("location:/");
		}
		$carTypeModel = new CarTypeModel();
		$carTypeList = $carTypeModel->findBy([
			["status", CarTypeModel::EQUAL, 1]
		]);

		$BrandModel = new BrandModel();
		$BrandList = $BrandModel->all();
		$ServiceTypeModel = new ServiceTypeModel();
		$ServiceTypeList = $ServiceTypeModel->all();
		$LineModel = new LineModel();
		$LineList = $LineModel->all();
		$FuelTypeModel = new FuelTypeModel();
		$FuelTypeList = $FuelTypeModel->all();


		return $this->renderHtml("car/new", [
			"carTypeList" => $carTypeList, "BrandList" => $BrandList, "ServiceTypeList" => $ServiceTypeList,
			"LineList" => $LineList, "FuelTypeList" => $FuelTypeList
		]);
	}

	public function storeAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Crear"])) {
			header("location:/");
		}
		$carModel = new CarModel();
		if (!$carModel->create($params["post"])) {
			throw new \Exception("No fue posible crear el vehículo, verifique la información proporcionada", 500);
		} else {
			header("location:/car/");
		}
	}

	public function updateAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Editar"])) {
			header("location:/");
		}
		$car = new CarModel();
		$carRes = $car->find($params["params"][2]);
		if (empty($carRes)) {
			throw new \Exception("Vehículo not found", 404);
		}
		if (!$car->update($params["post"], $carRes["id"])) {
			throw new \Exception("No fue posible actualizar el vehículo, verifique la información proporcionada", 500);
		} else {
			header("location:/car/");
		}
	}


	public function editAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Editar"])) {
			header("location:/");
		}
		$carTypeModel = new CarTypeModel();
		$carTypeList = $carTypeModel->findBy([
			["status", CarTypeModel::EQUAL, 1]
		]);
		$Car = new CarModel();
		$user = $Car->find($params["params"][2]);
		if (empty($user)) {
			throw new \Exception("Vehículo no encontrado", 404);
		}
		$BrandModel = new BrandModel();
		$BrandList = $BrandModel->all();
		$ServiceTypeModel = new ServiceTypeModel();
		$ServiceTypeList = $ServiceTypeModel->all();
		$LineModel = new LineModel();
		$LineList = $LineModel->all();
		$FuelTypeModel = new FuelTypeModel();
		$FuelTypeList = $FuelTypeModel->all();
		return $this->renderHtml("car/edit", [
			"customer" => $user, "carTypeList" => $carTypeList, "BrandList" => $BrandList, "ServiceTypeList" => $ServiceTypeList,
			"LineList" => $LineList, "FuelTypeList" => $FuelTypeList
		]);
	}

	public function deleteAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Eliminar"])) {
			header("location:/");
		}
		$CarType = new CarTypeModel();
		$user = $CarType->find($params["params"][2]);
		if (empty($user)) {
			throw new \Exception("Vehículo no encontrado", 404);
		}

		if (!$CarType->delete($user["id"])) {
			throw new \Exception("No fue posible eliminar el vahículo, verifique que no tenga eventos creados", 404);
		} else {
			header("location:/car/");
		}
	}

	public function exportxlsAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Listar"])) {
			header("location:/");
		}
		$carModel = new CarModel();
		$carList = $carModel->all();
		$spreadsheet = new Spreadsheet();

		$spreadsheet->getProperties()
			->setCreator($_ENV["SITE_NAME"])
			->setLastModifiedBy($_ENV["SITE_NAME"])
			->setTitle("Listado completo de Vehículos")
			->setSubject("Listado completo de Vehículos")
			->setDescription(
				"Listado completo de Vehículos"
			)
			->setCategory("Vehículos");
		$sheet = $spreadsheet->getActiveSheet();

		// Set the value of cell A1 
		$sheet->setCellValue("A1", "ID");
		$sheet->setCellValue("B1", "Tipo de Vehículo");
		$sheet->setCellValue("C1", "Placa");
		$sheet->setCellValue("D1", "Modelo");
		$sheet->setCellValue("E1", "Marca");
		$sheet->setCellValue("F1", "Combustible");
		$sheet->setCellValue("G1", "Línea");
		$sheet->setCellValue("H1", "Tipo de Servicio");
		$sheet->setCellValue("I1", "Estado");
		foreach ($carList as $key => $prd) {
			$cellNumber = $key + 2;
			$sheet->setCellValue("A{$cellNumber}", $prd["id"]);
			$sheet->setCellValue("B{$cellNumber}", $prd["type_car"]);
			$sheet->setCellValue("C{$cellNumber}", $prd["dni"]);
			$sheet->setCellValue("D{$cellNumber}", $prd["modelo"]);
			$sheet->setCellValue("E{$cellNumber}", $prd["brand_name"]);
			$sheet->setCellValue("F{$cellNumber}", $prd["fuel_type"]);
			$sheet->setCellValue("G{$cellNumber}", $prd["line_category_name"]);
			$sheet->setCellValue("H{$cellNumber}", $prd["service_type_name"]);
			$sheet->setCellValue("I{$cellNumber}", ($prd["status"] == 1) ? "Activo" : "Inactivo");
		}
		// Write an .xlsx file  
		$writer = new Xlsx($spreadsheet);

		// Save .xlsx file to the current directory 
		$filePath = $_ENV["STORAGE_FILES"] . "/cars/cars-export.xlsx";
		$writer->save($filePath);
		header("location:/files/cars/cars-export.xlsx");
	}

	protected function uploadXls($files)
	{
		$file_name = $_FILES['load_file']['name'];
		$file_tmp = $_FILES['load_file']['tmp_name'];
		$filePath = $_ENV["STORAGE_FILES"] . "/cars/" . time() . $file_name;
		move_uploaded_file($file_tmp, $filePath);
		return $filePath;
	}

	public function loadfileAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Crear"])) {
			header("location:/");
		}
		return $this->renderHtml("car/loadfile", []);
	}


	public function storexlsAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Crear"])) {
			header("location:/");
		}
		$load_file = $this->uploadXls($_FILES);
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($load_file);
		$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		$carTypeModel = new CarTypeModel();
		$customerModel = new CarModel();
		$errorMessage = [];
		$successMessage = [];
		foreach ($sheetData as $key => $value) {
			if ($key == 1) {
				continue;
			}
			$carType = $carTypeModel->findBy([
				["name", CarTypeModel::EQUAL, $value["C"]]
			], true);
			$BrandModel = new BrandModel();
			$Brand = $BrandModel->findBy([
				["name", BrandModel::EQUAL, $value["D"]]
			], true);
			$ServiceTypeModel = new ServiceTypeModel();
			$ServiceType = $ServiceTypeModel->findBy([
				["name", ServiceTypeModel::EQUAL, $value["E"]]
			], true);
			$LineModel = new LineModel();
			$LineList = $LineModel->findBy([
				["name", LineModel::EQUAL, $value["F"]]
			], true);
			$FuelTypeModel = new FuelTypeModel();
			$FuelTypeList = $FuelTypeModel->findBy([
				["name", LineModel::EQUAL, $value["G"]]
			], true);

			if (empty($carType->getReturn())) {
				$errorMessage[$key] = "Tipo de Vehículo inválido, no se pudo insertar, tipo de vehículo no válido";
			} else if (empty($Brand->getReturn())) {
				$errorMessage[$key] = "Marca inválida, no se pudo insertar, tipo de vehículo no válido";
			} else if (empty($ServiceType->getReturn())) {
				$errorMessage[$key] = "Tipo de Servicio inválido, no se pudo insertar, tipo de vehículo no válido";
			} else if (empty($LineList->getReturn())) {
				$errorMessage[$key] = "Línea de Vehículo inválida, no se pudo insertar, tipo de vehículo no válido";
			} else if (empty($FuelTypeList->getReturn())) {
				$errorMessage[$key] = "Combustible inválido, no se pudo insertar, tipo de vehículo no válido";
			} else {
				$data = [
					"dni" => $value["A"],
					"modelo" => $value["B"],
					"car_type" => $carType->getReturn()["id"],
					"brand" => $Brand->getReturn()["id"],
					"fuel_type" => $FuelTypeList->getReturn()["id"],
					"line_category" => $LineList->getReturn()["id"],
					"service_type" => $ServiceType->getReturn()["id"],
					"status" => $value["H"],
				];
				$car=$customerModel->findBy([
					["dni",CarModel::EQUAL, $data["dni"]]
				], true);
				if(empty($car->getReturn())){
					if (!$customerModel->create($data)) {
						$errorMessage[$key] = "tiene errores, no se pudo insertar " . $customerModel->getLastError()[2];
					} else {
						$successMessage[$key] = "Registrado correctamente";
					}
				}else{
					if (!$customerModel->update($data, $car->getReturn()["id"])) {
						$errorMessage[$key] = "tiene errores, no se pudo actualizar " . $customerModel->getLastError()[2];
					} else {
						$successMessage[$key] = "Actualizado correctamente";
					}
				}
				
			}
		}
		return $this->renderHtml("car/loadfile", ["errorMessage" => $errorMessage, "successMessage" => $successMessage]);
	}
}
