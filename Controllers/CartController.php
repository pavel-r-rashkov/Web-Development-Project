<?php

namespace Controllers;
use Data\Contracts\IShopData;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\Possession;

class CartController extends BaseController {
	public function __construct(IShopData $shopData) {
		parent::($shopData);
	}

	public function add($id) {		
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = array();
		}
		array_push($_SESSION['cart'], $id);
		return new RedirectActionResult('sells/index');
	}

	public function clear() {
		$_SESSION['cart'] = array();
		return new RedirectActionResult('sells/index');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function checkout() {
		$sellIds = $_SESSION['cart'];
		//begin tran
		$sells = $this->shopData->getSellRepository()->getSells($sellIds);
		$sum = array_reduct($sells, function($carry, $item) {

		});

		$user = $this->shopData->getUserRepository()->find($this->currentUser());
		if ($user->getMoney() < $sum) {
			return new RedirectActionResult('sells/index');
		}
		$this->shopData->getUserRepository()->takeMoney($this->currentUser(), $sum);

		foreach ($sells as $sell) {
		 	$possession = new Possession(
		 		$sell->getProductId(),
		 		$this->currentUser(),
		 		$sell->getQuantity());
		 	$this->shopData->getPossessionRepository()->addPossession($possession);
		 	if ($sell->getOwnerId != null) {
		 		$this->shopData->getUserRepository()->addMoney($sell->getOwnerId, $sell->getPrice());
		 	}
		 }

		 $this->shopData->getSellRepository()->deleteSells($sellIds);
		//end tran
		 return new RedirectActionResult('sells/index');
	}
}

?>