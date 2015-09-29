<?php

namespace Areas\Editors\Controllers;
use Controllers\BaseController;
use Data\Contracts\IShopData;
use BindingModels\Products\CreateProductBindingModel;
use BindingModels\Products\UpdateProductBindingModel;
use Core\ResultExecution\ActionResults\ViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\Product;

class ProductsController extends EditorsController {
	const PAGE_SIZE = 10;

	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	public function index($page, $size = self::PAGE_SIZE) {
		$products = $this->shopDate()->getProductRepository()->getProducts($page, $size);
		return new ViewResult($products, 'Products/Index.php');
	}

	public function newProduct() {
		return new ViewResult(new CreateProductBindingModel(), 'Products/NewProduct.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function create(CreateProductBindingModel $newProduct) {
		if ($newProduct == null || !$newProduct->isValid()) {
			return new ViewResult($newProduct, 'Products/NewProduct.php');
		}

		$product = new Product($newProduct->getName(), $newProduct->getQuantity(), $newProduct->getDescription());
		$this->shopData->getProductRepository()->addProduct($product);

		return new RedirectActionResult('editors/products/index?page=1');
	}

	public function edit($id) {
		$product = $this->shopData->getProductRepository()->find($id);
		if ($product == null) {
			throw new \Exception('Product not found');
		}

		return new ViewResult($product, 'Products/Edit.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function update(UpdateProductBindingModel $updatedProduct) {
		$product = $this->shopData->getProductRepository()->find($id);
		if ($product == null) {
			throw new \Exception('Product not found');
		}

		$product->setQuantity($updatedProduct->getQuantity());
		$product->setDescription($updatedProduct->getDescription());
		$this->shopData->getProductRepository()->updatedProduct($product);

		return new RedirectActionResult('editors/products/index?page=1');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function delete($id) {
		$this->shopData->getProductRepository()->deleteProduct($id);
		return new RedirectActionResult('editors/products/index?page=1');
	}
}

?>