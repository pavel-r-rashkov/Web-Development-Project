<?php

use Core\Contracts\IRoleProvider;
use Data\Contracts\IShopData;

class RoleProvider implements IRoleProvider {
	private $shopData;

	public function __construct(IShopData $shopData) {
		$this->shopData = $shopData;
	}

	public function getUserRoles($id) {
		$roles = $this->shopData->getRoleRepository()->getUserRoles($id);

		$roleNames = array();
		foreach ($roles as $role) {
			array_push($roleNames, $role->getName());
		}
		return $roleNames;
	}

	public function isAdmin($id) {
		return in_array('Admin', $this->getUserRoles($id));
	}

	public function isEditor($id) {
		return in_array('Editor', $this->getUserRoles($id));
	}
}

?>