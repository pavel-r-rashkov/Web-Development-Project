<?php

namespace Models;

class Category {
	private $id;
	private $name;

	public function __construct($name, $id = null) {
		$this->setId($id);
		$this->setName($name);
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
		if ($value == null || strlen($value) == 0) {
			throw new \Exception('Name cannot be empty');
		}
		$this->name = $value;
	}
}

?>