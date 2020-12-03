<?php

namespace Controller;

class HomeController extends Controller{
	public function indexAction($params = []){
		return $this->renderHtml("home/index", $params);
	}
}