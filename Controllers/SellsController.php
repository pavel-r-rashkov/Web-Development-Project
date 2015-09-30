<?php

namespace Controllers;
use Data\Contracts\IShopData;
use BindingModels\Sells\CreateUserSellBindingModel;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\Sell;

class SellsController extends BaseController {
	public function __construct(IShopData $shopData) {
		parent::($shopData);
	}

	public function newSell() {
		return new ViewResult(new CreateUserSellBindingModel(), 'Sells/NewSell.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function create(CreateUserSellBindingModel $newSell) {
		if ($newSell == null || !$newSell->isValid()) {
			return new ViewResult($newSell, 'Sells/NewSell.php');
		}
		
		$userId = $this->currentUser();
		//begin tran
		$possession = $this->shopData->getPossessionRepository()->find($newSell->getPossessionId());
		if ($possession->getQuantity() - $newSell->getQuantity() < 0) {
			return new ViewResult($newSell, 'Sells/NewSell.php');	
		}

		if ($possession->getOwnerId() != $userId) {
			return new ViewResult($newSell, 'Sells/NewSell.php');	
		}

		$possession->setQuantity($possession->getQuantity() - $newSell->getQuantity());
		if($possession->getQuantity() == 0) {
			$this->shopData->getPossessionRepository()->deletePossession($possession->getId());
		} else {
			$this->shopData->getPossessionRepository()->updatePossession($possession);
		}

		$sell = new Sell(
			$userId,
			$possession->getProductId(),
			$newSell->getQuantity(),
			$newSell->getPrice());
		$this->shopData->getSellRepository()->addSell($sell);
		//commit tran
		return new RedirectActionResult('sells/index');
	}
}

?>