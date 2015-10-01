<?php

use Core\Contracts\IRoleProvider;
use Core\Data\Contracts\IShopData;

class RoleProvider implements IRoleProvider {
	private $shopData;

	public function __construct(IShopData $shopData) {
		$this->shopData = $shopData;
	}

	public function getUserRoles($id) {
		return array('FirstRole', 'SecondRole', 'Admin', 'Editor');
	}

	public function isAdmin($id) {
		return in_array('Admin', $this->getUserRoles($id));
	}

	public function isEditor($id) {
		return in_array('Editor', $this->getUserRoles($id));
	}
}

?>