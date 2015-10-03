<?php

namespace ViewModels;

class NavigationViewModel {
	private $isAdmin;
	private $isEditor;
	private $username;

	public function __construct($isAdmin, $isEditor, $username) {
		$this->isAdmin = $isAdmin;
		$this->isEditor = $isEditor;
		$this->username = $username;
	}

	public function getIsAdmin() {
		return $this->isAdmin;
	}

	public function getIsEditor() {
		return $this->isEditor;
	}

	public function getUsername() {
		return $this->username;
	}
}

?>