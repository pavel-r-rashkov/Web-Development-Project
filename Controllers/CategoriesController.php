<?php

namespace Controllers;
use Controllers\BaseController;
use Data\Contracts\IShopData;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;

/**
*@AuthenticateUser()
*/
class CategoriesController extends BaseController {
	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	public function all() {
		$categories = $this->shopData->getCategoryRepository()->getCategories();
		return new PartialViewResult($categories, 'Categories/All.php');
	}
}

?>