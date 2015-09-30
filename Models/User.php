<?php

namespace Models;

class User {
	private $id;
	private $username;
	private $passwordDigest;
	private $money;

	public function __construct($username, $passwordDigest, $money, $id = null) {
		$this->setId($id);
		$this->setUsername($username);
		$this->setPasswordDigest($passwordDigest);
		$this->setMoney($money);
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

	public function getMoney() {
		return $this->money;
	}

	public function setMoney($value) {
		$this->money = $value;
	}
}

?>