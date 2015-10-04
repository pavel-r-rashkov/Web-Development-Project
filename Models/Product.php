<?php

namespace Models;

class Product {
	private $id;
	private $name;
	private $quantity;
	private $description;
	private $categoryId;
	private $categoryName;

	public function __construct($name, $quantity, $description, $categoryId, $id = null, $categoryName = null) {
		$this->setId($id);
		$this->setName($name);
		$this->setQuantity($quantity);
		$this->setDescription($description);
		$this->setCategoryId($categoryId);
		$this->setCategoryName($categoryName);
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

	public function getCategoryName() {
		return $this->categoryName;
	}

	public function setCategoryName($value) {
		$this->categoryName = $value;
	}
}

?>