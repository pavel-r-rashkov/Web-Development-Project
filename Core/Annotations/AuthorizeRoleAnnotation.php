<?php

namespace Core\Annotations;
use Core\ApplicationManager;

class AuthorizeRoleAnnotation extends AuthorizeAnnotation {
	private $allowedRoles;

	public function __construct() {
		$roles = func_get_args();
		$this->allowedRoles = $roles;
	}

	public function authorize() {
		$container = ApplicationManager::getInstance()->getContainer();
		$roleProvider = $container->resolve('RoleProvider');
		if (!isset($_SESSION['userId'])) {
			http_response_code(403);
			die;
		}
		$userId = $_SESSION['userId'];
		$userRoles = $roleProvider->getUserRoles($userId);

		if (count(array_intersect($userRoles, $this->allowedRoles)) == 0) {
			http_response_code(403);
			die;
		}
	}
}

?>