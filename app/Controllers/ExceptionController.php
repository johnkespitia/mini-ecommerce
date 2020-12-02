<?php

namespace Controller;

class ExceptionController extends Controller{
	public function errorAction($params = []){
		return $this->renderHtml("exception/error", $params);
	}
}