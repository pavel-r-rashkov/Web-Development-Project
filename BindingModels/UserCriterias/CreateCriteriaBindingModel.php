<?php

namespace BindingModels;

class CreateCriteriaBindingModel {
	private $name;
	private $minimumDaysRegistered;
	private $minimumCash;

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
		$this->minimumDaysRegistered = $value;
	}

	public function getMinimumCash() {
		return $this->minimumDaysRegistered;
	}

	public function setMinimumCash($value) {
		$this->minimumCash = $value;
	}

	public function isValid() {
		$validName = strlen($this->name) >= 3 && strlen($this->name) <= 50; 
		$validDays = $this->minimumDaysRegistered >= 0;
		$validCash = $this->minimumCash >= 0;
		return $validName && $validDays && $validCash;
	}
}

?>