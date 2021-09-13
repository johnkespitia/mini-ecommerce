<?php

namespace Controller;

use Model\ChecklistQuestionModel;
use Model\ChecklistQuestionOptionModel;
use Model\ChecklistQuestionTypeModel;
use Model\ChecklistTemplateModel;
use Model\ChecklistTypeModel;

class ChecklistController extends Controller
{
	public function indexAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Checklist Vehículos"]["Listar"])) {
			header("location:/");
		}
		$checkListTypeModel =  new ChecklistTypeModel;
		$typelist = $checkListTypeModel->find($params["params"][2]);
		if (!$typelist) {
			throw new \Exception("No se encontró el checlist indicado, verifique la información proporcionada", 404);
		}
		$checkListModel = new ChecklistTemplateModel();
		$checksLists = $checkListModel->findBy([
			["c1.checklist_type", ChecklistTemplateModel::EQUAL, $params["params"][2]]
		]);

		return $this->renderHtml("checklists/index", [
			"checksLists" => $checksLists,
			"typelist" => $typelist
		]);
	}

	public function newAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Checklist Vehículos"]["Crear"])) {
			header("location:/");
		}
		$checkListTypeModel =  new ChecklistTypeModel;
		$typelist = $checkListTypeModel->find($params["params"][2]);
		if (!$typelist) {
			throw new \Exception("No se encontró el checlist indicado, verifique la información proporcionada", 404);
		}
		$checkListModel = new ChecklistTemplateModel();
		$checksLists = $checkListModel->findBy([
			["c1.checklist_type", ChecklistTemplateModel::EQUAL, $params["params"][2]]
		]);
		return $this->renderHtml("checklists/new", ["checksLists" => $checksLists, "typelist" => $typelist]);
	}

	public function newtypeAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Checklist Vehículos"]["Crear"])) {
			header("location:/");
		}
		return $this->renderHtml("checklists/newtype");
	}

	public function detailAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Checklist Vehículos"]["Crear"])) {
			header("location:/");
		}
		$checkListModel = new ChecklistTemplateModel();
		$checksList = $checkListModel->find($params['params'][2]);
		$questionTypeModel = new ChecklistQuestionTypeModel();
		$questionTypes = $questionTypeModel->all();
		$questionModel = new ChecklistQuestionModel();
		$questionOptionModel = new ChecklistQuestionOptionModel();
		$questionsPre = $questionModel->findBy([
			["q.checklist_template_id", ChecklistQuestionModel::EQUAL, $params['params'][2]]
		]);
		$questions = [];
		foreach ($questionsPre as $qp) {
			$options = $questionOptionModel->findBy([
				["question_id", ChecklistQuestionOptionModel::EQUAL, $qp['id']]
			]);
			$qp['options'] = $options;
			$questions[] = $qp;
		}
		return $this->renderHtml("checklists/detail", ["checksList" => $checksList, "questionTypes" => $questionTypes, "questions" => $questions]);
	}

	public function storeAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Checklist Vehículos"]["Crear"])) {
			header("location:/");
		}
		$checklistModel = new ChecklistTemplateModel();
		$params["post"]["version"] = 1;
		if (!$checklistModel->create($params["post"])) {
			throw new \Exception("No fue posible crear la checklist, verifique la información proporcionada", 500);
		} else {
			$cheklistId = $checklistModel->getLastId();
			header("location:/checklist/index/" . $cheklistId);
		}
	}
	public function storetypeAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Checklist Vehículos"]["Crear"])) {
			header("location:/");
		}
		$checklistModel = new ChecklistTypeModel();
		$params["post"]["version"] = 1;
		if (!$checklistModel->create($params["post"])) {
			throw new \Exception("No fue posible crear la checklist, verifique la información proporcionada", 500);
		} else {
			$cheklistId = $checklistModel->getLastId();
			header("location:/checklist/index/" . $cheklistId);
		}
	}

	public function editAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Checklist Vehículos"]["Crear"])) {
			header("location:/");
		}
		$checkListModel = new ChecklistTemplateModel();
		$checksLists = $checkListModel->all();
		$checkList = $checkListModel->find($params['params'][2]);
		return $this->renderHtml("checklists/edit", ["checksLists" => $checksLists, "checklist" => $checkList]);
	}

	public function updateAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Checklist Vehículos"]["Editar"])) {
			header("location:/");
		}
		$checklistTemplateModel = new ChecklistTemplateModel();
		$checklistTemplateRes = $checklistTemplateModel->find($params["params"][2]);
		if (empty($checklistTemplateRes)) {
			throw new \Exception("checklist no encontrada", 404);
		}
		$params["post"]["version"] = $checklistTemplateRes["version"] + 1;
		$params["post"]["checklist_type"] = $checklistTemplateRes["checklist_type"];
		if (!$checklistTemplateModel->update($params["post"], $checklistTemplateRes["id"])) {
			throw new \Exception("No fue posible actualizar la checklist, verifique la información proporcionada", 500);
		} else {
			header("location:/checklist/index/" . $checklistTemplateRes["checklist_type"]);
		}
	}

	public function storequestionAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Checklist Vehículos"]["Editar"])) {
			header("location:/");
		}
		$checklistTemplateModel = new ChecklistTemplateModel();
		$checklistTemplateRes = $checklistTemplateModel->find($params["params"][2]);
		if (empty($checklistTemplateRes)) {
			throw new \Exception("checklist no encontrada", 404);
		}
		$checklistTemplateRes['version'] += 1;
		$checklistQuestionModel = new ChecklistQuestionModel();
		$checklistQuestionOptionModel = new ChecklistQuestionOptionModel();
		$params["post"]["checklist_template_id"] = $params["params"][2];
		if (!$checklistQuestionModel->create($params["post"])) {
			throw new \Exception("No fue posible crear la pregunta de la checklist, verifique la información proporcionada", 500);
		}
		$questionId = $checklistQuestionModel->getLastId();
		if (!empty($params["post"]["options"])) {
			$options = explode("\n", $params["post"]["options"]);
			foreach ($options as $opt) {
				$checklistQuestionOptionModel->create([
					"question_id" => $questionId,
					"option_text" => $opt
				]);
			}
		}
		if (!$checklistTemplateModel->update($checklistTemplateRes, $checklistTemplateRes['id'])) {
			throw new \Exception("No fue posible actualizar la checklist, verifique la información proporcionada", 500);
		}
		header("location:/checklist/detail/" . $params["params"][2]);
	}

	public function deletequestionAction($params = [])
	{
		if (empty($_SESSION["permissions"]["Checklist Vehículos"]["Editar"])) {
			header("location:/");
		}
		$checklistQuestionModel = new ChecklistQuestionModel();
		$chquestion = $checklistQuestionModel->find($params["params"][2]);
		if (empty($chquestion)) {
			throw new \Exception("Pregunta no encontrada", 404);
		}
		$checklistQuestionOptionModel = new ChecklistQuestionOptionModel();
		$checklistQuestionOptionModel->delete([
			['question_id', ChecklistQuestionOptionModel::EQUAL, $chquestion['id']]
		]);

		$checklistTemplateModel = new ChecklistTemplateModel();
		$checklistTemplateRes = $checklistTemplateModel->find($chquestion["checklist_template_id"]);
		$checklistTemplateRes['version'] += 1;
		if (!$checklistQuestionModel->delete([
			['id', ChecklistQuestionModel::EQUAL, $chquestion['id']]
		])) {
			throw new \Exception("No fue posible eliminar la pregunta de la checklist, verifique la información proporcionada", 500);
		}

		if (!$checklistTemplateModel->update($checklistTemplateRes, $checklistTemplateRes['id'])) {
			throw new \Exception("No fue posible actualizar la checklist, verifique la información proporcionada", 500);
		}
		header("location:/checklist/detail/" . $checklistTemplateRes['id']);
	}

	public static function menuHook()
	{
		$checklistTypes = new ChecklistTypeModel;
		$list = $checklistTypes->findBy([
			["q.status", ChecklistTypeModel::EQUAL, "1"]
		]);
		return self::renderHook("checklists/hook/menu", ["list" => $list]);
	}

	public function getlistAction($params = [])
	{
		$checklists = new ChecklistTypeModel();
		$chlists = $checklists->findBy([
			["q.status", ChecklistTypeModel::EQUAL, "1"]
		]);
		$checkListArray = [];
		foreach ($chlists as $ch) {
			$checkListArray[] = $ch;
		}
		return $this->renderJson(["code" => 200, "data" => $checkListArray]);
	}

	public function getlistsectionAction($params = [])
	{
		$checklists = new ChecklistTemplateModel();
		$checklistQuestionModel = new ChecklistQuestionModel();
		$checklistOptionModel = new ChecklistQuestionOptionModel();
		$chlists = $checklists->findBy([
			["c1.status", ChecklistTemplateModel::EQUAL, "1"],
			["c1.checklist_type", ChecklistTemplateModel::EQUAL, $params["params"][2]],
		]);
		$checkListArray = [];
		foreach ($chlists as $ch) {
			$ch["questions"] = [];
			$questions = $checklistQuestionModel->findBy([
				["q.checklist_template_id", ChecklistQuestionModel::EQUAL, $ch["id"]],
			]);
			foreach ($questions as $qt) {
				if($qt["question_type_id"] == 4 ){
					$options=$checklistOptionModel->findBy([
						["question_id", ChecklistQuestionOptionModel::EQUAL, $qt["id"]],
					]);
					$qt["options"] = [];
					foreach ($options as $op) {
						$qt["options"][]=$op;
					}
				}
				$ch["questions"][]=$qt;
			}
			$checkListArray[] = $ch;
		}
		return $this->renderJson(["code" => 200, "data" => $checkListArray]);
	}
}
