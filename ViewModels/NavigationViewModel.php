<?php

namespace ViewModels;

class NavigationViewModel {
	private $id;
	private $isAdmin;
	private $isEditor;
	private $username;

	public function __construct($id, $isAdmin, $isEditor, $username) {
		$this->id = $id;
		$this->isAdmin = $isAdmin;
		$this->isEditor = $isEditor;
		$this->username = $username;
	}

	public function getId() {
		return $this->id;
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