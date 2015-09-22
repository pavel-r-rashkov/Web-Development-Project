<?php

use Core\Contracts\IRoleProvider;

class RoleProvider implements IRoleProvider {
	public function __construct() {
	}

	public function getUserRoles($id) {
		return array('FirstRole', 'SecondRole');
	}
}

?>