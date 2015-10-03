<?php

namespace Data\Repositories;
use Models\Category;

class CategoryRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function getCategories() {
		$result = $this->db->query("
			SELECT id, name
			FROM category
		");

		$categories = array();
		foreach ($result as $row) {
			array_push($categories, new Category($row['name'], $row['id']));
		}

		return $categories;
	}

	public function addCategory(Category $category) {
		$result = $this->db->prepare("
			INSERT INTO category(name)
			VALUES(?)
		");

		$result->execute([ $category->getName() ]);
	}

	public function deleteCategory($id) {
		$result = $this->db->prepare("
			DELETE c FROM category c
			WHERE id = ?
		");

		$result->execute([ $id ]);
	}

	public function getCategoryByName($name) {
		$result = $this->db->prepare("
			SELECT id, name
			FROM category
			WHERE name = ?
		");
		$result->execute([ $name ]);
		$data = $result->fetch();

		if (!$data) {
			return null;
		}
		return new Category($data['name'], $data['id']);
	}
}

?>