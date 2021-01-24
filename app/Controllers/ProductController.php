<?php

namespace Controller;
use Model\ProductModel;
use Model\CategoryModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProductController extends Controller{
	public function __construct(){
		if(empty($_SESSION)){
			header("location:/");	
		}
	}
	public function indexAction($params = []){
		$productModel = new ProductModel();
		$catModel = new CategoryModel();
		$categories = $catModel->all();
		$newList = [];
		foreach ($categories as $value) {
			if(!empty($value["parent_id"])){
				$newList[$value["parent_name"]][] = $value;
			}
		}
		if(!empty($params["post"]["category_id"])){
			$productsList = $productModel->findBy([
				["category_id",ProductModel::EQUAL,$params["post"]["category_id"]]
			]);
		}else{
			$productsList = $productModel->all();
		}
		return $this->renderHtml("product/index", ["productsList"=>$productsList, "categories"=>$newList]);
	}

	public function categoriesAction($params = []){
		$catModel = new CategoryModel();
		$categories = $catModel->all();
		return $this->renderHtml("category/index", ["categories"=>$categories]);
	}

	public function newAction($params = []){
		$catModel = new CategoryModel();
		$categories = $catModel->all();
		$newList = [];
		foreach ($categories as $value) {
			if(!empty($value["parent_id"])){
				$newList[$value["parent_name"]][] = $value;
			}
		}
		return $this->renderHtml("product/new",["categories"=>$newList]);
	}

	public function newcategoryAction($params = []){
		$catModel = new CategoryModel();
		$categories = $catModel->findBy([
			["c.parent_category", CategoryModel::ISNULL]
		]);
		return $this->renderHtml("category/new",["categories"=>$categories]);
	}

	public function storeAction($params = []){
		$productModel = new ProductModel();
		if(!empty($_FILES["images"])){
			$params["post"]["images"]=$this->uploadProductImage($_FILES);
		}else{
			$params["post"]["images"]="";
		}
		if(!$productModel->create($params["post"])){
			throw new \Exception("No fue posible crear la categoría, verifique la información proporcionada", 404);
		}else{
			header("location:/product/");
		}
		header("location:/product/");
	}
	public function storecategoryAction($params = []){
		$catModel = new CategoryModel();
		
		if(empty($params["post"]["parent_category"])){
			$params["post"]["parent_category"] = "NULL";
		}
		if(!$catModel->create($params["post"])){
			throw new \Exception("No fue posible crear la categoría, verifique la información proporcionada", 404);
		}else{
			header("location:/product/categories");
		}
	}

	public function updateAction($params = []){
		$productModel = new ProductModel();
		$product = $productModel->find($params["params"][2]);
		if(empty($product)){
			throw new \Exception("Producto no encontrado", 404);
		}
		if(!empty($_FILES["images"])){
			$params["post"]["images"]=$this->uploadProductImage($_FILES);
		}else{
			$params["post"]["images"]="";
		}
		
		if(!$productModel->update($params["post"], $product["id"])){
			throw new \Exception("No fue posible actualizar el producto, verifique la información proporcionada", 404);
		}else{
			header("location:/product/");
		}
	}
	
	public function updatecategoryAction($params = []){
		$catModel = new CategoryModel();
		$category = $catModel->find($params["params"][2]);
		if(empty($category)){
			throw new \Exception("Categoría no encontrada", 404);
		}
		if(!$catModel->update($params["post"], $category["id"])){
			throw new \Exception("No fue posible actualizar la categoría, verifique la información proporcionada", 404);
		}else{
			header("location:/product/categories");
		}
		header("location:/product/categories");
	}


	public function editAction($params = []){
		$productModel = new ProductModel();
		$product = $productModel->find($params["params"][2]);
		if(empty($product)){
			throw new \Exception("Producto no encontrado", 404);
		}
		$catModel = new CategoryModel();
		$categories = $catModel->all();
		$newList = [];
		foreach ($categories as $value) {
			if(!empty($value["parent_id"])){
				$newList[$value["parent_name"]][] = $value;
			}
		}
		return $this->renderHtml("product/edit", ["product"=>$product,"categories"=>$newList]);
	}
	public function editcategoryAction($params = []){
		$catModel = new CategoryModel();
		$categories = $catModel->findBy([
			["c.parent_category", CategoryModel::ISNULL]
		]);
		$category = $catModel->find($params["params"][2]);
		if(empty($category)){
			throw new \Exception("Categoría no encontrada", 404);
		}
		return $this->renderHtml("category/edit", ["category"=>$category, "categories"=>$categories]);
	}

	public function deleteAction($params = []){
		$productModel = new ProductModel();
		$product = $productModel->find($params["params"][2]);
		if(empty($product)){
			throw new \Exception("Producto no encontrado", 404);
		}
		if(!$productModel->delete($product["id"])){
			throw new \Exception("No fue posible eliminar el producto, verifique no esté asociado a ninguna orden", 404);
		}else{
			header("location:/product/");
		}
	}

	public function exportxlsAction($params=[]){
		$productModel = new ProductModel();
		$productsList = $productModel->all();
		$spreadsheet = new Spreadsheet();
 
		$spreadsheet->getProperties()
			->setCreator($_ENV["SITE_NAME"])
			->setLastModifiedBy($_ENV["SITE_NAME"])
			->setTitle("Listado completo de productos")
			->setSubject("Listado completo de productos")
			->setDescription(
				"Listado completo de productos"
			)
			->setCategory("Productos");
		$sheet = $spreadsheet->getActiveSheet(); 
		
		// Set the value of cell A1 
		$sheet->setCellValue("A1", "ID"); 
		$sheet->setCellValue("B1", "Categoría"); 
		$sheet->setCellValue("C1", "SKU (Identificador)"); 
		$sheet->setCellValue("D1", "Nombre"); 
		$sheet->setCellValue("E1", "Descripción"); 
		$sheet->setCellValue("F1", "Precio"); 
		$sheet->setCellValue("G1", "Cantidad"); 
		$sheet->setCellValue("H1", "URL imagen"); 
		foreach ($productsList as $key => $prd) {
			$cellNumber=$key+2; 
			$sheet->setCellValue("A{$cellNumber}", $prd["id"]); 
			$sheet->setCellValue("B{$cellNumber}", $prd["category_name"]); 
			$sheet->setCellValue("C{$cellNumber}", $prd["sku"]); 
			$sheet->setCellValue("D{$cellNumber}", $prd["name"]); 
			$sheet->setCellValue("E{$cellNumber}", $prd["description"]); 
			$sheet->setCellValue("F{$cellNumber}", $prd["price"]); 
			$sheet->setCellValue("G{$cellNumber}", $prd["quantity"]); 
			$sheet->setCellValue("H{$cellNumber}", $prd["images"]); 
		}	
		// Write an .xlsx file  
		$writer = new Xlsx($spreadsheet); 
		
		// Save .xlsx file to the current directory 
		$filePath = $_ENV["STORAGE_FILES"]."/products/products-export.xlsx";
		$writer->save($filePath); 
		header("location:/files/products/products-export.xlsx");
	}

	public function loadfileAction($params = []){
		return $this->renderHtml("product/loadfile",[]);
	}

	public function storexlsAction($params = []){
		$load_file=$this->uploadXls($_FILES);
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($load_file);
		$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		$categoryModel = new CategoryModel();
		$productModel = new ProductModel();
		$errorMessage=[];
		$successMessage=[];
		foreach ($sheetData as $key => $value) {
			if($key == 1){
				continue;
			}
			$cat = $categoryModel->findBy([
				["c.name",CategoryModel::EQUAL,$value["F"]],
				["c.parent_category",CategoryModel::NOTEQUAL,"NULL"]
			],true);
			if(empty($cat->getReturn())){
				$errorMessage[$key] = "tiene errores, no se pudo insertar Categoría no válida";
			}else{
				$data=[
					"sku"=>$value["A"],
					"name"=>$value["B"],
					"price"=>$value["C"],
					"quantity"=>$value["D"],
					"description"=>$value["E"],
					"category_id"=>$cat->getReturn()["id"],
					"images"=>"",
				];
				if(!$productModel->create($data)){
					$errorMessage[$key] = "tiene errores, no se pudo insertar ".$productModel->getLastError()[2];
				}else{
					$successMessage[$key] = "Registrada correctamente";
				}
			}
		}
		return $this->renderHtml("product/loadfile",["errorMessage"=>$errorMessage,"successMessage"=>$successMessage]);
	}


	protected function uploadProductImage($files){
			$file_name = $_FILES['images']['name'];
			$file_tmp =$_FILES['images']['tmp_name'];
			$nameFile = time().$file_name;
			move_uploaded_file($file_tmp,$_ENV["STORAGE_IMAGES"]."/products/".$nameFile);
			return $_ENV["SITE_URL"]."/images/products/{$nameFile}";
	}

	protected function uploadXls($files){
		$file_name = $_FILES['load_file']['name'];
		$file_tmp =$_FILES['load_file']['tmp_name'];
		$filePath = $_ENV["STORAGE_FILES"]."/products/".time().$file_name;
		move_uploaded_file($file_tmp,$filePath);
		return $filePath;
	}
}