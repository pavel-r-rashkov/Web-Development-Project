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

	public function newsession() {
		return new ViewResult(new LoginBindingModel(), 'Sessions/NewSession.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function create(LoginBindingModel $loginData) {
		$user = $this->shopData->getUserRepository()->getUser($loginData->getUsername());
		if (!Utils::verifyHash($loginData->getPassword(), $user->getPasswordDigest())) {
			return new ViewResult($loginData, 'Sessions/NewSession.php');
		}
		
		$_SESSION['userId'] = $user->getId();
		$_SESSION['username'] = $user->getUsername();
		return new RedirectActionResult('home/index');
	}

}

?>