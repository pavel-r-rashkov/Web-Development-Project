<?php

namespace Models;

class Possession {
	private $id;
	private $productId;
	private $ownerId;
	private $quantity;
	private $productName;

	public function __construct($productId, $ownerId, $quantity, $id = null, $productName = null) {
		$this->setId($id);
		$this->setProductId($productId);
		$this->setOwnerId($ownerId);
		$this->setQuantity($quantity);
		$this->setProductName($productName);
	}

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getProductId() {
		return $this->productId;
	}

	public function setProductId($value) {
		$this->productId = $value;
	}

	public function getOwnerId() {
		return $this->ownerId;
	}

	public function setOwnerId($value) {
		$this->ownerId = $value;
	}

	public function getQuantity() {
		return $this->quantity;
	}

	public function setQuantity($value) {
		$this->quantity = $value;
	}

	public function getProductName() {
		return $this->productName;
	}

	public function setProductName($value) {
		$this->productName = $value;
	}
}

?>