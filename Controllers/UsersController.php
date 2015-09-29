<?php

namespace Controllers;
use Data\Contracts\IShopData;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\User;
use BindingModels\Users\CreateUserBindingModel;
use Core\Utils;

class UsersController extends BaseController {
	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	public function newUser() {
		return new ViewResult(new CreateUserBindingModel(), 'Users/NewUser.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function create(CreateUserBindingModel $newUser) {
		if (!$newUser->isValid()) {
			return new ViewResult($newUser, 'Users/NewUser.php');
		}

		$existingUser = $this->shopData->getUserRepository()->getUser($newUser->getUsername());
		if ($existingUser != null) {
			return new ViewResult($newUser, 'Users/NewUser.php');
		}

		$hashed = Utils::digestPass($newUser->getPassword());
		$user = new User($newUser->getUsername(), $hashed);
		$this->shopData->getUserRepository()->addUser($user);		

		return new RedirectActionResult('sessions/newsession');
	}
}

?>