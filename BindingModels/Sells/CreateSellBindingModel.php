<?php

namespace BindingModels\Sells;

class CreateSellBindingModel {
	private $productId;
	private $quantity;
	private $price;

	public function getProductId() {
		return $this->productId;
	}

	public function setProductId($value) {
		$this->productId = $value;
	}

	public function getQuantity() {
		return $this->quantity;
	}

	public function setQuantity($value) {
		$this->quantity = $value;
	}

	public function getPrice() {
		return $this->price;
	}

	public function setPrice($value) {
		$this->price = $value;
	}

	public function isValid() {
		$validQuantity = $this->quantity > 0;
		$validPrice = $this->price > 0;
		return $validPrice && $validQuantity;
	}
}

?>