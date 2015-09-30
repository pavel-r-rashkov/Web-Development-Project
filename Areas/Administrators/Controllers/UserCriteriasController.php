<?php

namespace Areas\Administrators\Controllers;
use Data\Contracts\IShopData;
use BindingModels\UserCriterias\CreateCriteriaBindingModel;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\UserCriteria;

class UserCriteriasController extends AdminController {
	public function __construct(IShopData $shopData) {
		parent::($shopData);
	}

	public function newCriteria() {
		return new ViewResult(new CreateCriteriaBindingModel(), 'UserCriterias/NewCriteria.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function create(CreateCriteriaBindingModel $newCriteria) {
		if ($newCriteria == null || !$newCriteria->isValid()) {
			return new ViewResult($newCriteria, 'UserCriterias/NewCriteria.php');
		}

		$criteria = new UserCriteria(
			$newcriteria->getName(),
			$newCriteria->getMinimumDaysRegistered(), 
			$newCriteria->getMinimumCash());
		$this->shopData->getUserCriteriaRepository()->addUserCriteria($criteria);

		return new RedirectActionResult('administrators/usercriterias/newcriteria');
	}
}

?>