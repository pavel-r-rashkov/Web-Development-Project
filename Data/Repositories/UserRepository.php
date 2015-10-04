<?php

namespace Data\Repositories;
use Models\User;

class UserRepository extends BaseRepository {
	public function __construct($db) {
		parent::__construct($db);
	}

	public function findUser($userId) {
		$result = $this->db->prepare("
			SELECT id, username, password_digest, money
			FROM user
			WHERE id = ?
		");

		$result->execute([ $userId ]);
		$data = $result->fetch();
		$user = new User( 
			$data['username'], 
			$data['password_digest'], 
			$data['money'], 
			$data['id']);

		return $user;
	}

	public function updateUser(User $user) {
		$result = $this->db->prepare("
			UPDATE user
			SET money = ?,
				banned = ?
			WHERE id = ?
		");

		$result->execute([ 
			$user->getMoney(),
			$user->getBanned(),
			$user->getId()
		]);
	}

	public function getUser($username) {
		$result = $this->db->prepare("
			SELECT id, username, password_digest, money, register_date, banned
			FROM user
			WHERE username = ?
		");
		$result->execute([ $username ]);
		$data = $result->fetch();

		if (!$data) {
			return null;
		}
		return new User(
			$data['username'], 
			$data['password_digest'], 
			$data['money'], 
			$data['id'],
			$data['register_date'],
			$data['banned']);
	}

	public function addUser(User $user) {
		$result = $this->db->prepare("
			INSERT INTO user(username, password_digest, money, banned)
			VALUES(?, ?, ?, ?);
		");

		$result->execute([ $user->getUsername(), $user->getPasswordDigest(), $user->getMoney(), $user->getBanned() ]);
	}

	public function getUsers($page, $size) {
		$result = $this->db->prepare("
			SELECT id, username, password_digest, money, banned, register_date
			FROM user
			LIMIT :skip, :take
		");
		$result->bindValue(':skip', intval($page * $size), \PDO::PARAM_INT); 
		$result->bindValue(':take', intval($size), \PDO::PARAM_INT);
		$result->execute();
		$data = $result->fetchAll();

		$users = array();
		foreach ($data as $row) {
			array_push($users, new User(
				$row['username'], 
				$row['password_digest'], 
				$row['money'],
				$row['id'],
				$row['register_date'],
				$row['banned']));
		}

		return $users;
	}

	public function getUsersCount() {
		$result = $this->db->query("
			SELECT COUNT(*) AS count
			FROM user
		");
		$data = $result->fetch();
		return $data['count'];
	}
}

?>