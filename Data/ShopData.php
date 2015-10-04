<?php

namespace Data;
use Data\Contracts\IShopData;
use Data\Repositories\CategoryRepository;
use Data\Repositories\UserRepository;
use Data\Repositories\RoleRepository;
use Data\Repositories\ProductRepository;
use Data\Repositories\CommentRepository;
use Data\Repositories\PossessionRepository;
use Data\Repositories\PromotionRepository;
use Data\Repositories\SellRepository;
use Data\Repositories\UserCriteriaRepository;
use Data\Config\Database;
use Data\Config\DatabaseConfig;

class ShopData implements IShopData {
	private $db;
	private $categoryRepository;
	private $userRepository;
	private $roleRepository;
	private $productRepository;
	private $commentRepository;
	private $possessionRepository;
	private $promotionRepository;
	private $sellRepository;
	private $userCriteriaRepository;

	public function __construct() {
		$this->db = Database::getInstance(DatabaseConfig::DB_INSTANCE);
	}

	public function beginTran() {
		return $this->db->beginTran();
	}

	public function commitTran() {
		return $this->db->commitTran();
	}

	public function rollBack() {
		return $this->db->rollBack();
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

	public function getRoleRepository() {
		if ($this->roleRepository == null) {
			$this->roleRepository = new RoleRepository($this->db);
		}
		return $this->roleRepository;
	}

	public function getProductRepository() {
		if ($this->productRepository == null) {
			$this->productRepository = new ProductRepository($this->db);
		}
		return $this->productRepository;
	}

	public function getCommentRepository() {
		if ($this->commentRepository == null) {
			$this->commentRepository = new CommentRepository($this->db);
		}
		return $this->commentRepository;
	}

	public function getPossessionRepository() {
		if ($this->possessionRepository == null) {
			$this->possessionRepository = new PossessionRepository($this->db);
		}
		return $this->possessionRepository;
	}

	public function getPromotionRepository() {
		if ($this->promotionRepository == null) {
			$this->promotionRepository = new PromotionRepository($this->db);
		}
		return $this->promotionRepository;
	}

	public function getSellRepository() {
		if ($this->sellRepository == null) {
			$this->sellRepository = new SellRepository($this->db);
		}
		return $this->sellRepository;
	}

	public function getUserCriteriaRepository() {
		if ($this->userCriteriaRepository == null) {
			$this->userCriteriaRepository = new UserCriteriaRepository($this->db);
		}
		return $this->userCriteriaRepository;
	}
}

?>