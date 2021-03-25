<?php

namespace Controller;

use Model\CarTypeModel;
use Model\CarModel;
use Model\FuelTypeModel;
use Model\ServiceTypeModel;
use Model\BrandModel;
use Model\LineModel;
use Model\CarImageModel;
use Model\CarOwnerModel;
use Model\DocumentModel;
use Model\DocumentTypeModel;
use Model\FuelCarModel;
use Model\MaintainceCarModel;
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
		if (!empty($params["get"]["dni"])) {
			$carList = $carModel->findBy([
				["c.dni", CarModel::CONTAIN, $params["get"]["dni"]]
			]);
		} else {
			$carList = $carModel->all();
		}
		return $this->renderHtml("car/index", ["carList" => $carList]);
	}
	public function detailsAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Listar"])) {
			header("location:/");
		}
		$carModel = new CarModel();
		$car = $carModel->find($params["params"][2]);
		if (empty($car)) {
			throw new \Exception("Vehículo no encontrado", 404);
		}


		$documentsModel = new DocumentModel();

		$documents = $documentsModel->findBy([
			["car", CarImageModel::EQUAL, $car["id"]]
		]);

		$imageModel = new CarImageModel;
		$imagesGenerator =  $imageModel->findBy([
			["car", CarImageModel::EQUAL, $car["id"]]
		]);
		$images = [];
		foreach ($imagesGenerator as $value) {
			$images[] = $value;
		}

		$dtModel = new DocumentTypeModel;
		$documentTypeList = $dtModel->all();

		$fuelModel = new FuelCarModel;
		$fuel_list =  $fuelModel->findBy([
			["car", FuelCarModel::EQUAL, $car["id"]]
		]);

		$maintainceModel = new MaintainceCarModel;
		$maintainceList =  $maintainceModel->findBy([
			["car", FuelCarModel::EQUAL, $car["id"]]
		]);

		return $this->renderHtml("car/details", [
			"car" => $car,
			"images" => $images,
			"documentTypeList" => $documentTypeList,
			"documents" => $documents,
			"fuel" => $fuel_list,
			"maintainceList" => $maintainceList
		]);
	}

	public function deleteimageAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Editar"])) {
			header("location:/");
		}

		$carModel = new CarImageModel();
		$carModel->delete($params["params"][2]);
		header("location:/car/details/" . $params["params"][3]);
	}

	public function cancelmaintainceAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Editar"])) {
			header("location:/");
		}

		$carModel = new MaintainceCarModel();
		$carMaintaince = $carModel->find($params["params"][2]);
		if (empty($carMaintaince)) {
			throw new \Exception("Mantenimiento no encontrado", 404);
		}
		$carMaintaince["status"] = 'CANCELADO';
		if (!$carModel->update($carMaintaince, $params["params"][2])) {
			throw new \Exception("Mantenimiento no pudo ser actualizado", 404);
		} else {
			header("location:/car/details/" . $carMaintaince["car"]);
		}
	}

	public function inprocessmaintainceAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Editar"])) {
			header("location:/");
		}

		$carModel = new MaintainceCarModel();
		$carMaintaince = $carModel->find($params["params"][2]);
		if (empty($carMaintaince)) {
			throw new \Exception("Mantenimiento no encontrado", 404);
		}
		$carMaintaince["status"] = 'EN PROCESO';
		if (!$carModel->update($carMaintaince, $params["params"][2])) {
			throw new \Exception("Mantenimiento no pudo ser actualizado", 404);
		} else {
			header("location:/car/details/" . $carMaintaince["car"]);
		}
	}

	public function fillmaintainceAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Editar"])) {
			header("location:/");
		}

		$carModel = new MaintainceCarModel();
		$carMaintaince = $carModel->find($params["params"][2]);
		if (empty($carMaintaince)) {
			throw new \Exception("Mantenimiento no encontrado", 404);
		}
		$carMaintaince["status"] = 'FINALIZADO';
		$carMaintaince["results"] = $params["post"]["results"];
		$carMaintaince["cost"] = $params["post"]["cost"];
		$carMaintaince["date_finished"] = $params["post"]["date_finished"];
		if (!$carModel->update($carMaintaince, $params["params"][2])) {
			throw new \Exception("Mantenimiento no pudo ser actualizado", 404);
		} else {
			header("location:/car/details/" . $carMaintaince["car"]);
		}
	}

	public function deletefileAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Editar"])) {
			header("location:/");
		}

		$carModel = new DocumentModel();
		$carModel->delete($params["params"][2]);
		header("location:/car/details/" . $params["params"][3]);
	}

	public function carimagesAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Listar"])) {
			header("location:/");
		}
		$carModel = new CarImageModel();
		$carList = $carModel->findBy([
			["car", CarImageModel::EQUAL, $params["params"][2]]
		]);
		$carResponse = [];
		foreach ($carList as $value) {
			$carResponse[] = $value;
		}
		return $this->renderJson(["imagesList" => $carResponse]);
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
		$CarOwnerModel = new CarOwnerModel();
		$CarOwnerList = $CarOwnerModel->all();


		return $this->renderHtml("car/new", [
			"carTypeList" => $carTypeList, "BrandList" => $BrandList, "ServiceTypeList" => $ServiceTypeList,
			"LineList" => $LineList, "FuelTypeList" => $FuelTypeList, "CarOwnerList" => $CarOwnerList
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
			if (!empty($params["files"])) {
				$fileName = $this->uploadImg($params["files"]["photo"]);
				$carImageModel = new CarImageModel();
				$carImageModel->create(["car" => $carModel->getLastId(), "url" => $_ENV["SITE_URL"] . "images" . $fileName]);
			}
			header("location:/car/");
		}
	}
	public function storeimageAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Editar"])) {
			header("location:/");
		}
		$carModel = new CarModel();
		$car = $carModel->find($params["params"][2]);
		if (empty($car)) {
			throw new \Exception("Vehículo no encontrado", 404);
		}
		$fileName = $this->uploadImg($params["files"]["photo"]);
		$carImageModel = new CarImageModel();
		$carImageModel->create(["car" => $car["id"], "url" => $_ENV["SITE_URL"] . "images" . $fileName]);
		header("location:/car/details/" . $car["id"]);
	}
	public function storefileAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Editar"])) {
			header("location:/");
		}
		$carModel = new CarModel();
		$car = $carModel->find($params["params"][2]);
		if (empty($car)) {
			throw new \Exception("Vehículo no encontrado", 404);
		}
		$fileName = $this->uploadFile($params["files"]["file"]);
		$params["post"]["url"] = $fileName;
		$params["post"]["car"] = $car["id"];
		$params["post"]["date_created"] = date("Y-m-d");
		$carImageModel = new DocumentModel();
		$carImageModel->create($params["post"]);
		header("location:/car/details/" . $car["id"]);
	}

	public function storefuelAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Editar"])) {
			header("location:/");
		}
		$carModel = new CarModel();
		$car = $carModel->find($params["params"][2]);
		if (empty($car)) {
			throw new \Exception("Vehículo no encontrado", 404);
		}
		$fileName = $this->uploadFile($params["files"]["image"]);
		$params["post"]["image"] = $fileName;
		$params["post"]["car"] = $car["id"];
		$carImageModel = new FuelCarModel();
		if ($carImageModel->create($params["post"])) {
			header("location:/car/details/" . $car["id"]);
		} else {
			throw new \Exception("Error registrando el combustible " . print_r($carImageModel->getLastError(), 1), 404);
		}
	}
	public function storemaintainceAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Vehículos"]["Editar"])) {
			header("location:/");
		}
		$carModel = new CarModel();
		$car = $carModel->find($params["params"][2]);
		if (empty($car)) {
			throw new \Exception("Vehículo no encontrado", 404);
		}
		$params["post"]["car"] = $car["id"];
		$params["post"]["status"] = "PROGRAMADO";
		$carImageModel = new MaintainceCarModel();
		if ($carImageModel->create($params["post"])) {
			header("location:/car/details/" . $car["id"]);
		} else {
			throw new \Exception("Error registrando el mantenimiento " . print_r($carImageModel->getLastError(), 1), 404);
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
		$CarOwnerModel = new CarOwnerModel();
		$CarOwnerList = $CarOwnerModel->all();
		return $this->renderHtml("car/edit", [
			"customer" => $user, "carTypeList" => $carTypeList, "BrandList" => $BrandList, "ServiceTypeList" => $ServiceTypeList,
			"LineList" => $LineList, "FuelTypeList" => $FuelTypeList, "CarOwnerList" => $CarOwnerList
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
		$sheet->setCellValue("I1", "Número Interno");
		$sheet->setCellValue("J1", "Tipo de Relación");
		$sheet->setCellValue("K1", "Cilindraje");
		$sheet->setCellValue("L1", "Color");
		$sheet->setCellValue("M1", "Servicio");
		$sheet->setCellValue("N1", "Tipo de Carrocería");
		$sheet->setCellValue("O1", "Número de Puertas");
		$sheet->setCellValue("P1", "Número de Motor");
		$sheet->setCellValue("Q1", "Vin");
		$sheet->setCellValue("R1", "Número de serie");
		$sheet->setCellValue("S1", "Toneladas Carga");
		$sheet->setCellValue("T1", "Número de Chasis");
		$sheet->setCellValue("U1", "Fecha de Matricula");
		$sheet->setCellValue("V1", "Kilometros para cambio de aceite");
		$sheet->setCellValue("W1", "Propietario");
		$sheet->setCellValue("X1", "Estado");
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
			$sheet->setCellValue("I{$cellNumber}", $prd["internal_number"]);
			$sheet->setCellValue("J{$cellNumber}", $prd["relationship"]);
			$sheet->setCellValue("K{$cellNumber}", $prd["cc"]);
			$sheet->setCellValue("L{$cellNumber}", $prd["color"]);
			$sheet->setCellValue("M{$cellNumber}", $prd["service_permission"]);
			$sheet->setCellValue("N{$cellNumber}", $prd["body_type"]);
			$sheet->setCellValue("O{$cellNumber}", $prd["no_doors"]);
			$sheet->setCellValue("P{$cellNumber}", $prd["no_engine"]);
			$sheet->setCellValue("Q{$cellNumber}", $prd["vin"]);
			$sheet->setCellValue("R{$cellNumber}", $prd["no_serie"]);
			$sheet->setCellValue("S{$cellNumber}", $prd["tn_charge"]);
			$sheet->setCellValue("T{$cellNumber}", $prd["no_chasis"]);
			$sheet->setCellValue("U{$cellNumber}", $prd["date_license"]);
			$sheet->setCellValue("V{$cellNumber}", $prd["oil_change_km"]);
			$sheet->setCellValue("W{$cellNumber}", $prd["owner_name"]);
			$sheet->setCellValue("X{$cellNumber}", ($prd["status"] == 1) ? "Activo" : "Inactivo");
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

	protected function uploadImg($file)
	{
		$fileName = "/cars/" . time() . $file['name'];
		$filePath = $_ENV["STORAGE_IMAGES"]  . $fileName;
		move_uploaded_file($file['tmp_name'], $filePath);
		return $fileName;
	}

	protected function uploadFile($file)
	{
		$fileName = "/cars/docs/" . time() . $file['name'];
		$filePath = $_ENV["STORAGE_FILES"]  . $fileName;
		move_uploaded_file($file['tmp_name'], $filePath);
		return $_ENV["SITE_URL"] . "files/" . $fileName;
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
			$CarOwnerModel = new CarOwnerModel();
			$CarOwner = $CarOwnerModel->findBy([
				["name", LineModel::EQUAL, $value["V"]]
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
			} else if (empty($CarOwner->getReturn())) {
				$errorMessage[$key] = "Propietario inválido, no se pudo insertar, Propietario no encontrado";
			} else {
				$data = [
					"dni" => $value["A"],
					"modelo" => $value["B"],
					"car_type" => $carType->getReturn()["id"],
					"brand" => $Brand->getReturn()["id"],
					"fuel_type" => $FuelTypeList->getReturn()["id"],
					"line_category" => $LineList->getReturn()["id"],
					"service_type" => $ServiceType->getReturn()["id"],
					"car_owner" => $CarOwner->getReturn()["id"],
					"internal_number" => $value["H"],
					"relationship" => $value["I"],
					"cc" => $value["J"],
					"color" => $value["K"],
					"service_permission" => $value["L"],
					"body_type" => $value["M"],
					"no_doors" => $value["N"],
					"no_engine" => $value["O"],
					"vin" => $value["P"],
					"no_serie" => $value["Q"],
					"tn_charge" => $value["R"],
					"no_chasis" => $value["S"],
					"date_license" => date("Y-m-d", \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["T"], $_ENV["APP_TIMEZONE"])),
					"oil_change_km" => $value["U"],
					"status" => $value["W"],
				];
				$car = $customerModel->findBy([
					["c.dni", CarModel::EQUAL, $data["dni"]]
				], true);

				if (empty($car->getReturn())) {
					if (!$customerModel->create($data)) {
						$errorMessage[$key] = "tiene errores, no se pudo insertar " . $customerModel->getLastError()[2];
					} else {
						$successMessage[$key] = "Registrado correctamente";
					}
				} else {
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
