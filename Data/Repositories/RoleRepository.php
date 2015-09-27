<?php

namespace Data\Repositories;
use Models\Role;

class RoleRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function getUserRoles($userId) {
		
	}
}

?>