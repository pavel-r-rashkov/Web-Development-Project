<?php

namespace Models;

class User {
	private $id;
	private $username;
	private $passwordDigest;

	public function __construct($username, $passwordDigest, $id = null) {
		$this->setId($id);
		$this->setUsername($username);
		$this->setPasswordDigest($passwordDigest);
	}

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($value) {
		if ($value == null || strlen($value) < 5) {
			throw new \Exception('Username must be at least 5 letters long');
		}
		$this->username = $value;
	}

	public function getPasswordDigest() {
		return $this->passwordDigest;
	}

	public function setPasswordDigest($value) {
		if ($value == null || strlen($value) == 0) {
			throw new \Exception('Invalid password digest');
		}
		$this->passwordDigest = $value;
	}
}

?>