<?php

namespace Controller;

use Model\UserModel;
use Model\PermissionModel;
use Services\MailService;

class HomeController extends Controller
{
	public function indexAction($params = [])
	{
		if (empty($_SESSION)) {
			return $this->renderHtml("home/index", $params);
		} else {
			return $this->renderHtml("home/index-logged", $params);
		}
	}

	public function testemailAction($params = [])
	{
		if (empty($_SESSION)) {
			return $this->renderHtml("home/index", $params);
		} else {
			$mailer = new MailService();
			$content = $this->renderEmail("mail/test", []);
			$mailer->testMail($_ENV["MAILER_USERNAME"], "test mail", $content);
		}
	}

	public function loginAction($params = [])
	{
		if (!empty($_SESSION)) {
			header("location:/");
		}
		if (!empty($params["post"])) {
			$userModel = new UserModel;
			$userSearch = $userModel->findBy([
				["u.email", UserModel::CONTAIN, $params["post"]["email"]],
				["u.password", UserModel::CONTAIN, md5($params["post"]["password"])],
				["u.status", UserModel::EQUAL, 1],
			], true);
			$userAuth = $userSearch->getReturn();
			if (!empty($userAuth)) {
				unset($userAuth["password"]);
				$permissionModel = new PermissionModel;
				$permissions = $permissionModel->findBy([
					["rol_id", PermissionModel::EQUAL, $userAuth["rol_id"]]
				]);
				$userAuth["permissions"] = [];
				foreach ($permissions as $value) {
					if ($value["status"] == 1) {
						if (!isset($userAuth["permissions"][$value["module"]])) {
							$userAuth["permissions"][$value["module"]] = [];
						}
						$userAuth["permissions"][$value["module"]][$value["permission"]] = $value["status"];
					}
				}
				$_SESSION = $userAuth;
				header("location:/");
			} else {
				$params["errors"] = "User not found";
			}
		}
		return $this->renderHtml("home/login", $params);
	}

	public function logoutAction($params = [])
	{
		session_destroy();
		header("location:/");
	}
}
