<?php

namespace Data\Repositories;

abstract class BaseRepository {
	protected $db;

	protected function __construct($db) {
		$this->db = $db;
	}
}

?>