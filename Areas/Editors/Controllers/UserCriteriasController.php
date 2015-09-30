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

	public function show($id) {
		$criteria = $this->shopData->getUserCriteriaRepository()->find($id);
		return new PartialViewResult($criteria, 'UserCriterias/Show.php');
	}

}

?>