<?php 

namespace Controller;
use Model\CourseModel;
class CourseController extends Controller{

	public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Cursos"]["Listar"])){
			header("location:/");	
		}
		$CourseModel = new CourseModel();
		$cursoList = $CourseModel->all();
		return $this->renderHtml("course/index", ["cursoList"=>$cursoList]);
	}

	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Cursos"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("course/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Cursos"]["Crear"])){
			header("location:/");	
		}
		$CourseModel = new CourseModel();
		if(!$CourseModel->create($params["post"])){
			throw new \Exception("No fue posible crear el curso, verifique la información proporcionada", 500);
		}else{
			header("location:/course/");
		}
	}

	public function updateAction($params = []){
		if(empty($_SESSION["permissions"]["Cursos"]["Editar"])){
			header("location:/");	
		}
		$CourseModel = new CourseModel();
		$cursoRes = $CourseModel->find($params["params"][2]);
		if(empty($cursoRes)){
			throw new \Exception("curso no encontrado", 404);
		}
		if(!$CourseModel->update($params["post"], $cursoRes["id"])){
			throw new \Exception("No fue posible actualizar el curso, verifique la información proporcionada", 500);
		}else{
			header("location:/course/");
		}
		
	}


	public function editAction($params = []){
		if(empty($_SESSION["permissions"]["Cursos"]["Editar"])){
			header("location:/");	
		}
		$CourseModel = new CourseModel();
		$curso = $CourseModel->find($params["params"][2]);
		if(empty($curso)){
			throw new \Exception("curso no encontrado", 404);
		}
		return $this->renderHtml("course/edit", ["curso" => $curso]);
	}
}