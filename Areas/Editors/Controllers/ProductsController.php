<?php

namespace Areas\Editors\Controllers;
use Controllers\BaseController;
use Data\Contracts\IShopData;
use BindingModels\Products\CreateProductBindingModel;
use BindingModels\Products\UpdateProductBindingModel;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\Product;
use ViewModels\CreateProductViewModel;
use ViewModels\ProductsViewModel;
use ViewModels\EditProductViewModel;

/**
*@AuthorizeRole(Admin,Editor)
*/
class ProductsController extends EditorsController {
	const PAGE_SIZE = 10;

	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	public function index($page) {
		if($page == null) {
			$page = 0;
		}
		return new ViewResult($page, 'Products/Index.php');
	}

	public function paged($page) {
		$size = self::PAGE_SIZE;
		$products = $this->shopData->getProductRepository()->getProducts($page, $size);
		$count = $this->shopData->getProductRepository()->getProductsCount();
		$viewModel = new ProductsViewModel($products, $count, $size, $page);
		return new PartialViewResult($viewModel, 'Products/Paged.php');
	}

	public function newProduct() {
		$categories = $this->shopData->getCategoryRepository()->getCategories();
		$viewModel = new CreateProductViewModel($categories);
		return new ViewResult($viewModel, 'Products/NewProduct.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function create(CreateProductBindingModel $newProduct) {
		if ($newProduct == null || !$newProduct->isValid()) {
			$_SESSION['warrning'] = 'Invalid product data';
			return new RedirectActionResult('editors/products/newproduct');
		}

		$product = new Product(
			$newProduct->getName(), 
			$newProduct->getQuantity(), 
			$newProduct->getDescription(),
			$newProduct->getCategoryId());
		$this->shopData->getProductRepository()->addProduct($product);

		$_SESSION['success'] = 'Product added';
		return new RedirectActionResult('editors/products/index');
	}

	public function edit($id) {
		$product = $this->shopData->getProductRepository()->find($id);
		if ($product == null) {
			throw new \Exception('Product not found');
		}
		$categories = $this->shopData->getCategoryRepository()->getCategories();

		$productViewModel = new EditProductViewModel(
			$id,
			$product->getName(),
			$product->getQuantity(),
			$product->getDescription(),
			$product->getCategoryId(),
			$categories
		);
		return new ViewResult($productViewModel, 'Products/Edit.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function update(UpdateProductBindingModel $updatedProduct) {
		$id = $updatedProduct->getId();
		$product = $this->shopData->getProductRepository()->find($id);
		if ($product == null || !$updatedProduct->isValid()) {
			$_SESSION['warrning'] = 'Invalid product data';
			return new RedirectActionResult('editors/products/edit/' . $id);
		}

		$product->setQuantity($updatedProduct->getQuantity());
		$product->setDescription($updatedProduct->getDescription());
		$product->setCategoryId($updatedProduct->getCategoryId());
		$this->shopData->getProductRepository()->updateProduct($product);

		$_SESSION['info'] = 'Product edited';
		return new RedirectActionResult('editors/products/index');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function delete($id) {
		$this->shopData->getProductRepository()->deleteProduct($id);
		$_SESSION['info'] = 'Product deleted';
		return new RedirectActionResult('editors/products/index');
	}
}

?>