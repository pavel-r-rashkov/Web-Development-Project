<?php

namespace ViewModels;

class CreatePromotionViewModel {
	private $userCriterias;
	private $products;
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
		$options = array(0 => 'No user restriction');
		foreach ($value as $criteria) {
			$options[$criteria->getId()] = $criteria->getName();
		}
		$this->userCriterias = $options;
	}

	public function getProducts() {
		return $this->products;
	}

	public function setProducts($value) {
		$options = array(0 => 'No product restriction');
		foreach ($value as $product) {
			$options[$product->getId()] = $product->getName();
		}
		$this->products = $options;
	}

	public function getCategories() {
		return $this->categories;
	}

	public function setCategories($value) {
		$options = array(0 => 'No category restriction');
		foreach ($value as $category) {
			$options[$category->getId()] = $category->getName();
		}
		$this->categories = $options;
	}
}

?>