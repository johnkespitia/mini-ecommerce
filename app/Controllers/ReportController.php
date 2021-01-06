<?php

namespace Controller;
use Model\OrderModel;
use Model\OrderItemModel;
use Model\ProductModel;
use Model\CustomerModel;


class ReportController extends Controller{
	public function __construct(){
		if(empty($_SESSION)){
			header("location:/");	
		}
	}
	public function indexAction($params = []){
		$orderModel = new OrderModel();
		$orderList = [];
		$genOrd = $orderModel->all();
		foreach ($genOrd as $c) {
			$orderList[] = $c;
		}
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
		return $this->renderHtml("report/index", ["orders"=>$orderList,"products"=>$productList, "customers"=>$customerList,"orderItems"=>$orderItemList]);
	}
}