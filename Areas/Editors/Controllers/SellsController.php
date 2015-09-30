<?php

namespace Areas\Editors\Controllers;
use Data\Contracts\IShopData;
use BindingModels\Sells\CreateSellBindingModel;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\Sell;

class SellsController extends EditorsController {
	public function __construct(IShopData $shopData) {
		parent::($shopData);
	}

	public function newSell() {
		return new ViewResult(new CreateCriteriaBindingModel(), 'Sells/NewSell.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function create(CreateSellBindingModel $newSell) {
		if ($newSell == null || !$newSell->isValid()) {
			return new ViewResult($newSell, 'Sells/NewSell.php');
		}
		//begin tran
		$product = $this->shopData->getProductRepository()->find($newSell->getProductId());
		if ($product->getQuantity() - $newSell->getQuantity() < 0) {
			return new ViewResult($newSell, 'Sells/NewSell.php');	
		}

		$product->setQuantity($product->getQuantity() - $newSell->getQuantity());
		$this->shopData->getProductRepository()->updateProduct($product);

		$sell = new Sell(
			null,
			$newSell->getProductId(),
			$newSell->getQuantity(),
			$newSell->getPrice());
		$this->shopData->getSellRepository()->addSell($sell);
		//commit tran
		return new RedirectActionResult('sells/index');
	}
}

?>