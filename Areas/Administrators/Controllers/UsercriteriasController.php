<?php

namespace Areas\Administrators\Controllers;
use Data\Contracts\IShopData;
use BindingModels\Usercriterias\CreateCriteriaBindingModel;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\UserCriteria;

/**
*@AuthorizeRole(Admin)
*/
class UsercriteriasController extends AdminController {
	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	public function newCriteria() {
		return new ViewResult(new CreateCriteriaBindingModel(), 'Usercriterias/NewCriteria.php');
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
			$newCriteria->getName(),
			$newCriteria->getMinimumDaysRegistered() == 0 ? null : $newCriteria->getMinimumDaysRegistered(), 
			$newCriteria->getMinimumCash() == 0 ? null : $newCriteria->getMinimumCash());

		$this->shopData->getUserCriteriaRepository()->addUserCriteria($criteria);

		return new RedirectActionResult('administrators/usercriterias/newcriteria');
	}
}

?>