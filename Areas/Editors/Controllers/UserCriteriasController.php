<?php

namespace Areas\Editors\Controllers;
use Data\Contracts\IShopData;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\UserCriteria;

class UserCriteriasController extends EditorsController {
	public function __construct(IShopData $shopData) {
		parent::($shopData);
	}

	public function all() {
		$criterias = $this->shopData->getUserCriteriaRepository()->getUserCriterias();
		return new ViewResult($criterias, 'UserCriterias/All.php');
	}

}

?>