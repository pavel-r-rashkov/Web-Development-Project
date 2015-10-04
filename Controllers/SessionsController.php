<?php

namespace Controllers;
use Data\Contracts\IShopData;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use BindingModels\Users\LoginBindingModel;
use Core\Utils;

class SessionsController extends BaseController {
	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	/**
	*@Route(login)
	*/
	public function newsession() {
		if ($this->currentUser() != null) {
			$_SESSION['warrning'] = 'You are already logged in';
			return new RedirectActionResult('home/index');
		}
		return new ViewResult(new LoginBindingModel(), 'Sessions/NewSession.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function create(LoginBindingModel $loginData) {
		if ($this->currentUser() != null) {
			$_SESSION['warrning'] = 'You are already logged in';
			return new RedirectActionResult('home/index');
		}

		$user = $this->shopData->getUserRepository()->getUser($loginData->getUsername());

		if (!Utils::verifyHash($loginData->getPassword(), $user->getPasswordDigest())) {
			$_SESSION['warrning'] = 'Invalid password / username';
			return new ViewResult($loginData, 'Sessions/NewSession.php');
		}

		if ($user->getBanned() == 1) {
			$_SESSION['warrning'] = 'You are banned';
			return new ViewResult($loginData, 'Sessions/NewSession.php');
		}

		$_SESSION['userId'] = $user->getId();
		$_SESSION['username'] = $user->getUsername();

		return new RedirectActionResult('home/index');
	}

	public function destroy() {
		session_destroy();
		return new RedirectActionResult('sessions/newsession');
	}

}

?>