<?php

namespace Data\Repositories;

abstract class BaseRepository {
	private $db;

	public function __construct($db) {
		$this->db = $db;
	}
}

?>