<?php 

namespace Controller;
use Model\RolModel;
use Model\PermissionModel;
class PermissionController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Roles"]["Listar"])){
			header("location:/");	
		}
		$RolModel = new RolModel();
		$rol = $RolModel->find($params["params"][2]);
		if(empty($rol)){
			throw new \Exception("Rol no encontrado", 404);
		}
		$permissionModel = new PermissionModel();
		$permissionList = $permissionModel->findBy([
			["rol_id",PermissionModel::EQUAL,$rol["id"]]
		]);
		return $this->renderHtml("permission/index", ["rol"=>$rol, "permissionList"=>$permissionList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Roles"]["Crear"])){
			header("location:/");	
		}
		$RolModel = new RolModel();
		$rol = $RolModel->find($params["params"][2]);
		if(empty($rol)){
			throw new \Exception("Rol no encontrado", 404);
		}
		return $this->renderHtml("permission/new", ["rol"=>$rol]);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Roles"]["Listar"])){
			header("location:/");	
		}
		$permissionModel = new PermissionModel();
		if(!$permissionModel->create($params["post"])){
			throw new \Exception("No fue posible crear el permiso, verifique la información proporcionada", 500);
		}else{
			header("location:/permission/index/".$params["post"]["rol_id"]);
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Roles"]["Editar"])){
			header("location:/");	
		}
		$permissionModel = new PermissionModel();
		$permissionRes = $permissionModel->find($params["params"][2]);
		if(empty($permissionRes)){
			throw new \Exception("Permiso no encontrado", 404);
		}
		if(!$permissionModel->update($params["post"], $permissionRes["id"])){
			throw new \Exception("No fue posible actualizar el permiso, verifique la información proporcionada", 500);
		}else{
			header("location:/permission/index/".$permissionRes["rol_id"]);
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Roles"]["Editar"])){
			header("location:/");	
		}
		$permissionModel = new PermissionModel();
		$permission = $permissionModel->find($params["params"][2]);
		if(empty($permission)){
			throw new \Exception("Permiso no encontrado", 404);
		}
		$RolModel = new RolModel();
		$rol = $RolModel->find($permission["rol_id"]);
		if(empty($rol)){
			throw new \Exception("Rol no encontrado", 404);
		}
		return $this->renderHtml("permission/edit", ["rol" => $rol, "permission"=>$permission]);
	}
}