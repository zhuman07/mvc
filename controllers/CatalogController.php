<?php


	class CatalogController
	{

		public function actionIndex() {

			$categories = array();
			$categories = Category::getCategoryList();

			$products = array();
			$products = Product::getProducts(9);

			require_once(ROOT.'/views/catalog/index.php');
			return true;
		}

		public function actionCategory($categoryId, $page = 1) {

			$categories = array();
			$categories = Category::getCategoryList();

			$categoryProducts = array();
			$categoryProducts = Product::getProductListByCategory($categoryId, $page);

			$total = Product::getTotalProductInCategory($categoryId);
			$pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

			$categoryName = Category::getCategoryName($categoryId);

			require_once(ROOT.'/views/catalog/category.php');
			return true;

		}

	}

?>