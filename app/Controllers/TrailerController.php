<?php

namespace Controller;

use Model\TrailerTypeModel;
use Model\TrailerModel;
use Model\BrandModel;
use Model\TrailerImageModel;
use Model\ContractorModel;
use Model\DailyModel;
use Model\DocumentModel;
use Model\DocumentTypeModel;
use Model\FuelTrailerModel;
use Model\MaintainceTrailerModel;
use Model\NotificationTrailerModel;
use Model\NotificationTypeModel;
use Model\TrailerDocumentModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TrailerController extends Controller
{

	public function indexAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Listar"])) {
			header("location:/");
		}
		$TrailerModel = new TrailerModel();
		if (!empty($params["get"]["dni"])) {
			$carList = $TrailerModel->findBy([
				["c.dni", TrailerModel::CONTAIN, $params["get"]["dni"]]
			]);
		} else {
			$carList = $TrailerModel->all();
		}
		return $this->renderHtml("trailer/index", ["carList" => $carList]);
	}

	public function newAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Crear"])) {
			header("location:/");
		}
		$TrailerTypeModel = new TrailerTypeModel();
		$carTypeList = $TrailerTypeModel->all();

		$BrandModel = new BrandModel();
		$BrandList = $BrandModel->all();
		$ContractorModel = new ContractorModel();
		$CarOwnerList = $ContractorModel->all();

		return $this->renderHtml("trailer/new", [
			"carTypeList" => $carTypeList, "BrandList" => $BrandList,
			"CarOwnerList" => $CarOwnerList
		]);
	}

	public function storeAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Crear"])) {
			header("location:/");
		}
		$TrailerModel = new TrailerModel();
		if (!$TrailerModel->create($params["post"])) {
			throw new \Exception("No fue posible crear el Trailer, verifique la información proporcionada", 500);
		} else {
			header("location:/trailer/");
		}
	}

	public function loadfileAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Crear"])) {
			header("location:/");
		}
		return $this->renderHtml("trailer/loadfile", []);
	}


	public function storexlsAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Crear"])) {
			header("location:/");
		}
		$load_file = $this->uploadXls($_FILES);
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($load_file);
		$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		$TrailerTypeModel = new TrailerTypeModel();
		$customerModel = new TrailerModel();
		$errorMessage = [];
		$successMessage = [];
		foreach ($sheetData as $key => $value) {
			if ($key == 1) {
				continue;
			}
			$carType = $TrailerTypeModel->findBy([
				["name", TrailerTypeModel::EQUAL, $value["L"]]
			], true);
			$BrandModel = new BrandModel();
			$Brand = $BrandModel->findBy([
				["name", BrandModel::EQUAL, $value["E"]]
			], true);
			$ContractorModel = new ContractorModel();
			$CarOwner = $ContractorModel->findBy([
				["name", ContractorModel::EQUAL, $value["M"]]
			], true);

			if (empty($carType->getReturn())) {
				$errorMessage[$key] = "Tipo de Trailer inválido, no se pudo insertar, tipo de Trailer no válido";
			} else if (empty($Brand->getReturn())) {
				$errorMessage[$key] = "Marca inválida, no se pudo insertar, tipo de Trailer no válido";
			} else if (empty($CarOwner->getReturn())) {
				$errorMessage[$key] = "Propietario inválido, no se pudo insertar, Propietario no encontrado";
			} else {
				$data = [
					"dni" => $value["A"],
					"register_code" => $value["B"],
					"register_date" => date("Y-m-d", \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["C"], $_ENV["APP_TIMEZONE"])),
					"register_city" => $value["D"],
					"brand" => $Brand->getReturn()["id"],
					"cover" => $value["F"],
					"model" => $value["G"],
					"color" => $value["H"],
					"dni_color" => $value["I"],
					"axis_number" => $value["J"],
					"weight_capacity" => $value["K"],
					"type" => $carType->getReturn()["id"],
					"contractor" => $CarOwner->getReturn()["id"],
					"status" => $value["N"],
				];
				$car = $customerModel->findBy([
					["c.dni", TrailerModel::EQUAL, $data["dni"]]
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
		return $this->renderHtml("trailer/loadfile", ["errorMessage" => $errorMessage, "successMessage" => $successMessage]);
	}

	public function exportxlsAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Listar"])) {
			header("location:/");
		}
		$TrailerModel = new TrailerModel();
		$carList = $TrailerModel->all();
		$spreadsheet = new Spreadsheet();

		$spreadsheet->getProperties()
			->setCreator($_ENV["SITE_NAME"])
			->setLastModifiedBy($_ENV["SITE_NAME"])
			->setTitle("Listado completo de Trailer")
			->setSubject("Listado completo de Trailer")
			->setDescription(
				"Listado completo de Trailer"
			)
			->setCategory("Trailer");
		$sheet = $spreadsheet->getActiveSheet();

		// Set the value of cell A1 
		$sheet->setCellValue("A1", "ID");
		$sheet->setCellValue("B1", "Tipo de Trailer");
		$sheet->setCellValue("C1", "Placa");
		$sheet->setCellValue("D1", "Código de registro");
		$sheet->setCellValue("E1", "Fecha de registro");
		$sheet->setCellValue("F1", "Ciudad de registro");
		$sheet->setCellValue("G1", "Marca");
		$sheet->setCellValue("H1", "Revestimiento");
		$sheet->setCellValue("I1", "Modelo");
		$sheet->setCellValue("J1", "Color");
		$sheet->setCellValue("K1", "Color de placa");
		$sheet->setCellValue("L1", "Número de ejes");
		$sheet->setCellValue("M1", "Capacidad Toneladas");
		$sheet->setCellValue("N1", "Contratista");
		$sheet->setCellValue("O1", "Estado");
		foreach ($carList as $key => $prd) {
			$cellNumber = $key + 2;
			$sheet->setCellValue("A{$cellNumber}", $prd["id"]);
			$sheet->setCellValue("B{$cellNumber}", $prd["type_trailer"]);
			$sheet->setCellValue("C{$cellNumber}", $prd["dni"]);
			$sheet->setCellValue("D{$cellNumber}", $prd["register_code"]);
			$sheet->setCellValue("E{$cellNumber}", $prd["register_date"]);
			$sheet->setCellValue("F{$cellNumber}", $prd["register_city"]);
			$sheet->setCellValue("G{$cellNumber}", $prd["brand_name"]);
			$sheet->setCellValue("H{$cellNumber}", $prd["cover"]);
			$sheet->setCellValue("I{$cellNumber}", $prd["model"]);
			$sheet->setCellValue("J{$cellNumber}", $prd["color"]);
			$sheet->setCellValue("K{$cellNumber}", $prd["dni_color"]);
			$sheet->setCellValue("L{$cellNumber}", $prd["axis_number"]);
			$sheet->setCellValue("M{$cellNumber}", $prd["weight_capacity"]);
			$sheet->setCellValue("N{$cellNumber}", $prd["contractor_name"]);
			$sheet->setCellValue("O{$cellNumber}", ($prd["status"] == 1) ? "Activo" : "Inactivo");
		}
		// Write an .xlsx file  
		$writer = new Xlsx($spreadsheet);

		// Save .xlsx file to the current directory 
		$filePath = $_ENV["STORAGE_FILES"] . "/trailer/trailer-export.xlsx";
		$writer->save($filePath);
		header("location:/files/trailer/trailer-export.xlsx");
	}

	public function trailerimagesAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Listar"])) {
			header("location:/");
		}
		$TrailerModel = new TrailerImageModel();
		$carList = $TrailerModel->findBy([
			["trailer", TrailerImageModel::EQUAL, $params["params"][2]]
		]);
		$carResponse = [];
		foreach ($carList as $value) {
			$carResponse[] = $value;
		}
		return $this->renderJson(["imagesList" => $carResponse]);
	}

	public function detailsAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Listar"])) {
			header("location:/");
		}
		$TrailerModel = new TrailerModel();
		$car = $TrailerModel->find($params["params"][2]);
		if (empty($car)) {
			throw new \Exception("Trailer no encontrado", 404);
		}

		$documentsModel = new TrailerDocumentModel();

		$documentsGen = $documentsModel->findBy([
			["d.trailer", TrailerDocumentModel::EQUAL, $car["id"]]
		]);

		$docsExpired = [];
		$docsRenewaled = [];
		$documents = [];
		foreach ($documentsGen as  $mto) {
			$documents[] = $mto;
			if (strtotime($mto["date_expiration"] . " -30 days") < time() && !in_array($mto["document_name"], $docsRenewaled)) {
				$docsExpired[] = $mto;
			} else {
				$docsRenewaled[] = $mto["document_name"];
			}
		}


		$planillaModel = new DailyModel();
		$daily = $planillaModel->findBy([
			["rg.car", TrailerImageModel::EQUAL, $car["id"]]
		], true);

		$imageModel = new TrailerImageModel;
		$imagesGenerator =  $imageModel->findBy([
			["trailer", TrailerImageModel::EQUAL, $car["id"]]
		]);
		$images = [];
		foreach ($imagesGenerator as $value) {
			$images[] = $value;
		}

		$dtModel = new DocumentTypeModel;
		$documentTypeList = $dtModel->findBy([
			["trailer", DocumentTypeModel::EQUAL, "1"]
		]);


		$maintainceModel = new MaintainceTrailerModel;
		$maintainceListGen =  $maintainceModel->findBy([
			["trailer", MaintainceTrailerModel::EQUAL, $car["id"]]
		]);

		$maintainceListProgramed = [];
		$maintainceList = [];
		foreach ($maintainceListGen as  $mto) {
			$maintainceList[] = $mto;
			if ($mto["status"] == "PROGRAMADO") {
				$maintainceListProgramed[] = $mto;
			}
		}
		$notificationsList = [];
		$notificationTrailerModel = new NotificationTrailerModel;
		$notificationsList = $notificationTrailerModel->findBy([
			["trailer", NotificationTrailerModel::EQUAL, $car["id"]]
		]);

		return $this->renderHtml("trailer/details", [
			"car" => $car,
			"images" => $images,
			"documentTypeList" => $documentTypeList,
			"documents" => $documents,
			"docsExpired" => $docsExpired,
			"maintainceList" => $maintainceList,
			"maintainceListProgramed" => $maintainceListProgramed,
			"planilla" => $daily,
			"notificationsList" => $notificationsList
		]);
	}

	public function storeimageAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Editar"])) {
			header("location:/");
		}
		$TrailerModel = new TrailerModel();
		$car = $TrailerModel->find($params["params"][2]);
		if (empty($car)) {
			throw new \Exception("Trailer no encontrado", 404);
		}
		$fileName = $this->uploadImg($params["files"]["photo"]);
		$TrailerImageModel = new TrailerImageModel();
		if (!$TrailerImageModel->create(["trailer" => $car["id"], "url" => $_ENV["SITE_URL"] . "images" . $fileName])) {
			throw new \Exception("Imagen no almacenada", 404);
		} else {
			header("location:/trailer/details/" . $car["id"]);
		}
	}
	public function deleteimageAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Editar"])) {
			header("location:/");
		}

		$TrailerModel = new TrailerImageModel();
		$TrailerModel->delete($params["params"][2]);
		header("location:/trailer/details/" . $params["params"][3]);
	}
	protected function uploadImg($file)
	{
		$fileName = "/trailer/" . time() . $file['name'];
		$filePath = $_ENV["STORAGE_IMAGES"]  . $fileName;
		move_uploaded_file($file['tmp_name'], $filePath);
		return $fileName;
	}

	public function notificationsAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Listar"])) {
			header("location:/");
		}
		$TrailerModel = new TrailerModel();
		$car = $TrailerModel->find($params["params"][2]);
		if (empty($car)) {
			throw new \Exception("Trailer no encontrado", 404);
		}

		$modelNotifications = new NotificationTrailerModel();

		$notCar = $modelNotifications->findBy([
			["trailer", NotificationTrailerModel::EQUAL, $car["id"]]
		]);

		return $this->renderHtml("trailer/notifications", ["car" => $car, "notifications" => $notCar]);
	}

	public function createnotificationAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Listar"])) {
			header("location:/");
		}
		$TrailerModel = new TrailerModel();
		$car = $TrailerModel->find($params["params"][2]);
		if (empty($car)) {
			throw new \Exception("Trailer no encontrado", 404);
		}

		$notificationTypeModel = new NotificationTypeModel();
		$notificationTypes = $notificationTypeModel->all();

		return $this->renderHtml("trailer/createnotifications", ["car" => $car, "typeNotifications" => $notificationTypes]);
	}


	public function storenotificationAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Editar"])) {
			header("location:/");
		}
		$TrailerModel = new TrailerModel();
		$car = $TrailerModel->find($params["post"]["trailer"]);
		if (empty($car)) {
			throw new \Exception("Trailer no encontrado", 404);
		}

		$notificationTrailerModel = new NotificationTrailerModel();
		if (!$notificationTrailerModel->create($params["post"], $car["id"])) {
			throw new \Exception("Error al crear la notificación", 500);
		}
		header("location:/trailer/notifications/" . $car["id"]);
	}

	public function deletenotificationAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Editar"])) {
			header("location:/");
		}
		$notificationTrailerModel = new NotificationTrailerModel();
		$car = $notificationTrailerModel->find($params["params"][2]);
		if (empty($car)) {
			throw new \Exception("Notificación no encontrada", 404);
		}

		if (!$notificationTrailerModel->delete($car["id"])) {
			throw new \Exception("Error al eliminar la notificación", 500);
		}
		header("location:/trailer/notifications/" . $car["trailer"]);
	}



	public function updateAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Editar"])) {
			header("location:/");
		}
		$car = new TrailerModel();
		$carRes = $car->find($params["params"][2]);
		if (empty($carRes)) {
			throw new \Exception("Trailer not found", 404);
		}
		if (!$car->update($params["post"], $carRes["id"])) {
			throw new \Exception("No fue posible actualizar el Trailer, verifique la información proporcionada", 500);
		} else {
			header("location:/trailer/details/" . $carRes["id"]);
		}
	}


	public function editAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Editar"])) {
			header("location:/");
		}
		$TrailerTypeModel = new TrailerTypeModel();
		$carTypeList = $TrailerTypeModel->all();
		$Car = new TrailerModel();
		$user = $Car->find($params["params"][2]);
		if (empty($user)) {
			throw new \Exception("Trailer no encontrado", 404);
		}
		$BrandModel = new BrandModel();
		$BrandList = $BrandModel->all();
		$ContractorModel = new ContractorModel();
		$CarOwnerList = $ContractorModel->all();
		return $this->renderHtml("trailer/edit", [
			"customer" => $user, "carTypeList" => $carTypeList, "BrandList" => $BrandList,  "CarOwnerList" => $CarOwnerList
		]);
	}


	public function storefileAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Editar"])) {
			header("location:/");
		}
		$TrailerModel = new TrailerModel();
		$car = $TrailerModel->find($params["params"][2]);
		if (empty($car)) {
			throw new \Exception("Trailer no encontrado", 404);
		}
		$fileName = $this->uploadFile($params["files"]["file"]);
		$params["post"]["url"] = $fileName;
		$params["post"]["trailer"] = $car["id"];
		$params["post"]["date_created"] = date("Y-m-d");
		$TrailerImageModel = new TrailerDocumentModel();
		if (!$TrailerImageModel->create($params["post"])) {
			throw new \Exception("No fue posible actualizar el Trailer, verifique la información proporcionada", 500);
		} else {
			header("location:/trailer/details/" . $car["id"]);
		}
	}

	public function deletefileAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Editar"])) {
			header("location:/");
		}

		$TrailerModel = new TrailerDocumentModel();
		$TrailerModel->delete($params["params"][2]);
		header("location:/trailer/details/" . $params["params"][3]);
	}

	public function storemaintainceAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Editar"])) {
			header("location:/");
		}
		$TrailerModel = new TrailerModel();
		$car = $TrailerModel->find($params["params"][2]);
		if (empty($car)) {
			throw new \Exception("Trailer no encontrado", 404);
		}
		$params["post"]["trailer"] = $car["id"];
		$params["post"]["status"] = "PROGRAMADO";
		$TrailerImageModel = new MaintainceTrailerModel();
		if ($TrailerImageModel->create($params["post"])) {
			header("location:/trailer/details/" . $car["id"]);
		} else {
			throw new \Exception("Error registrando el mantenimiento " . print_r($TrailerImageModel->getLastError(), 1), 404);
		}
	}
	

	public function deletemaintainceAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Editar"])) {
			header("location:/");
		}

		$TrailerModel = new MaintainceTrailerModel();
		$TrailerModel->delete($params["params"][3]);
		header("location:/trailer/details/" . $params["params"][2]);
	}

	public function cancelmaintainceAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Editar"])) {
			header("location:/");
		}

		$TrailerModel = new MaintainceTrailerModel();
		$carMaintaince = $TrailerModel->find($params["params"][2]);
		if (empty($carMaintaince)) {
			throw new \Exception("Mantenimiento no encontrado", 404);
		}
		$carMaintaince["status"] = 'CANCELADO';
		if (!$TrailerModel->update($carMaintaince, $params["params"][2])) {
			throw new \Exception("Mantenimiento no pudo ser actualizado", 404);
		} else {
			header("location:/trailer/details/" . $carMaintaince["car"]);
		}
	}

	public function inprocessmaintainceAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Editar"])) {
			header("location:/");
		}

		$TrailerModel = new MaintainceTrailerModel();
		$carMaintaince = $TrailerModel->find($params["params"][2]);
		if (empty($carMaintaince)) {
			throw new \Exception("Mantenimiento no encontrado", 404);
		}
		$carMaintaince["status"] = 'EN PROCESO';
		if (!$TrailerModel->update($carMaintaince, $params["params"][2])) {
			throw new \Exception("Mantenimiento no pudo ser actualizado", 404);
		} else {
			header("location:/trailer/details/" . $carMaintaince["car"]);
		}
	}

	public function fillmaintainceAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Editar"])) {
			header("location:/");
		}

		$TrailerModel = new MaintainceTrailerModel();
		$carMaintaince = $TrailerModel->find($params["params"][2]);
		if (empty($carMaintaince)) {
			throw new \Exception("Mantenimiento no encontrado", 404);
		}
		$carMaintaince["status"] = 'FINALIZADO';
		$carMaintaince["results"] = $params["post"]["results"];
		$carMaintaince["cost"] = $params["post"]["cost"];
		$carMaintaince["date_finished"] = $params["post"]["date_finished"];

		$fileUrl = $this->uploadMaintainceFile($params["files"]["evidence"]);
		$carMaintaince["url"] = $fileUrl;
		if (!$TrailerModel->update($carMaintaince, $params["params"][2])) {
			throw new \Exception("Mantenimiento no pudo ser actualizado", 404);
		} else {
			header("location:/car/details/" . $carMaintaince["car"]);
		}
	}
/*
	public function newAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Crear"])) {
			header("location:/");
		}
		$TrailerTypeModel = new TrailerTypeModel();
		$carTypeList = $TrailerTypeModel->findBy([
			["status", TrailerTypeModel::EQUAL, 1]
		]);

		$BrandModel = new BrandModel();
		$BrandList = $BrandModel->all();
		$ServiceTypeModel = new ServiceTypeModel();
		$ServiceTypeList = $ServiceTypeModel->all();
		$LineModel = new LineModel();
		$LineList = $LineModel->all();
		$FuelTypeModel = new FuelTypeModel();
		$FuelTypeList = $FuelTypeModel->all();
		$ContractorModel = new ContractorModel();
		$CarOwnerList = $ContractorModel->all();
		$CompanyAgreementModel = new CompanyAgreementModel();
		$companyAgreementList = $CompanyAgreementModel->all();


		return $this->renderHtml("car/new", [
			"carTypeList" => $carTypeList, "BrandList" => $BrandList, "ServiceTypeList" => $ServiceTypeList,
			"LineList" => $LineList, "FuelTypeList" => $FuelTypeList, "CarOwnerList" => $CarOwnerList, "companyAgreementList" => $companyAgreementList
		]);
	}

	public function storeAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Crear"])) {
			header("location:/");
		}
		$TrailerModel = new TrailerModel();
		if (!$TrailerModel->create($params["post"])) {
			throw new \Exception("No fue posible crear el Trailer, verifique la información proporcionada", 500);
		} else {
			if (!empty($params["files"])) {
				$fileName = $this->uploadImg($params["files"]["photo"]);
				$TrailerImageModel = new TrailerImageModel();
				$TrailerImageModel->create(["car" => $TrailerModel->getLastId(), "url" => $_ENV["SITE_URL"] . "images" . $fileName]);
			}
			header("location:/car/");
		}
	}
	
	

	public function storefuelAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Editar"])) {
			header("location:/");
		}
		$TrailerModel = new TrailerModel();
		$car = $TrailerModel->find($params["params"][2]);
		if (empty($car)) {
			throw new \Exception("Trailer no encontrado", 404);
		}
		$fileName = $this->uploadFile($params["files"]["image"]);
		$params["post"]["image"] = $fileName;
		$params["post"]["car"] = $car["id"];
		$TrailerImageModel = new FuelTrailerModel();
		if ($TrailerImageModel->create($params["post"])) {
			header("location:/car/details/" . $car["id"]);
		} else {
			throw new \Exception("Error registrando el combustible " . print_r($TrailerImageModel->getLastError(), 1), 404);
		}
	}
	

	public function deleteAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Trailer"]["Eliminar"])) {
			header("location:/");
		}
		$CarType = new TrailerTypeModel();
		$user = $CarType->find($params["params"][2]);
		if (empty($user)) {
			throw new \Exception("Trailer no encontrado", 404);
		}

		if (!$CarType->delete($user["id"])) {
			throw new \Exception("No fue posible eliminar el vahículo, verifique que no tenga eventos creados", 404);
		} else {
			header("location:/car/");
		}
	}
	*/
	protected function uploadMaintainceFile($file)
	{
		$fileName = "/trailer/maintainces/" . time() . $file['name'];
		$filePath = $_ENV["STORAGE_FILES"]  . $fileName;
		move_uploaded_file($file['tmp_name'], $filePath);
		return $_ENV["SITE_URL"] . "files/" . $fileName;
	}
	protected function uploadFile($file)
	{
		$fileName = "/trailer/docs/" . time() . $file['name'];
		$filePath = $_ENV["STORAGE_FILES"]  . $fileName;
		move_uploaded_file($file['tmp_name'], $filePath);
		return $_ENV["SITE_URL"] . "files/" . $fileName;
	}

	protected function uploadXls($files)
	{
		$file_name = $_FILES['load_file']['name'];
		$file_tmp = $_FILES['load_file']['tmp_name'];
		$filePath = $_ENV["STORAGE_FILES"] . "/trailer/" . time() . $file_name;
		move_uploaded_file($file_tmp, $filePath);
		return $filePath;
	}
}
