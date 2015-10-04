<?php

namespace Areas\Editors\Controllers;
use Data\Contracts\IShopData;
use BindingModels\Sells\CreateSellBindingModel;
use ViewModels\CreateSellViewModel;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\Sell;

/**
*@AuthorizeRole(Admin,Editor)
*/
class SellsController extends EditorsController {
	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	public function newSell() {
		$products = $this->shopData->getProductRepository()->getAllProducts();
		$sellViewModel = new CreateSellViewModel($products);

		return new ViewResult($sellViewModel, 'Sells/NewSell.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function create(CreateSellBindingModel $newSell) {
		if ($newSell == null || !$newSell->isValid()) {
			$_SESSION['warrning'] = 'Invalid sell data';
			return new RedirectActionResult('editors/sells/newsell');
		}

		try {
			$this->shopData->beginTran();
			$product = $this->shopData->getProductRepository()->find($newSell->getProductId());
			if ($product->getQuantity() - $newSell->getQuantity() < 0) {
				$_SESSION['warrning'] = 'Not enough quantity in stock';
				return new RedirectActionResult('editors/sells/newsell');
			}

			$product->setQuantity($product->getQuantity() - $newSell->getQuantity());
			$this->shopData->getProductRepository()->updateProduct($product);

			$sell = new Sell(
				null,
				$newSell->getProductId(),
				$newSell->getQuantity(),
				$newSell->getPrice());
			$this->shopData->getSellRepository()->addSell($sell);
		}
		catch (\Exception $ex){
			$this->shopData->rollBack();
			$_SESSION['warrning'] = 'Error creating sell';
			return new RedirectActionResult('sells/index');
		}

		$this->shopData->commitTran();
		$_SESSION['success'] = 'Sell created';
		return new RedirectActionResult('sells/index');
	}
}

?>