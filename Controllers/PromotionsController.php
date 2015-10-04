<?php

namespace Controllers;
use Data\Contracts\IShopData;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use BindingModels\Promotions\CreatePromotionBindingModel;
use Models\Promotion;
use ViewModels\CreatePromotionViewModel;
use Core\Contracts\IRoleProvider;

/**
*@AuthenticateUser()
*/
class PromotionsController extends BaseController {
	private $roleProvider;

	public function __construct(IShopData $shopData, IRoleProvider $roleProvider) {
		parent::__construct($shopData);
		$this->roleProvider = $roleProvider;
	}

	public function newPromotion() {
		$criterias = $this->shopData->getUserCriteriaRepository()->getUserCriterias();
		$products = $this->shopData->getProductRepository()->getAllProducts();
		$categories = $this->shopData->getCategoryRepository()->getCategories();
		$viewModel = new CreatePromotionViewModel($criterias, $products, $categories);

		return new ViewResult($viewModel, 'Promotions/NewPromotion.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function create(CreatePromotionBindingModel $newPromotion) {
		if ($newPromotion == null || !$newPromotion->isValid()) {
			$_SESSION['warrning'] = 'Invalid promotion data';
			return new RedirectActionResult('promotions/newpromotion');
		}

		$promotion = new Promotion(
			$newPromotion->getName(),
			$newPromotion->getStartDate(),
			$newPromotion->getEndDate(),
			$newPromotion->getDiscount(),
			$newPromotion->getUserCriteriaId() == 0 ? null : $newPromotion->getUserCriteriaId(),
			null,
			$newPromotion->getProductId() == 0 ? null : $newPromotion->getProductId(),
			$newPromotion->getCategoryId() == 0 ? null : $newPromotion->getCategoryId());

		$userId = $this->currentUser();
		if (!$this->roleProvider->isAdmin($userId) && !$this-roleProvider()->isEditor($userId)) {
			$promotion->setUserId($userId);
		}
		
		$this->shopData->getPromotionRepository()->addPromotion($promotion);
		return new RedirectActionResult('home/index');
	}
}

?>