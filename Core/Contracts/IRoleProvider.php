<?php

namespace Core\Contracts;

interface IRoleProvider {
	public function getUserRoles($id);
}

?>