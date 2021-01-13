<?php

namespace Controller;
use Model\ProductModel;
use Model\CategoryModel;

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
			["parent_category", CategoryModel::ISNULL]
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
		$productsList = $productModel->create($params["post"]);
		header("location:/product/");
	}
	public function storecategoryAction($params = []){
		$catModel = new CategoryModel();
		
		if(empty($params["post"]["parent_category"])){
			$params["post"]["parent_category"] = "NULL";
		}
		$catModel->create($params["post"]);
		header("location:/product/");
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
		$productsList = $productModel->update($params["post"], $product["id"]);
		header("location:/product/");
	}
	
	public function updatecategoryAction($params = []){
		$catModel = new CategoryModel();
		$category = $catModel->find($params["params"][2]);
		if(empty($category)){
			throw new \Exception("Categoría no encontrada", 404);
		}
		$catModel->update($params["post"], $category["id"]);
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
		$product = $productModel->delete($product["id"]);
		header("location:/product/");
	}

	protected function uploadProductImage($files){
			$file_name = $_FILES['images']['name'];
			$file_tmp =$_FILES['images']['tmp_name'];
			move_uploaded_file($file_tmp,$_ENV["STORAGE_IMAGES"]."/products/".$file_name);
			return $_ENV["SITE_URL"]."/images/products/{$file_name}";
	}
}