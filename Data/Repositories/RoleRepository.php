<?php

namespace Data\Repositories;
use Models\Role;

class RoleRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function getUserRoles($userId) {
		$result = $this->db->prepare("
			SELECT r.id, r.name
			FROM role r
			JOIN user_role ur
				ON ur.role_id = r.id
			JOIN user u
				ON ur.user_id = u.id
			WHERE u.id = ?
		");

		$result->execute([ $userId ]);
		
		$roles = array();
		foreach ($result as $row) {
			array_push($roles, new Role(
				$row['name'], 
				$row['id']));
		}

		return $roles;
	}
}

?>