<?php

namespace Areas\Administrators\Controllers;
use Controllers\BaseController;
use Data\Contracts\IShopData;

abstract class AdminController extends BaseController {
	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}
}

?>