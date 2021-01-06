<?php
namespace Controller;

class ContactController extends Controller{
	public function __construct(){
		if(empty($_SESSION)){
			header("location:/");	
		}
    }

    public function indexAction($params = []){
		
		return $this->renderHtml("contact/index",[]);
	}
}