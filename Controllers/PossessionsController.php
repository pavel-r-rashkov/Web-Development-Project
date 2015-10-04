<?php

namespace Controllers;
use Controllers\BaseController;
use Data\Contracts\IShopData;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Core\Contracts\IRoleProvider;

/**
*@AuthenticateUser()
*/
class PossessionsController extends BaseController {
	private $roleProvider;

	public function __construct(IShopData $shopData, IRoleProvider $roleProvider) {
		parent::__construct($shopData);
		$this->roleProvider = $roleProvider;
	}

	public function index($id) {
		if ($this->currentUser() != $id && !$this->roleProvider->isAdmin($this->currentUser())) {
			http_response_code(403);
			die;
		}

		$possessions = $this->shopData->getPossessionRepository()->getPossessions($id);
		return new ViewResult($possessions, 'Possessions/Index.php');
	}
}

?>