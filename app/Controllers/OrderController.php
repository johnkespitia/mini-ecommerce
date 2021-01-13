<?php

namespace Controller;
use Model\OrderModel;
use Model\OrderItemModel;
use Model\ProductModel;
use Model\CustomerModel;

class OrderController extends Controller{
	public function __construct(){
		if(empty($_SESSION)){
			header("location:/");	
		}
	}
	public function indexAction($params = []){
		$orderModel = new OrderModel();
		$ordersList = $orderModel->all();
		$productModel = new ProductModel();
		$productList = [];
		$genPrd = $productModel->all();
		foreach ($genPrd as $c) {
			$productList[] = $c;
		}
		$customerModel = new CustomerModel();
		$customerList = [];
		$genCus = $customerModel->all();
		foreach ($genCus as $c) {
			$customerList[] = $c;
		}
		$orderItemModel = new OrderItemModel();
		$orderItemList = [];
		$genOI = $orderItemModel->all();
		foreach ($genOI as $c) {
			$orderItemList[] = $c;
		}
		return $this->renderHtml("order/index", ["productList"=>$productList, "orderList"=>$ordersList, "customerList"=>$customerList, "orderItemList"=>$orderItemList]);
	}

	public function customerAction($params = []){
		$orderModel = new OrderModel();
		$ordersList = $orderModel->findBy([
			["customer_id",OrderModel::EQUAL,$params["params"][2]]
		]);
		$productModel = new ProductModel();
		$productList = [];
		$genPrd = $productModel->all();
		foreach ($genPrd as $c) {
			$productList[] = $c;
		}
		$customerModel = new CustomerModel();
		$customer = $customerModel->find($params["params"][2]);
		if(empty($customer)){
			throw new \Exception("Cliente no encontrado", 404);
		}
		$orderItemModel = new OrderItemModel();
		$orderItemList = [];
		$genOI = $orderItemModel->all();
		foreach ($genOI as $c) {
			$orderItemList[] = $c;
		}
		return $this->renderHtml("order/customer", ["productList"=>$productList, "orderList"=>$ordersList, "customer"=>$customer, "orderItemList"=>$orderItemList]);
	}

	public function newAction($params = []){
		$customerModel = new CustomerModel();
		$customerList = [];
		$genCus = $customerModel->all();
		foreach ($genCus as $c) {
			$customerList[] = $c;
		}
		return $this->renderHtml("order/new",["customerList"=>$customerList]);
	}

	public function storeAction($params = []){
		$orderModel = new OrderModel();
		$params["post"]["total"]=0;
		$productsList = $orderModel->create($params["post"]);
		header("location:/order/");
	}


	public function additemAction($params = []){
		$orderModel = new OrderModel();
		$order = $orderModel->find($params["params"][2]);
		if(empty($order)){
			throw new \Exception("Pedido no encontrado", 404);
		}
		$productModel = new ProductModel();
		$productList = [];
		$genPrd = $productModel->findBy([
			["quantity",ProductModel::GT,"0"],
		]);

		foreach ($genPrd as $c) {
			$productList[] = $c;
		}
		return $this->renderHtml("order/additem", ["productList"=>$productList, "order"=>$order]);
	}

	public function deleteitemAction($params = []){
		$orderItemModel = new OrderItemModel();
		$oi = $orderItemModel->find($params["params"][2]);
		if(empty($oi)){
			throw new \Exception("Item de pedido no encontrado", 404);
		}
		$orderModel = new OrderModel();
		$order = $orderModel->find($oi["order_id"]);
		if(empty($order)){
			throw new \Exception("Cliente no encontrado", 404);
		}
		$orderItemModel->delete($oi["id"]);
		$order["total"] = $order["total"]-$oi["product_price_sold"];
		$orderModel->update($order,$order["id"]);

		$productModel = new ProductModel();
		$product = $productModel->find($oi["product_id"]);
		$product["quantity"] = $product["quantity"] + 1;
		$productModel->update($product,$product["id"]);
		
		header("location:/order/");
	}


	public function storeitemAction($params = []){
		$orderModel = new OrderModel();
		$order = $orderModel->find($params["params"][2]);
		if(empty($order)){
			throw new \Exception("Pedido no encontrado", 404);
		}
		$productModel = new ProductModel();
		$product = $productModel->find($params["post"]["product_id"]);
		if(empty($product)){
			throw new \Exception("Producto no encontrado", 404);
		}
		$product["quantity"] = $product["quantity"] - 1;
		$productModel->update($product,$product["id"]);

		$orderItemModel = new OrderItemModel();
		$params["post"]["order_id"]=$order["id"];
		$params["post"]["product_price_sold"]=$product["price"];
		$params["post"]["product_status"]="COMPRADO";
		$orderItemModel->create($params["post"]);
		$order["total"] = $order["total"]+$product["price"];
		$orderModel->update($order, $order["id"]);
		header("location:/order/");
	}

	public function deleteAction($params = []){
		$orderModel = new OrderModel();
		$order = $orderModel->find($params["params"][2]);
		if(empty($order)){
			throw new \Exception("Pedido no encontrado", 404);
		}
		$orderModel->delete($order["id"]);
		header("location:/order/");
	}

}