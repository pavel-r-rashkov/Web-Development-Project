<?php

namespace Data\Repositories;
use Models\Product;

class ProductRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function find($id) {
		$result = $this->db->prepare("
			SELECT p.id, p.name, p.quantity, p.description, p.category_id, c.name AS category_name
			FROM product p
			JOIN category c
				ON c.id = p.category_id
			WHERE p.id = ?
		");
		$result->execute([ $id ]);
		$data = $result->fetch();

		if (!$data) {
			return null;
		}
		return new Product($data['name'], $data['quantity'], $data['description'], 
			$data['category_id'], $data['id'], $data['category_name']);
	}

	public function getProductsCount() {
		$result = $this->db->query("
			SELECT COUNT(*) AS count
			FROM product
		");
		$data = $result->fetch();
		return $data['count'];
	}

	public function getAllProducts() {
		$result = $this->db->prepare("
			SELECT id, name, quantity, description, category_id
			FROM product
		");

		$result->execute();
		$data = $result->fetchAll();
		$products = array();
		foreach ($data as $row) {
			array_push($products, new Product(
				$row['name'], 
				$row['quantity'], 
				$row['description'], 
				$row['category_id'], 
				$row['id']));
		}

		return $products;
	}

	public function getProducts($page, $size) {
		$result = $this->db->prepare("
			SELECT p.id, p.name, p.quantity, p.description, p.category_id, c.name AS category_name
			FROM product p
			JOIN category c
				ON c.id = p.category_id
			LIMIT :skip, :take
		");
		$result->bindValue(':skip', intval($page * $size), \PDO::PARAM_INT); 
		$result->bindValue(':take', intval($size), \PDO::PARAM_INT);
		$result->execute();
		$data = $result->fetchAll();

		$products = array();
		foreach ($data as $row) {
			array_push($products, new Product(
				$row['name'], 
				$row['quantity'], 
				$row['description'], 
				$row['category_id'], 
				$row['id'],
				$row['category_name']));
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

	public function getUserProducts($id) {
		$result = $this->db->prepare("
			SELECT p.id, p.name, p.quantity, p.description, p.category_id
			FROM product p
			JOIN possession pos
				ON pos.product_id = p.id
			WHERE pos.owner_id = ?
		");

		$result->execute([ $id ]);
		$data = $result->fetchAll();
		$products = array();
		foreach ($data as $row) {
			array_push($products, new Product(
				$row['name'], 
				$row['quantity'], 
				$row['description'], 
				$row['category_id'], 
				$row['id']));
		}

		return $products;
	}
}

?>