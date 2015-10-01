<?php

namespace Controllers;
use Data\Contracts\IShopData;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use BindingModels\CreatePromotionBindingModel;
use Models\Promotion;
use ViewModels\CreatePromotionViewModel;
use Core\Contracts\IRoleProvider;

class PromotionsController extends BaseController {
	private $roleProvider;

	public function __construct(IShopData $shopData, IRoleProvider $roleProvider) {
		parent::__construct($shopData);
		$this->roleProvider = $roleProvider;
	}

	public function newPromotion() {
		$criterias = $this->shopData->getUserCriteriaRepository()->getShopUserCriterias();
		$products = $this->shopData->getProductRepository()->getProducts();
		$categories = $this->shopData->getCategories()->getCategories();
		$viewModel = new CreatePromotionViewModel($criterias, $products, $categories);

		return new ViewResult($viewModel, 'Promotions/NewPromotion.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function create(CreatePromotionBindingModel $newPromotion) {
		if ($newPromotion == null || !$newPromotion->isValid()) {
			return new RedirectActionResult('editors/promotions/newpromotion');
		}

		$promotion = new Promotion(
			$newPromotion->getName(),
			$newPromotion->getStartDate(),
			$newPromotion->getEndDate(),
			$newPromotion->getDiscount(),
			$newPromotion->getUserCriteriaId(),
			null,
			$newPromotion->getProductId(),
			$newPromotion->getCategoryId());

		$userId = $this->currentUser();
		if (!$this->roleProvider->isAdmin($userId) && !$this-roleProvider()->isEditor($userId)) {
			$promotion->setUserId($userId);
		}
		
		$this->shopData->getPromotionRepository()->addPromotion($promotion);
		return new RedirectActionResult('sells/index');
	}
}

?>