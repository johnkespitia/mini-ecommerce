<?php

namespace Controller;

class Controller{

	const VIEW_FOLDER=__DIR__."/../Views/";

	protected function renderHtml(string $view, array $vars = array()){
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

	protected static function renderHook(string $view, array $vars = []){
		extract($vars);
		ob_start();
		require(self::VIEW_FOLDER.$view.".hook.php");
		$content = ob_get_clean();
		return $content;
	}

}