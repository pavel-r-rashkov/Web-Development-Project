<?php

namespace BindingModels\Promotions;

class CreatePromotionBindingModel {
	private $name;
	private $startDate;
	private $endDate;
	private $discount;
	private $userCriteriaId;
	private $productId;
	private $categoryId;

	public function getName() {
		return $this->name;
	}

	public function setName($value) {
		$this->name = $value;
	}

	public function getStartDate() {
		return $this->startDate;
	}

	public function setStartDate($value) {
		$this->startDate = $value;
	}

	public function getEndDate() {
		return $this->endDate;
	}

	public function setEndDate($value) {
		$this->endDate = $value;
	}

	public function getDiscount() {
		return $this->discount;
	}

	public function setDiscount($value) {
		$this->discount = $value / 100;
	}

	public function getUserCriteriaId() {
		return $this->userCriteriaId;
	}

	public function setUserCriteriaId($value) {
		$this->userCriteriaId = $value;
	}

	public function getProductId() {
		return $this->productId;
	}

	public function setProductId($value) {
		$this->productId = $value;
	}

	public function getCategoryId() {
		return $this->categoryId;
	}

	public function setCategoryId($value) {
		$this->categoryId = $value;
	}

	public function isValid() {
		$validName = strlen($this->name) >= 5 && strlen($this->name) < 50;
		$validDiscount = $this->discount > 0 && $this->discount < 1;
		$validStartDate = strtotime($this->startDate) <= strtotime($this->endDate);
		$validEndDate = strtotime($this->endDate) >= getdate()[0];
	
		return $validName && $validDiscount && $validStartDate && $validEndDate;
	}
}

?>