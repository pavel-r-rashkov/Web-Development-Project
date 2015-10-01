<?php

namespace Models;

class Product {
	private $id;
	private $name;
	private $quantity;
	private $description;
	private $categoryId;

	public function __construct($name, $quantity, $description, $categoryId, $id = null) {
		$this->setId($id);
		$this->setName($name);
		$this->setQuantity($quantity);
		$this->setDescription($description);
		$this->setCategoryId($categoryId);
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
		if ($value == null || strlen($value) < 5) {
			throw new \Exception('Product name must be at least 5 letters long');
		}
		$this->name = $value;
	}

	public function getQuantity() {
		return $this->quantity;
	}

	public function setQuantity($value) {
		if ($value < 0) {
			throw new \Exception('Product quantity cannot be negative');
		}
		$this->quantity = $value;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setDescription($value) {
		if ($value == null || strlen($value) < 10) {
			throw new \Exception('Product description must be at least 10 letters long');
		}
		$this->description = $value;
	}

	public function getCategoryId() {
		return $this->categoryId;
	}

	public function setCategoryId($value) {
		$this->id = $categoryId;
	}
}

?>