<?php

namespace BindingModels\Categories;

class CreateCategoryBindingModel {
	private $name;

	public function getName() {
		return $this->name;
	}

	public function setName($value) {
		$this->name = $value;
	}

	public function isValid() {
		return $this->name != null && strlen($this->name) > 3;
	}
}

?>