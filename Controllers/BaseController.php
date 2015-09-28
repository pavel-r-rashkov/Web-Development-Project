<?php

namespace Controllers;
use Core\Controllers\DefaultController;
use Data\Contracts\IShopData;

class BaseController extends DefaultController {
	protected $shopData;

	public function __construct(IShopData $shopData) {
		$this->shopData = $shopData;
	}
}

?>