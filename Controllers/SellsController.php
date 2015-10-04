<?php

namespace Controllers;
use Data\Contracts\IShopData;
use BindingModels\Sells\CreateUserSellBindingModel;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\Sell;
use ViewModels\CreateSellViewModel;

/**
*@AuthenticateUser()
*/
class SellsController extends BaseController {
	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	public function index() {
		$id = $this->currentUser();
		$sells = $this->shopData->getSellRepository()->getSells($id);
		return new ViewResult($sells, 'Sells/Index.php');
	}

	public function newSell() {
		$products = $this->shopData->getProductRepository()->getUserProducts($this->currentUser());
		$sellViewModel = new CreateSellViewModel($products);

		return new ViewResult($sellViewModel, 'Sells/NewSell.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function create(CreateUserSellBindingModel $newSell) {
		if ($newSell == null || !$newSell->isValid()) {
			$_SESSION['warrning'] = 'Invalid sell data';
			return new ViewResult($newSell, 'Sells/NewSell.php');
		}	
		$userId = $this->currentUser();

		try {
			$this->shopData->beginTran();
			$possession = $this->shopData->getPossessionRepository()->find($newSell->getPossessionId());
			if ($possession->getQuantity() - $newSell->getQuantity() < 0) {
				$_SESSION['warrning'] = 'Not enough quantity';
				return new ViewResult($newSell, 'Sells/NewSell.php');	
			}

			if ($possession->getOwnerId() != $userId) {
				$_SESSION['warrning'] = 'You can sell only your own products';
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
			$this->shopData->commitTran();
		}
		catch (\Exception $ex) {
			$this->shopData->rollBack();
			$_SESSION['warrning'] = 'Error creating sell';
			return new RedirectActionResult('sells/index');
		}

		return new RedirectActionResult('sells/index');
	}
}

?>