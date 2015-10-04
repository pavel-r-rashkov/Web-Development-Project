<?php

namespace Controllers;
use Controllers\BaseController;
use Data\Contracts\IShopData;
use Core\Contracts\IRoleProvider;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\Product;
use ViewModels\ShowProductViewModel;

/**
*@AuthenticateUser()
*/
class ProductsController extends BaseController {
	private $roleProvider;

	public function __construct(IShopData $shopData, IRoleProvider $roleProvider) {
		parent::__construct($shopData);
		$this->roleProvider = $roleProvider;
	}

	public function show($id) {
		$product = $this->shopData->getProductRepository()->find($id);
		$comments = $this->shopData->getCommentRepository()->getProductComments($id);
		$canDelete = $this->roleProvider->isAdmin($this->currentUser());
		$productViewModel = new ShowProductViewModel($product, $comments, $canDelete);
		
		return new ViewResult($productViewModel, 'Products/Show.php');
	}
}

?>