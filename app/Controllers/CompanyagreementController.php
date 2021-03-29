<?php 

namespace Controller;
use Model\CompanyAgreementModel;
class CompanyAgreementController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Aliados"]["Listar"])){
			header("location:/");	
		}
		$CompanyAgreementModel = new CompanyAgreementModel();
		$cityList = $CompanyAgreementModel->all();
		return $this->renderHtml("companyagreement/index", ["cityList"=>$cityList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Aliados"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("companyagreement/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Aliados"]["Crear"])){
			header("location:/");	
		}
		$CompanyAgreementModel = new CompanyAgreementModel();
		if(!$CompanyAgreementModel->create($params["post"])){
			throw new \Exception("No fue posible crear la ciudad, verifique la información proporcionada", 500);
		}else{
			header("location:/companyagreement/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Aliados"]["Editar"])){
			header("location:/");	
		}
		$CompanyAgreementModel = new CompanyAgreementModel();
		$cityRes = $CompanyAgreementModel->find($params["params"][2]);
		if(empty($cityRes)){
			throw new \Exception("Ciudad no encontrada", 404);
		}
		if(!$CompanyAgreementModel->update($params["post"], $cityRes["id"])){
			throw new \Exception("No fue posible actualizar la ciudad, verifique la información proporcionada", 500);
		}else{
			header("location:/companyagreement/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Aliados"]["Editar"])){
			header("location:/");	
		}
		$CompanyAgreementModel = new CompanyAgreementModel();
		$city = $CompanyAgreementModel->find($params["params"][2]);
		if(empty($city)){
			throw new \Exception("Ciudad no encontrada", 404);
		}
		return $this->renderHtml("companyagreement/edit", ["city" => $city]);
	}
}