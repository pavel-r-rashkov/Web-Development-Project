<?php

namespace BindingModels;

class CreateCriteriaBindingModel {
	private $minimumDaysRegistered;
	private $minimumCash;

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
		$validDays = $this->minimumDaysRegistered >= 0;
		$validCash = $this->minimumCash >= 0;
	}
}

?>