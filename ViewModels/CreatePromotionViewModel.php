<?php

namespace ViewModels;

class CreatePromotionViewModel {
	private $userCriterias;
	private $products
	private $categories;

	public function __construct($userCriterias, $products, $categories) {
		$this->setUserCriterias($userCriterias);
		$this->setProducts($products);
		$this->setCategories($categories);
	}

	public function getUserCriterias() {
		return $this->userCriterias;
	}

	public function setUserCriterias($value) {
		$this->userCriterias = $value;
	}

	public function getProducts() {
		return $this->userCriterias;
	}

	public function setProducts($value) {
		$this->userCriterias = $value;
	}

	public function getCategories() {
		return $this->userCriterias;
	}

	public function setCategories($value) {
		$this->userCriterias = $value;
	}
}

?>