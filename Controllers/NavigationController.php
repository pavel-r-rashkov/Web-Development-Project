<?php

namespace Controllers;
use Controllers\BaseController;
use ViewModels\NavigationViewModel;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\Contracts\IRoleProvider;
use Data\Contracts\IShopData;

class NavigationController extends BaseController {
	private $roleProvider;

	public function __construct(IShopData $shopData, IRoleProvider $roleProvider) {
		parent::__construct($shopData);
		$this->roleProvider = $roleProvider;
	}

	public function show() {
		$isAdmin = $this->roleProvider->isAdmin($this->currentUser());
		$isEditor = $this->roleProvider->isEditor($this->currentUser());
		$username = $this->getUsername();
		$navModel = new NavigationViewModel($isAdmin, $isEditor, $username);

		return new PartialViewResult($navModel, 'Navigation/Show.php');
	}
}

?>