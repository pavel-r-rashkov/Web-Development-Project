<?php

namespace ViewModels;

class ProductsViewModel {
	private $products;
	private $count;
	private $pageSize;
	private $page;

	public function __construct($products, $count, $pageSize, $page) {
		$this->setProducts($products);
		$this->setCount($count);
		$this->setPageSize($pageSize);
		$this->setPage($page);
	}

	public function getProducts() {
		return $this->products;
	}

	public function setProducts($value) {
		$this->products = $value;
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