<?php

namespace Models;

class Sell {
	private $id;
	private $ownerId;
	private $productId;
	private $quantity;
	private $price;
	private $product;
	private $discount;

	public function __construct($ownerId, $productId, $quantity,
		$price, $id = null, $product = null, $discount = null) {
		$this->setId($id);
		$this->setOwnerId($ownerId);
		$this->setProductId($productId);
		$this->setQuantity($quantity);
		$this->setPrice($price);
		$this->setProduct($product);
		$this->setDiscount($discount);
	}

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getOwnerId() {
		return $this->ownerId;
	}

	public function setOwnerId($value) {
		$this->ownerId = $value;
	}

	public function getProductId() {
		return $this->productId;
	}

	public function setProductId($value) {
		$this->productId = $value;
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

	public function getProduct() {
		return $this->product;
	}

	public function setProduct($value) {
		$this->product = $value;
	}

	public function getDiscount() {
		return $this->discount;
	}

	public function setDiscount($value) {
		$this->discount = $value;
	}
}

?>