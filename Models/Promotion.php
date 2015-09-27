<?php

namespace Models;

class Promotion {
	private $id;
	private $name;
	private $startDate;
	private $endDate;
	private $discount;
	private $userCriteriaId;
	private $userId;

	public function __construct($name, $startDate, $endDate, $discount, $userCriteriaId, $userId, $id = null) {
		$this->setId($id);
		$this->setName($name);
		$this->setStartDate($startDate);
		$this->setEndDate($endDate);
		$this->setDiscount($discount);
		$this->setUserCriteriaId($userCriteriaId);
		$this->setUserId($userId);
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
			throw new \Exception('Promotion name must be at least 5 letters long');
		}
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
		if ($value <= 0 || $value > 1) {
			throw new \Exception('Discount cannot be negative or more than 100%');
		}
		$this->discount = $value;
	}

	public function getUserCriteriaId() {
		return $this->userCriteriaId;
	}

	public function setUserCriteriaId($value) {
		$this->userCriteriaId = $value;
	}

	public function getUserId() {
		return $this->userId;
	}

	public function setUserId($value) {
		$this->userId = $value;
	}
}

?>