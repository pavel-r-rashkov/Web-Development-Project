<?php

namespace Controllers;
use Core\Controllers\DefaultController;
use Data\Contracts\IShopData;

class BaseController extends DefaultController {
	protected $shopData;

	public function __construct(IShopData $shopData) {
		$this->shopData = $shopData;
	}

	protected function currentUser() {
		if (!isset($_SESSION['userId'])) {
			return null;
		}
		return $_SESSION['userId'];
	}

	protected function getUsername() {
		return $_SESSION['username'];
	}
}

?>