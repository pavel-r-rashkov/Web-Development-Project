<?php

namespace Models;

class Role {
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
		if ($value == null || strlen($value) < 3) {
			throw new \Exception('Role name must be at least 3 letters long');
		}
		$this->name = $value;
	}
}

?>