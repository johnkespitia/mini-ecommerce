<?php
namespace Controller;

use Model\ChecklistTemplateModel;

class ChecklistController extends Controller{
    public function indexAction($params = []){
		if(empty($_SESSION["permissions"]["Checklist Vehículos"]["Listar"])){
			header("location:/");	
		}

		$checkListModel = new ChecklistTemplateModel();
		$checksLists = $checkListModel->all();

		return $this->renderHtml("checklists/index", [
            "checksLists"=> $checksLists
        ]);
	}
    
	public function newAction($params = []){
		if(empty($_SESSION["permissions"]["Checklist Vehículos"]["Crear"])){
			header("location:/");	
		}
		return $this->renderHtml("checklists/new", []);
	}

	public function storeAction($params = []){
		if(empty($_SESSION["permissions"]["Checklist Vehículos"]["Crear"])){
			header("location:/");	
		}
		$checklistModel = new ChecklistTemplateModel();
		if(!$checklistModel->create($params["post"])){
			throw new \Exception("No fue posible crear la ciudad, verifique la información proporcionada", 500);
		}else{
			header("location:/city/");
		}
	}

}


