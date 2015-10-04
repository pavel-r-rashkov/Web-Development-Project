<?php

namespace Areas\Administrators\Controllers;
use Data\Contracts\IShopData;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\User;
use ViewModels\UsersViewModel;
use Core\Utils;

/**
*@AuthorizeRole(Admin)
*/
class UsersController extends AdminController {
	const PAGE_SIZE = 10;

	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	public function index($page) {
		if($page == null) {
			$page = 0;
		}
		return new ViewResult($page, 'Users/Index.php');
	}

	public function paged($page) {
		$size = self::PAGE_SIZE;
		$users = $this->shopData->getUserRepository()->getUsers($page, $size);
		$count = $this->shopData->getUserRepository()->getUsersCount();

		$viewModel = new UsersViewModel($users, $count, $size, $page);
		return new PartialViewResult($viewModel, 'Users/Paged.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function ban($id) {
		$user = $this->shopData->getUserRepository()->findUser($id);
		$user->setBanned(true);
		$this->shopData->getUserRepository()->updateUser($user);

		return new RedirectActionResult('administrators/users/index');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function unban($id) {
		$user = $this->shopData->getUserRepository()->findUser($id);
		$user->setBanned(false);
		$this->shopData->getUserRepository()->updateUser($user);

		return new RedirectActionResult('administrators/users/index');
	}
}

?>