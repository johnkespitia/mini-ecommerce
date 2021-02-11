<?php 

namespace Controller;
use Model\EmployeModel;
class EmployeController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
		$employeModel = new EmployeModel();
		$employeesList = $employeModel->all();
		return $this->renderHtml("employe/index", ["employeesList"=>$employeesList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
		return $this->renderHtml("employe/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
		$employeModel = new EmployeModel();
		if(!$employeModel->create($params["post"])){
			throw new \Exception("No fue posible crear el empleado, verifique la información proporcionada", 500);
		}else{
			header("location:/employe/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION) || ($_SESSION["rol_id"] != 1 && $_SESSION["rol_id"] != $params["params"][2] )){
			header("location:/");	
		}
		$employe = new EmployeModel();
		$employeRes = $employe->find($params["params"][2]);
		if(empty($employeRes)){
			throw new \Exception("Empleado no encontrado", 404);
		}
		if(!$employe->update($params["post"], $employeRes["id"])){
			throw new \Exception("No fue posible actualizar el Empleado, verifique la información proporcionada", 500);
		}else{
			header("location:/employe/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION) || ($_SESSION["rol_id"] != 1 && $_SESSION["rol_id"] != $params["params"][2] )){
			header("location:/");	
		}
		$employe = new EmployeModel();
		$user = $employe->find($params["params"][2]);
		if(empty($user)){
			throw new \Exception("Empleado no encontrado", 404);
		}
		return $this->renderHtml("employe/edit", ["customer" => $user]);
	}

	public function deleteAction($params = []){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
		$CarType = new CarTypeModel();
		$user = $CarType->find($params["params"][2]);
		if(empty($user)){
			throw new \Exception("Empleado no encontrado", 404);
		}
		
		if(!$CarType->delete($user["id"])){
			throw new \Exception("No fue posible eliminar el vahículo, verifique que no tenga eventos creados", 404);
		}else{
			header("location:/car/");
		}
	}

}