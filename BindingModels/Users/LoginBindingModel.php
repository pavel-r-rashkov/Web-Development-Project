<?php

namespace BindingModels\Users;

class LoginBindingModel {
	private $username;
	private $password;

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($value) {
		$this->username = $value;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($value) {
		$this->password = $value;
	}
}

?>