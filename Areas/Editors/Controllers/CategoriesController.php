<?php

namespace Areas\Editors\Controllers;
use Core\ResultExecution\ActionResults\ViewResult;
use Data\Contracts\IShopData;
use BindingModels\Categories\CreateCategoryBindingModel;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\Category;

class CategoriesController extends EditorsController {
	public function __construct(IShopData $shopData) {
		parent::__construct($shopData);
	}

	public function newCategory() {
		return new ViewResult(new CreateCategoryBindingModel(), 'Categories/NewCategory.php');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function create(CreateCategoryBindingModel $newCategory) {
		if ($newCategory == null || !$newCategory->isValid()) {
			$_SESSION['warrning'] = 'Invalid category data.';
			return new ViewResult($newCategory, 'Categories/NewCategory.php');
		}

		$existing = $this->shopData->getCategoryRepository()->getCategoryByName($newCategory->getName());
		if ($existing != null) {
			$_SESSION['warrning'] = 'Category with that name already exists.';
			return new ViewResult($newCategory, 'Categories/NewCategory.php');
		}
		$category = new Category($newCategory->getName());
		$this->shopData->getCategoryRepository()->addCategory($category);

		return new RedirectActionResult('home/index');
	}

	/**
	*@HttpPost()
	*@ValidateAntiForgeryToken()
	*/
	public function delete($id) {
		$this->shopData->getCategoryRepository()->deleteCategory($id);
		return new RedirectActionResult('home/index');
	}
}

?>