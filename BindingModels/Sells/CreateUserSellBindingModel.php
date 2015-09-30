<?php

namespace BindingModels;

class CreateSellBindingModel {
	private $possessionId;
	private $quantity;
	private $price;

	public function getPossessionId() {
		return $this->$possessionId;
	}

	public function setPossessionId($value) {
		$this->$possessionId = $value;
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