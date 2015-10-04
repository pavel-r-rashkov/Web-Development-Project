<?php

namespace Controllers;
use Data\Contracts\IShopData;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;

/**
*@AuthenticateUser()
*/
class HomeController extends BaseController {
	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	public function index() {
		return new ViewResult(null, 'Home/Index.php');
	}
}

?>