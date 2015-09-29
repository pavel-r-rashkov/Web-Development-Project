<?php

namespace Areas\Editors\Controllers;
use Controllers\BaseController;
use Data\Contracts\IShopData;
use BindingModels\Products\CreateCategoryBindingModel;
use Core\ResultExecution\ActionResults\PartialViewResult;
use Core\ResultExecution\ActionResults\RedirectActionResult;
use Models\Category;

class CategoriesController extends EditorsController {
	public function __construct(IShopData $shopData) {
		parent::($shopData);
	}

	public function all() {
		$categories = $this->shopData->getCategoryRepository()->getCategories();
		return new PartialViewResult($categories, 'Categories/All.php');
	}

	public function newCategory() {
		return new ViewResult(new CreateCategoryBindingModel(), 'Categories/NewCategory.php');
	}

	public function create(CreateCategoryBindingModel $newCategory) {
		if ($newCategory == null || !$newCategory->isValid()) {
			return new ViewResult($newCategory, 'Categories/NewCategory.php');
		}

		$category = new Category($newCategory->getName());
		$this->shopData->getCategoryRepository()->addCategory($category);

		return new RedirectActionResult('home/index');
	}

	public function delete($id) {
		$this->shopData->getCategoryRepository()->deleteCategory($id);
		return new RedirectActionResult('home/index');
	}
}

?>