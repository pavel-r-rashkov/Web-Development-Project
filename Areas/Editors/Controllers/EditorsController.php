<?php

namespace Areas\Editors\Controllers;
use Controllers\BaseController;
use Data\Contracts\IShopData;

abstract class EditorsController extends BaseController {
	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}
}

?>