<?php

namespace Data\Repositories;
use Models\Product;

class ProductRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function find($id) {

	}

	public function getProducts($page, $size) {
		$result = $this->db->prepare("
			SELECT id, name, quantity, description, category_id
			FROM product
			LIMIT ?, ? 
		");

		$result->execute([ $page * $size, $size ]);

		$products = array();
		foreach ($result as $row) {
			array_push($products, new Product(
				$row['name'], 
				$row['quantity'], 
				$row['description'], 
				$row['category_id'], 
				$row['id']));
		}

		return $products;
	}

	public function addProduct(Product $product) {
		$result = $this->db->prepare("
			INSERT INTO product(name, quantity, description, category_id)
			VALUES(?, ?, ?, ?)
		");

		$result->execute([ 
			$product->getName(), 
			$product->getQuantity(), 
			$product->getDescription(),
			$product->getCategoryId() 
		]);
	}

	public function updateProduct(Product $product) {
		$result = $this->db->prepare("
			UPDATE product
			SET name = ?,
				quantity = ?,
				description = ?,
				category_id = ?
			WHERE id = ?
		");

		$result->execute([ 
			$product->getName(),
			$product->getQuantity(), 
			$product->getDescription(), 
			$product->getCategoryId(),
			$product->getId()
		]);
	}

	public function deleteProduct($productId) {
		$result = $this->db->prepare("
			DELETE p FROM product p
			WHERE id = ?
		");

		$result->execute([ $productId ]);
	}
}

?>