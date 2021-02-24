<?php

namespace Controller;
use Model\CustomerModel;
use Model\CityModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CustomerController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Clientes"]["Listar"])){
			header("location:/");	
		}
		$customerModel = new CustomerModel();
		$customerList = $customerModel->all();
		$cityModel = new CityModel();
		$cityList = [];
		$genCity = $cityModel->all();
		foreach ($genCity as $c) {
			$cityList[] = $c;
		}
		return $this->renderHtml("customer/index", ["customerList"=>$customerList, "cityList"=>$cityList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Clientes"]["Crear"])){
			header("location:/");	
		}
		$cityModel = new CityModel();
		$cityList = $cityModel->all();
		return $this->renderHtml("customer/new", ["cityList"=>$cityList]);
	}

	public function loadfileAction($params = []){
		if(empty($_SESSION["permissions"]["Clientes"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("customer/loadfile",[]);
	}
	
	public function storexlsAction($params = []){
		if(empty($_SESSION["permissions"]["Clientes"]["Crear"])){
			header("location:/");	
		}
		$load_file=$this->uploadXls($_FILES);
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($load_file);
		$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		$cityModel = new CityModel();
		$customerModel = new CustomerModel();
		$errorMessage=[];
		$successMessage=[];
		foreach ($sheetData as $key => $value) {
			if($key == 1){
				continue;
			}
			$city = $cityModel->findBy([
				["name",CityModel::EQUAL,$value["D"]]
			],true);
			
			if(empty($city->getReturn())){
				$errorMessage[$key] = "tiene errores, no se pudo insertar Ciudad no válida";
			}else{
				$data=[
					"name"=>$value["A"],
					"phone"=>$value["B"],
					"address"=>$value["C"],
					"email"=>$value["E"],
					"dni"=>$value["F"],
					"city_id"=>$city->getReturn()["id"],
				];
				if(!$customerModel->create($data)){
					$errorMessage[$key] = "tiene errores, no se pudo insertar ".$customerModel->getLastError()[2];
				}else{
					$successMessage[$key] = "Registrada correctamente";
				}
			}
		}
		return $this->renderHtml("customer/loadfile",["errorMessage"=>$errorMessage,"successMessage"=>$successMessage]);
	}

	public function exportxlsAction($params=[]){
		if(empty($_SESSION["permissions"]["Clientes"]["Listar"])){
			header("location:/");	
		}
		$customerModel = new CustomerModel();
		$cityModel = new CityModel();
		$customerList = $customerModel->all();
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
		$sheet->setCellValue("B1", "Nombre"); 
		$sheet->setCellValue("C1", "Identificación (DNI)"); 
		$sheet->setCellValue("D1", "Teléfono"); 
		$sheet->setCellValue("E1", "Dirección"); 
		$sheet->setCellValue("F1", "Email"); 
		$sheet->setCellValue("G1", "Ciudad"); 
		foreach ($customerList as $key => $prd) {
			$city = $cityModel->find($prd["city_id"]);
			$cellNumber=$key+2; 
			$sheet->setCellValue("A{$cellNumber}", $prd["id"]); 
			$sheet->setCellValue("B{$cellNumber}", $prd["name"]); 
			$sheet->setCellValue("C{$cellNumber}", $prd["dni"]); 
			$sheet->setCellValue("D{$cellNumber}", $prd["phone"]); 
			$sheet->setCellValue("E{$cellNumber}", $prd["address"]); 
			$sheet->setCellValue("F{$cellNumber}", $prd["email"]); 
			$sheet->setCellValue("G{$cellNumber}", $city["name"]); 
		}	
		// Write an .xlsx file  
		$writer = new Xlsx($spreadsheet); 
		
		// Save .xlsx file to the current directory 
		$filePath = $_ENV["STORAGE_FILES"]."/customers/customers-export.xlsx";
		$writer->save($filePath); 
		header("location:/files/customers/customers-export.xlsx");
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Clientes"]["Crear"])){
			header("location:/");	
		}
		$customerModel = new CustomerModel();
		if(!$customerModel->create($params["post"])){
			throw new \Exception("Error al registrar el cliente, verifique la información proporcionada", 403);
		}else{
			header("location:/customer/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Clientes"]["Editar"])){
			header("location:/");	
		}
		$customerModel = new CustomerModel();
		$customer = $customerModel->find($params["params"][2]);
		if(empty($customer)){
			throw new \Exception("Cliente no encontrado", 404);
		}
		$params["post"]["newsletter"] = $customer["newsletter"];
		if(!$customerModel->update($params["post"], $customer["id"])){
			throw new \Exception("Error al actualizar el cliente, verifique la información proporcionada", 403);
		}else{
			header("location:/customer/");
		}
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Clientes"]["Editar"])){
			header("location:/");	
		}
		$customerModel = new CustomerModel();
		$customer = $customerModel->find($params["params"][2]);
		if(empty($customer)){
			throw new \Exception("Cliente no encontrado", 404);
		}
		$cityModel = new CityModel();
		$cityList = $cityModel->all();
		return $this->renderHtml("customer/edit", ["cityList"=>$cityList, "customer"=>$customer]);
	}

	public function deleteAction($params = []){
		if(empty($_SESSION["permissions"]["Clientes"]["Eliminar"])){
			header("location:/");	
		}
		$customerModel = new CustomerModel();
		$customer = $customerModel->find($params["params"][2]);
		if(empty($customer)){
			throw new \Exception("Cliente no encontrado", 404);
		}
		if(!$customerModel->delete($customer["id"])){
			throw new \Exception("Error al eliminar el cliente, verifique que no tenga eventos ni ordenes asociadas antes de borrarlo de lo contrario no podrám eliminar el cliente", 403);
		}else{
			header("location:/customer/");
		}
	}

	protected function uploadXls($files){
		$file_name = $_FILES['load_file']['name'];
		$file_tmp =$_FILES['load_file']['tmp_name'];
		$filePath = $_ENV["STORAGE_FILES"]."/customers/".time().$file_name;
		move_uploaded_file($file_tmp,$filePath);
		return $filePath;
	}

}