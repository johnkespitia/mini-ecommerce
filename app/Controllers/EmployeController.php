<?php

namespace Controller;

use Model\AreaModel;
use Model\ArlModel;
use Model\BankModel;
use Model\CajaCompensacionModel;
use Model\CesantiasModel;
use Model\CourseModel;
use Model\EmployeCourseModel;
use Model\EmployeDocumentModel;
use Model\EmployeDocumentTypeModel;
use Model\EmployeImageModel;
use Model\EmployeModel;
use Model\EpsModel;
use Model\PensionModel;
use Model\PositionModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EmployeController extends Controller
{

	public function indexAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Empleados"]["Listar"])) {
			header("location:/");
		}
		$employeModel = new EmployeModel();
		$employeesList = $employeModel->all();
		return $this->renderHtml("employe/index", ["employeesList" => $employeesList]);
	}
	public function detailsAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Empleados"]["Listar"])) {
			header("location:/");
		}
		$employeModel = new EmployeModel();
		$employeesList = $employeModel->find($params["params"][2]);
		if (empty($employeesList)) {
			throw new \Exception("Empleado no encontrado", 404);
		}

		$imageModel = new EmployeImageModel;
		$imagesGenerator =  $imageModel->findBy([
			["employe", EmployeImageModel::EQUAL, $employeesList["id"]]
		]);
		$images = [];
		foreach ($imagesGenerator as $value) {
			$images[] = $value;
		}

		$documentsTypeModel = new EmployeDocumentTypeModel();
		$documentsTypeList = $documentsTypeModel->all();

		$documentsModel = new EmployeDocumentModel();
		$documents = [];
		$docsRenewaled = [];
		$docsExpired = [];
		$documentsGen = $documentsModel->findBy([
			["employe", EmployeDocumentModel::EQUAL, $employeesList["id"]]
		]);

		foreach ($documentsGen as  $mto) {
			$documents[] = $mto;
			if (strtotime($mto["expiration_date"] . " -30 days") < time() && !in_array($mto["document_name"], $docsRenewaled)) {
				$docsExpired[] = $mto;
			} else {
				$docsRenewaled[] = $mto["document_name"];
			}
		}

		$courseTypeModel = new CourseModel();
		$coursesList = $courseTypeModel->all();

		$coursesModel = new EmployeCourseModel;
		$courses = [];
		$coursesRenewaled = [];
		$coursesExpired = [];
		$coursesGen = $coursesModel->findBy([
			["employe",EmployeCourseModel::EQUAL,$employeesList["id"]]
		]);

		foreach ($coursesGen as  $mto) {
			$courses[] = $mto;
			if (strtotime($mto["expiration_date"] . " -30 days") < time() && !in_array($mto["course_name"], $coursesRenewaled)) {
				$coursesExpired[] = $mto;
			} else {
				$coursesRenewaled[] = $mto["course_name"];
			}
		}

		return $this->renderHtml("employe/details", [
			"employe" => $employeesList,
			"documents" => $documents,
			"docsExpired" => $docsExpired,
			"courses" => $courses,
			"images" => $images,
			"documentsTypeList" => $documentsTypeList,
			"coursesList" => $coursesList,
			"courses" => $courses,
			"coursesExpired" => $coursesExpired
		]);
	}

	public function newAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Empleados"]["Crear"])) {
			header("location:/");
		}

		$positionModel = new PositionModel();
		$positionList = $positionModel->all();

		$areaModel = new AreaModel();
		$areaList = $areaModel->all();

		$epsModel = new EpsModel();
		$epsList = $epsModel->all();

		$cesantiasModel = new CesantiasModel();
		$cesantiasList = $cesantiasModel->all();

		$pensionModel = new PensionModel();
		$pensionList = $pensionModel->all();

		$ccompModel = new CajaCompensacionModel();
		$ccompList = $ccompModel->all();

		$arlModel = new ArlModel();
		$arlList = $arlModel->all();

		$bankModel = new BankModel();
		$bankList = $bankModel->all();


		return $this->renderHtml("employe/new", [
			"positionsList" => $positionList,
			"areaList" => $areaList,
			"epsList" => $epsList,
			"cesantiasList" => $cesantiasList,
			"pensionList" => $pensionList,
			"ccompList" => $ccompList,
			"arlList" => $arlList,
			"bankList" => $bankList,
		]);
	}

	public function storeAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Empleados"]["Crear"])) {
			header("location:/");
		}
		$employeModel = new EmployeModel();
		if (!$employeModel->create($params["post"])) {
			throw new \Exception("No fue posible crear el empleado, verifique la información proporcionada " . print_r($employeModel->getLastError(), 1), 500);
		} else {
			header("location:/employe/");
		}
	}

	public function updateAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Empleados"]["Editar"])) {
			header("location:/");
		}
		$employe = new EmployeModel();
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
		if (empty($_SESSION["permissions"]["Empleados"]["Editar"])) {
			header("location:/");
		}
		$employe = new EmployeModel();
		$user = $employe->find($params["params"][2]);

		if (empty($user)) {
			throw new \Exception("Empleado no encontrado", 404);
		}

		$positionModel = new PositionModel();
		$positionList = $positionModel->all();

		$areaModel = new AreaModel();
		$areaList = $areaModel->all();

		$epsModel = new EpsModel();
		$epsList = $epsModel->all();

		$cesantiasModel = new CesantiasModel();
		$cesantiasList = $cesantiasModel->all();

		$pensionModel = new PensionModel();
		$pensionList = $pensionModel->all();

		$ccompModel = new CajaCompensacionModel();
		$ccompList = $ccompModel->all();

		$arlModel = new ArlModel();
		$arlList = $arlModel->all();

		$bankModel = new BankModel();
		$bankList = $bankModel->all();


		return $this->renderHtml("employe/edit", [
			"positionsList" => $positionList,
			"areaList" => $areaList,
			"epsList" => $epsList,
			"cesantiasList" => $cesantiasList,
			"pensionList" => $pensionList,
			"ccompList" => $ccompList,
			"arlList" => $arlList,
			"bankList" => $bankList,
			"customer" => $user
		]);
	}

	public function deleteAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Empleados"]["Eliminar"])) {
			header("location:/");
		}
		$CarType = new EmployeModel();
		$user = $CarType->find($params["params"][2]);
		if (empty($user)) {
			throw new \Exception("Empleado no encontrado", 404);
		}

		if (!$CarType->delete($user["id"])) {
			throw new \Exception("No fue posible eliminar el vahículo, verifique que no tenga eventos creados", 404);
		} else {
			header("location:/car/");
		}
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
		if (empty($_SESSION["permissions"]["Empleados"]["Crear"])) {
			header("location:/");
		}
		return $this->renderHtml("employe/loadfile", []);
	}


	public function storexlsAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Empleados"]["Crear"])) {
			header("location:/");
		}
		ini_set("set_time_limit", 0);
		$load_file = $this->uploadXls($_FILES);
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($load_file);
		$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		$employeModel = new EmployeModel();
		$errorMessage = [];
		$successMessage = [];
		foreach ($sheetData as $key => $value) {
			if ($key == 1) {
				continue;
			}
			$errors = false;
			$positionModel = new PositionModel();
			$positionList = $positionModel->findBy([
				["name", PositionModel::EQUAL, $value["J"]]
			], true);
			if (empty($positionList->getReturn())) {
				$errors = true;
				$errorMessage[$key] = "tiene errores, no se pudo insertar " . $positionModel->getLastError()[2];
			}
			$areaModel = new AreaModel();
			$areaList = $areaModel->findBy([
				["name", AreaModel::EQUAL, $value["Y"]]
			], true);
			if (empty($areaList->getReturn())) {
				$errors = true;
				$errorMessage[$key] = "tiene errores, no se pudo insertar " . $areaModel->getLastError()[2];
			}
			$epsModel = new EpsModel();
			$epsList = $epsModel->findBy([
				["name", EpsModel::EQUAL, $value["V"]]
			], true);
			if (empty($epsList->getReturn())) {
				$errors = true;
				$errorMessage[$key] = "tiene errores, no se pudo insertar " . $epsModel->getLastError()[2];
			}
			$cesantiasModel = new CesantiasModel();
			$cesantiasList = $cesantiasModel->findBy([
				["name", CesantiasModel::EQUAL, $value["W"]]
			], true);
			if (empty($cesantiasList->getReturn())) {
				$errors = true;
				$errorMessage[$key] = "tiene errores, no se pudo insertar " . $cesantiasModel->getLastError()[2];
			}
			$pensionModel = new PensionModel();
			$pensionList = $pensionModel->findBy([
				["name", PensionModel::EQUAL, $value["X"]]
			], true);
			if (empty($pensionList->getReturn())) {
				$errors = true;
				$errorMessage[$key] = "tiene errores, no se pudo insertar " . $pensionModel->getLastError()[2];
			}
			$ccompModel = new CajaCompensacionModel();
			$ccompList = $ccompModel->findBy([
				["name", CajaCompensacionModel::EQUAL, $value["Z"]]
			], true);
			if (empty($epsList->getReturn())) {
				$errors = true;
				$errorMessage[$key] = "tiene errores, no se pudo insertar " . $epsModel->getLastError()[2];
			}
			$arlModel = new ArlModel();
			$arlList = $arlModel->findBy([
				["name", ArlModel::EQUAL, $value["AA"]]
			], true);
			if (empty($arlList->getReturn())) {
				$errors = true;
				$errorMessage[$key] = "tiene errores, no se pudo insertar " . $arlModel->getLastError()[2];
			}
			$bankModel = new BankModel();
			$bankList = $bankModel->findBy([
				["name", BankModel::EQUAL, $value["M"]]
			], true);
			if (empty($bankList->getReturn())) {
				$errors = true;
				$errorMessage[$key] = "tiene errores, no se pudo insertar " . $bankModel->getLastError()[2];
			}
			if (!$errors) {
				$data = [
					"dni" => $value["A"],
					"name" => $value["B"],
					"email" => $value["C"],
					"status" => $value["D"],
					"dni_type" => $value["E"],
					"city_exp" => $value["F"],
					"birth_date" => date("Y-m-d", \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["G"], $_ENV["APP_TIMEZONE"])),
					"address" => $value["H"],
					"phone" => $value["I"],
					"position" => $positionList->getReturn()["id"],
					"rh" => $value["K"],
					"payment_method" => $value["L"],
					"bank" => $bankList->getReturn()["id"],
					"account_type" => $value["N"],
					"account_number" => $value["O"],
					"salary" => $value["P"],
					"payment_base" => $value["Q"],
					"start_date" => date("Y-m-d", \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($value["R"], $_ENV["APP_TIMEZONE"])),
					"extra_benefit" => $value["S"],
					"type_contract" => $value["T"],
					"contract_agreement" => $value["U"],
					"eps" => $epsList->getReturn()["id"],
					"cesantias" => $cesantiasList->getReturn()["id"],
					"pension" => $pensionList->getReturn()["id"],
					"area" => $areaList->getReturn()["id"],
					"caja_compensacion" => $ccompList->getReturn()["id"],
					"arl" => $arlList->getReturn()["id"]
				];

				$existEmp = $employeModel->findBy([["dni", EmployeModel::EQUAL, $data["dni"]]], true);
				if ($existEmp) {
					if (!$employeModel->update($data, $existEmp->getReturn()["id"])) {
						$errorMessage[$key] = "tiene errores, no se pudo insertar " . $employeModel->getLastError()[2];
					} else {
						$successMessage[$key] = "Registrado correctamente";
					}
				} else {
					if (!$employeModel->create($data)) {
						$errorMessage[$key] = "tiene errores, no se pudo insertar " . $employeModel->getLastError()[2];
					} else {
						$successMessage[$key] = "Registrado correctamente";
					}
				}
			}
		}
		return $this->renderHtml("employe/loadfile", ["errorMessage" => $errorMessage, "successMessage" => $successMessage]);
	}

	public function exportxlsAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Empleados"]["Listar"])) {
			header("location:/");
		}
		$empModel = new EmployeModel();
		$empList = $empModel->all();
		$spreadsheet = new Spreadsheet();

		$spreadsheet->getProperties()
			->setCreator($_ENV["SITE_NAME"])
			->setLastModifiedBy($_ENV["SITE_NAME"])
			->setTitle("Listado completo de clientes")
			->setSubject("Listado completo de clientes")
			->setDescription(
				"Listado completo de clientes"
			)
			->setCategory("Clientes");
		$sheet = $spreadsheet->getActiveSheet();

		// Set the value of cell A1 
		$sheet->setCellValue("A1", "ID");
		$sheet->setCellValue("B1", "Identificación");
		$sheet->setCellValue("C1", "Nombre");
		$sheet->setCellValue("D1", "Email");
		$sheet->setCellValue("E1", "Estado");
		$sheet->setCellValue("F1", "Tipo de Documento");
		$sheet->setCellValue("G1", "Ciudad Expedición");
		$sheet->setCellValue("G1", "Fecha de Nacimiento");
		$sheet->setCellValue("I1", "Dirección");
		$sheet->setCellValue("J1", "Teléfono");
		$sheet->setCellValue("K1", "Cargo");
		$sheet->setCellValue("L1", "RH");
		$sheet->setCellValue("M1", "Método de Pago");
		$sheet->setCellValue("N1", "Banco");
		$sheet->setCellValue("O1", "Tipo de Cuenta");
		$sheet->setCellValue("P1", "Número de Cuenta");
		$sheet->setCellValue("Q1", "Salario");
		$sheet->setCellValue("R1", "Base");
		$sheet->setCellValue("S1", "Fecha de inicio");
		$sheet->setCellValue("T1", "Subsidio");
		$sheet->setCellValue("U1", "Contrato");
		$sheet->setCellValue("V1", "Tipo de Contrato");
		$sheet->setCellValue("W1", "EPS");
		$sheet->setCellValue("X1", "Cesantías");
		$sheet->setCellValue("Y1", "Pensión");
		$sheet->setCellValue("Z1", "Area");
		$sheet->setCellValue("AA1", "Caja de Compensación");
		$sheet->setCellValue("AB1", "ARL");
		foreach ($empList as $key => $prd) {
			$cellNumber = $key + 2;
			$sheet->setCellValue("A{$cellNumber}", $prd["id"]);
			$sheet->setCellValue("B{$cellNumber}", $prd["dni"]);
			$sheet->setCellValue("C{$cellNumber}", $prd["name"]);
			$sheet->setCellValue("D{$cellNumber}", $prd["email"]);
			$sheet->setCellValue("E{$cellNumber}", ($prd["status"] == 1) ? "Activo" : "Inactivo");
			$sheet->setCellValue("F{$cellNumber}", $prd["dni_type"]);
			$sheet->setCellValue("G{$cellNumber}", $prd["city_exp"]);
			$sheet->setCellValue("H{$cellNumber}", $prd["birth_date"]);
			$sheet->setCellValue("I{$cellNumber}", $prd["address"]);
			$sheet->setCellValue("J{$cellNumber}", $prd["phone"]);
			$sheet->setCellValue("K{$cellNumber}", $prd["position_name"]);
			$sheet->setCellValue("L{$cellNumber}", $prd["rh"]);
			$sheet->setCellValue("M{$cellNumber}", $prd["payment_method"]);
			$sheet->setCellValue("N{$cellNumber}", $prd["bank_name"]);
			$sheet->setCellValue("O{$cellNumber}", $prd["account_type"]);
			$sheet->setCellValue("P{$cellNumber}", $prd["account_number"]);
			$sheet->setCellValue("Q{$cellNumber}", $prd["salary"]);
			$sheet->setCellValue("R{$cellNumber}", $prd["payment_base"]);
			$sheet->setCellValue("S{$cellNumber}", $prd["start_date"]);
			$sheet->setCellValue("T{$cellNumber}", $prd["extra_benefit"]);
			$sheet->setCellValue("U{$cellNumber}", $prd["type_contract"]);
			$sheet->setCellValue("V{$cellNumber}", $prd["contract_agreement"]);
			$sheet->setCellValue("W{$cellNumber}", $prd["eps_name"]);
			$sheet->setCellValue("X{$cellNumber}", $prd["cesantias_name"]);
			$sheet->setCellValue("Y{$cellNumber}", $prd["pension_name"]);
			$sheet->setCellValue("Z{$cellNumber}", $prd["area_name"]);
			$sheet->setCellValue("AA{$cellNumber}", $prd["caja_compensacion_name"]);
			$sheet->setCellValue("AB{$cellNumber}", $prd["arl_name"]);
		}
		// Write an .xlsx file  
		$writer = new Xlsx($spreadsheet);

		// Save .xlsx file to the current directory 
		$filePath = $_ENV["STORAGE_FILES"] . "/employees/employees-export.xlsx";
		$writer->save($filePath);
		header("location:/files/employees/employees-export.xlsx");
	}

	public function imagesAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Empleados"]["Listar"])) {
			header("location:/");
		}
		$imgEmpModel = new EmployeImageModel();
		$imgList = $imgEmpModel->findBy([
			["car", EmployeImageModel::EQUAL, $params["params"][2]]
		]);
		$imgEmployeResponse = [];
		foreach ($imgList as $value) {
			$imgEmployeResponse[] = $value;
		}
		return $this->renderJson(["imagesList" => $imgEmployeResponse]);
	}

	public function storeimageAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Empleados"]["Editar"])) {
			header("location:/");
		}
		$employeModel = new EmployeModel();
		$employe = $employeModel->find($params["params"][2]);
		if (empty($employe)) {
			throw new \Exception("Empleado no encontrado", 404);
		}
		$fileName = $this->uploadImg($params["files"]["photo"]);
		$employeImageModel = new EmployeImageModel();
		$employeImageModel->create(["employe" => $employe["id"], "url" => $_ENV["SITE_URL"] . "images" . $fileName]);
		header("location:/employe/details/" . $employe["id"]);
	}

	protected function uploadImg($file)
	{
		$fileName = "/employe/" . time() . $file['name'];
		$filePath = $_ENV["STORAGE_IMAGES"]  . $fileName;
		move_uploaded_file($file['tmp_name'], $filePath);
		return $fileName;
	}

	public function deleteimageAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Empleados"]["Editar"])) {
			header("location:/");
		}

		$carModel = new EmployeImageModel();
		$carModel->delete($params["params"][2]);
		header("location:/employe/details/" . $params["params"][3]);
	}

	public function storefileAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Empleados"]["Editar"])) {
			header("location:/");
		}
		$employeModel = new EmployeModel();
		$employe = $employeModel->find($params["params"][2]);
		if (empty($employe)) {
			throw new \Exception("Vehículo no encontrado", 404);
		}
		$fileName = $this->uploadFile($params["files"]["file"]);
		$params["post"]["url"] = $fileName;
		$params["post"]["employe"] = $employe["id"];
		$params["post"]["date_created"] = date("Y-m-d");
		$employeImageModel = new EmployeDocumentModel();
		$employeImageModel->create($params["post"]);
		header("location:/employe/details/" . $employe["id"]);
	}

	protected function uploadFile($file)
	{
		$fileName = "/employees/docs/" . time() . $file['name'];
		$filePath = $_ENV["STORAGE_FILES"]  . $fileName;
		move_uploaded_file($file['tmp_name'], $filePath);
		return $_ENV["SITE_URL"] . "files/" . $fileName;
	}

	public function deletefileAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Empleados"]["Editar"])) {
			header("location:/");
		}

		$carModel = new EmployeDocumentModel();
		$carModel->delete($params["params"][2]);
		header("location:/employe/details/" . $params["params"][3]);
	}

	public function storecourseAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Empleados"]["Editar"])) {
			header("location:/");
		}
		$employeModel = new EmployeModel();
		$employe = $employeModel->find($params["params"][2]);
		if (empty($employe)) {
			throw new \Exception("Vehículo no encontrado", 404);
		}
		$fileName = $this->uploadFile($params["files"]["file"]);
		$params["post"]["url"] = $fileName;
		$params["post"]["employe"] = $employe["id"];
		$params["post"]["date_created"] = date("Y-m-d");
		$employeImageModel = new EmployeCourseModel();
		$employeImageModel->create($params["post"]);
		header("location:/employe/details/" . $employe["id"]);
	}


	public function courseAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Empleados"]["Editar"])) {
			header("location:/");
		}

		$carModel = new EmployeCourseModel();
		$carModel->delete($params["params"][2]);
		header("location:/employe/details/" . $params["params"][3]);
	}
}
