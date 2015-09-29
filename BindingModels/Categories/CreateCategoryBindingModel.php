<?php

namespace BindingModels\Categories;

class CreateCategoryBindingModel {
	private $name;

	public function getName() {
		return $this->name;
	}

	public function setName($value) {
		if ($value == null || strlen($value) == 0) {
			throw new \Exception('Name cannot be empty');
		}
		$this->name = $value;
	}

	public function isValid() {
		return $this->name != null && strlen($this->name) > 0;
	}
}

?>