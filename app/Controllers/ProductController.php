<?php

namespace Controller;
use Model\ProductModel;

class ProductController extends Controller{
	public function indexAction($params = []){
		$productModel = new ProductModel();
		$productsList = $productModel->all();
		return $this->renderHtml("product/index", ["productsList"=>$productsList]);
	}

	public function newAction($params = []){
		return $this->renderHtml("product/new",[]);
	}

	public function storeAction($params = []){
		$productModel = new ProductModel();
		$productsList = $productModel->create($params["post"]);
		header("location:/product/");
	}

	public function updateAction($params = []){
		$productModel = new ProductModel();
		$product = $productModel->find($params["params"][2]);
		if(empty($product)){
			throw new \Exception("Cliente no encontrado", 404);
		}
		$params["post"]["password"] = (!empty($params["post"]["password"]))?md5($params["post"]["password"].$params["post"]["email"]):$product["password"];
		$productsList = $productModel->update($params["post"], $product["id"]);
		header("location:/product/");
	}


	public function editAction($params = []){
		$productModel = new ProductModel();
		$product = $productModel->find($params["params"][2]);
		if(empty($product)){
			throw new \Exception("Cliente no encontrado", 404);
		}
		return $this->renderHtml("product/edit", ["product"=>$product]);
	}

	public function deleteAction($params = []){
		$productModel = new ProductModel();
		$product = $productModel->find($params["params"][2]);
		if(empty($product)){
			throw new \Exception("Cliente no encontrado", 404);
		}
		$product = $productModel->delete($product["id"]);
		header("location:/product/");
	}

}