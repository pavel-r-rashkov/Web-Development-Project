<?php

namespace Models;

class Possession {
	private $id;
	private $productId;
	private $ownerId;
	private $quantity;

	public function __construct($productId, $ownerId, $quantity, $id = null) {
		$this->setId($id);
		$this->setProductId($productId);
		$this->setOwnerId($ownerId);
		$this->setQuantity($quantity);
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
}

?>