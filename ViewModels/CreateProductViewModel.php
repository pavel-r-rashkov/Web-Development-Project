<?php

namespace ViewModels;

class CreateProductViewModel {
	private $categories;

	public function __construct($categories) {
		$this->setCategories($categories);
	}

	public function getCategories() {
		return $this->categories;
	}

	public function setCategories($value) {
		$options = array();
		foreach ($value as $category) {
			$options[$category->getId()] = $category->getName();
		}
		$this->categories = $options;
	}
}

?>