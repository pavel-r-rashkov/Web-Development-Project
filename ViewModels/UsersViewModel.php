<?php

namespace ViewModels;

class UsersViewModel {
	private $users;
	private $count;
	private $pageSize;
	private $page;

	public function __construct($users, $count, $pageSize, $page) {
		$this->setUsers($users);
		$this->setCount($count);
		$this->setPageSize($pageSize);
		$this->setPage($page);
	}

	public function getUsers() {
		return $this->users;
	}

	public function setUsers($value) {
		$this->users = $value;
	}

	public function getCount() {
		return $this->count;
	}

	public function setCount($value) {
		$this->count = $value;
	}

	public function getPageSize() {
		return $this->pageSize;
	}

	public function setPageSize($value) {
		$this->pageSize = $value;
	}

	public function getPage() {
		return $this->page;
	}

	public function setPage($value) {
		$this->page = $value;
	}
}

?>