<?php

namespace BindingModels\Products;

class UpdateProductBindingModel {
	private $quantity;
	private $description;

	public function getQuantity() {
		return $this->quantity;
	}

	public function setQuantity($value) {
		$this->quantity = $value;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($value) {
		$this->description = $value;
	}

	public function isValid() {
		$validName = $this->name != null && strlen($value) >= 5;
		$validQuantity = $this->quantity >= 0;
		$valudDescription = $this->description != null && strlen($this->description) >= 10;
		return $validName && $validQuantity && $validDescription;
	}
}

?>