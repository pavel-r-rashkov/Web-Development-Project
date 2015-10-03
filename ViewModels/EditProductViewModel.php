<?php

namespace ViewModels;

class EditProductViewModel {
	private $id;
	private $name;
	private $quantity;
	private $description;
	private $categoryId;
	private $categories;

	public function __construct($id, $name, $quantity, $description, $categoryId, $categories) {
		$this->setId($id);
		$this->setName($name);
		$this->setQuantity($quantity);
		$this->setDescription($description);
		$this->setCategoryId($categoryId);
		$this->setCategories($categories);
	}

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($value) {
		$this->name = $value;
	}

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

	public function getCategoryId() {
		return $this->categoryId;
	}

	public function setCategoryId($value) {
		$this->categoryId = $value;
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