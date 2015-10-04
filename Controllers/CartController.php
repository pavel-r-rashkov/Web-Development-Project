<?php

namespace Controllers;
use Data\Contracts\IShopData;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\Possession;
use ViewModels\ShowCartViewModel;

/**
*@AuthenticateUser()
*/
class CartController extends BaseController {
	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	public function show() {
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = array();
		}

		$sells = $this->shopData->getSellRepository()->getSellsByIds(array_keys($_SESSION['cart']), $this->currentUser());
		$total = array_reduce($sells, function($carry, $item) {
				$carry += $item->getPrice() * $_SESSION['cart'][$item->getId()];
				return $carry;
			});
		$totalDiscounted = array_reduce($sells, function($carry, $item) {
				$carry += $item->getPrice() * (1 - $item->getDiscount()) * $_SESSION['cart'][$item->getId()];
				return $carry;
			});
		$viewModel = new ShowCartViewModel($sells, $total, $totalDiscounted);
		return new PartialViewResult($viewModel, 'Cart/Show.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function add($id, $count) {
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = array();
		}				
		$_SESSION['cart'][$id] = max([(int)$count, 1]);
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
		$sellIds = array_keys($_SESSION['cart']);
		try {
			$this->shopData->beginTran();
			$sells = $this->shopData->getSellRepository()->getSellsByIds($sellIds, $this->currentUser());

			$sum = array_reduce($sells, function($carry, $item) {
				$carry += $item->getPrice() * (1 - $item->getDiscount()) * $_SESSION['cart'][$item->getId()];
				return $carry;
			});

			$user = $this->shopData->getUserRepository()->findUser($this->currentUser());
			if ($user->getMoney() < $sum) {
				$_SESSION['warrning'] = 'Not enough money';
				return new RedirectActionResult('sells/index');
			}

			$user->setMoney($user->getMoney() - $sum);
			$this->shopData->getUserRepository()->updateUser($user);

			foreach ($sells as $sell) {
				$existingPossession = $this->shopData->getPossessionRepository()->getPossessionByProductId($sell->getProductId(), $this->currentUser());

				if ($existingPossession != null) {
					$existingPossession->setQuantity($existingPossession->getQuantity() + $_SESSION['cart'][$sell->getId()]);
					$this->shopData->getPossessionRepository()->updatePossession($existingPossession);
				} else {
					$possession = new Possession(
			 		$sell->getProductId(),
			 		$this->currentUser(),
			 		$_SESSION['cart'][$sell->getId()]);
			 		$this->shopData->getPossessionRepository()->addPossession($possession);
				}

			 	if ($sell->getOwnerId() != null) {
			 		$owner = $this->shopData->getUserRepository()->findUser($sell->getOwnerId());
			 		$owner->setMoney($owner->getMoney() + $sum);
			 		$this->shopData->getUserRepository()->updateUser($owner);
			 	}
			 	// else add money to shop
			 	$sell->setQuantity($sell->getQuantity() - $_SESSION['cart'][$sell->getId()]);
			 	if ($sell->getQuantity() < 0) {
			 		throw new \Exception('Not enough quantity');
			 	}
			 	$this->shopData->getSellRepository()->updateSell($sell);
			 }

			$this->shopData->commitTran();
		}
		catch (\Exception $ex) {
			$this->shopData->rollBack();
			$_SESSION['warning'] = 'Error processing purchase';
			return new RedirectActionResult('sells/index');
		}

		$_SESSION['success'] = 'Products bought';
		return new RedirectActionResult('cart/clear');
	}
}

?>