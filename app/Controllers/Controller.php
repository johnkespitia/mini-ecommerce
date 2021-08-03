<?php

namespace Controller;

class Controller{

	const VIEW_FOLDER=__DIR__."/../Views/";
	protected $_entityManager;

	public function setEntityManager($entityManager)
	{
		$this->_entityManager = $entityManager;
	}

	protected function renderHtml(string $view, array $vars){
		extract($vars);
		ob_start();
		require(self::VIEW_FOLDER."layout/header.php");
		require(self::VIEW_FOLDER.$view.".php");
		require(self::VIEW_FOLDER."layout/footer.php");
		$content = ob_get_clean();
		return $content;
	}

	protected function renderEmail(string $view, array $vars){
		extract($vars);
		ob_start();
		require(self::VIEW_FOLDER."layout/headeremail.php");
		require(self::VIEW_FOLDER.$view.".php");
		require(self::VIEW_FOLDER."layout/footer.php");
		$content = ob_get_clean();
		return $content;
	}

	protected function renderJson(array $vars = []){
		header('Content-Type: application/json');
		return json_encode($vars);
	}

	
}