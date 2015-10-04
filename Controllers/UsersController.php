<?php

namespace Controllers;
use Data\Contracts\IShopData;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\User;
use BindingModels\Users\CreateUserBindingModel;
use Core\Utils;

class UsersController extends BaseController {
	const INITIAL_CASH = 200;

	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	/**
	*@Route(register)
	*/
	public function newUser() {
		if ($this->currentUser() != null) {
			$_SESSION['warrning'] = 'You need to log out first';
			return new RedirectActionResult('home/index');
		}

		return new ViewResult(new CreateUserBindingModel(), 'Users/NewUser.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function create(CreateUserBindingModel $newUser) {
		if ($this->currentUser() != null) {
			$_SESSION['warrning'] = 'You need to log out first';
			return new RedirectActionResult('home/index');
		}

		if (!$newUser->isValid()) {
			$_SESSION['warrning'] = 'Invalid register data.';
			return new ViewResult($newUser, 'Users/NewUser.php');
		}

		$existingUser = $this->shopData->getUserRepository()->getUser($newUser->getUsername());
		if ($existingUser != null) {
			$_SESSION['warrning'] = 'User with that name already exists.';
			return new ViewResult($newUser, 'Users/NewUser.php');
		}

		$hashed = Utils::digestPass($newUser->getPassword());
		$user = new User($newUser->getUsername(), $hashed, self::INITIAL_CASH);
		$user->setBanned(false);
		$user->setRegisterDate(date("Y-m-d"));
		$this->shopData->getUserRepository()->addUser($user);		

		return new RedirectActionResult('sessions/newsession');
	}
}

?>