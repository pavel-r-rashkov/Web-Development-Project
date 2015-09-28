<?php

namespace Data;
use Data\Contracts\IShopData;
use Data\Repositories\CategoryRepository;
use Data\Repositories\UserRepository;
use Data\Config\Database;
use Data\Config\DatabaseConfig;

class ShopData implements IShopData {
	private $db;
	private $categoryRepository;
	private $userRepository;

	public function __construct() {
		$this->db = Database::getInstance(DatabaseConfig::DB_INSTANCE);
	}

	public function getCategoryRepository() {
		if ($this->categoryRepository == null) {
			$this->categoryRepository = new CategoryRepository($this->db);
		}
		return $this->categoryRepository;
	}

	public function getUserRepository() {
		if ($this->userRepository == null) {
			$this->userRepository = new UserRepository($this->db);
		}
		return $this->userRepository;
	}
}

?>