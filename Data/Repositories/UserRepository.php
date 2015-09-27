<?php

namespace Data\Repositories;
use Models\User;

class UserRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function getUser($userId) {

	}

	public function addUser(User $user) {

	}
}

?>