<?php

namespace Data\Repositories;
use Models\Product;

class ProductRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function getProducts($page, $size) {

	}

	public function addProduct(Product $product) {

	}

	public function updateProduct(Product $product) {

	}

	public function deleteProduct($productId) {

	}
}

?>