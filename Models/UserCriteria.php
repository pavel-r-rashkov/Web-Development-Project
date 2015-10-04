<?php

namespace Models;

class UserCriteria {
	private $id;
	private $name;
	private $minimumDaysRegistered;
	private $minimumCash;

	public function __construct($name, $minimumDaysRegistered, $minimumCash, $id = null) {
		$this->setId($id);
		$this->setName($name);
		$this->setMinimumDaysRegistered($minimumDaysRegistered);
		$this->setMinimumCash($minimumCash);
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

	public function getMinimumDaysRegistered() {
		return $this->minimumDaysRegistered;
	}

	public function setMinimumDaysRegistered($value) {
		if ($value != null && $value < 0) {
			throw new \Exception('Minimum days registered cannot be negative');
		}
		$this->minimumDaysRegistered = $value;
	}

	public function getMinimumCash() {
		return $this->minimumDaysRegistered;
	}

	public function setMinimumCash($value) {
		if ($value != null && $value < 0) {
			throw new \Exception('Minimum cash cannot be negative');
		}
		$this->minimumCash = $value;
	}
}

?>