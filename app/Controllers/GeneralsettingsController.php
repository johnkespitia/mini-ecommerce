<?php

namespace Controller;
use Model\GeneralSettingModel;
class GeneralsettingsController extends Controller{

	public function __construct(){
		if(empty($_SESSION) || $_SESSION["rol_id"] != 1){
			header("location:/");	
		}
	}

	public function indexAction($params = []){
		$settingsModel = new GeneralSettingModel();
		$settingsList = $settingsModel->all();
		return $this->renderHtml("general-settings/index", ["settingslist"=>$settingsList]);
	}

	public function newAction($params = []){
		return $this->renderHtml("general-settings/new", []);
	}

	public function storeAction($params = []){
		$settingsModel = new GeneralSettingModel();
		$settingsList = $settingsModel->create($params["post"]);
		header("location:/generalsettings/");
	}

	public function updateAction($params = []){
		$settingsModel = new GeneralSettingModel();
		$generalsetting = $settingsModel->find($params["params"][2]);
		if(empty($generalsetting)){
			throw new \Exception("Config not found", 404);
		}
		$settingsList = $settingsModel->update($params["post"], $generalsetting["id"]);
		header("location:/generalsettings/");
	}


	public function editAction($params = []){
		$settingsModel = new GeneralSettingModel();
		$setting = $settingsModel->find($params["params"][2]);
		if(empty($setting)){
			throw new \Exception("Config not found", 404);
		}
		return $this->renderHtml("general-settings/edit", ["setting"=>$setting]);
	}
}