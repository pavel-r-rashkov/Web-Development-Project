<?php

namespace Data;
use Data\Contracts\IShopData;
use Date\Repositories\CategoryRepository;

class ShopData implements IShopData {
	private $db;
	private $categoryRepository;

	public function __construct() {
		$this->db = Database::getInstance(DatabaseConfig::DB_INSTANCE);
	}

	public function getCategoryRepository() {
		if ($this->categoryRepository == null) {
			$this->categoryRepository = new CategoryRepository($this->db);
		}
		return $this->categoryRepository;
	}
}

?>