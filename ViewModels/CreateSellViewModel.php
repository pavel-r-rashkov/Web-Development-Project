<?php

namespace ViewModels;
class CreateSellViewModel {
	private $products;

	public function __construct($products) {
		$this->setProducts($products);
	}

	public function getProducts() {
		return $this->products;
	}

	public function setProducts($value) {
		$options = array();
		foreach ($value as $product) {
			$options[$product->getId()] = $product->getName();
		}
		$this->products = $options;
	}
}

?>