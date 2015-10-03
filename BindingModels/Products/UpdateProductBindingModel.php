<?php

namespace BindingModels\Products;

class UpdateProductBindingModel {
	private $id;
	private $quantity;
	private $description;
	private $categoryId;

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
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

	public function isValid() {
		$validQuantity = $this->quantity >= 0;
		$validDescription = $this->description != null && strlen($this->description) >= 10;
		return $validQuantity && $validDescription;
	}
}

?>