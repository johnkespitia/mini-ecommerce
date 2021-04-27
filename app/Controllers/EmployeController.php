<?php

namespace Controller;

use Model\AreaModel;
use Model\ArlModel;
use Model\BankModel;
use Model\CajaCompensacionModel;
use Model\CesantiasModel;
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

		$documents = [];
		$courses = [];
		return $this->renderHtml("employe/details", ["employe" => $employeesList, "documents" => $documents, "courses" => $courses, "images" => $images]);
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


		return $this->renderHtml("employe/new", ["positionsList" => $positionList, 
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
			throw new \Exception("No fue posible crear el empleado, verifique la información proporcionada ".print_r($employeModel->getLastError(),1), 500);
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
		return $this->renderHtml("employe/edit", ["customer" => $user]);
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

			$data = [
				"dni" => $value["A"],
				"name" => $value["B"],
				"email" => $value["C"],
				"status" => $value["D"],
			];
			if (!$employeModel->create($data)) {
				$errorMessage[$key] = "tiene errores, no se pudo insertar " . $employeModel->getLastError()[2];
			} else {
				$successMessage[$key] = "Registrado correctamente";
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
		foreach ($empList as $key => $prd) {
			$cellNumber = $key + 2;
			$sheet->setCellValue("A{$cellNumber}", $prd["id"]);
			$sheet->setCellValue("B{$cellNumber}", $prd["dni"]);
			$sheet->setCellValue("C{$cellNumber}", $prd["name"]);
			$sheet->setCellValue("D{$cellNumber}", $prd["email"]);
			$sheet->setCellValue("E{$cellNumber}", ($prd["status"] == 1) ? "Activo" : "Inactivo");
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
}
