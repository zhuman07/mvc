<?php

	class BlogController
	{

		public function actionIndex(){

			$categories = array();
			$categories = Blog::getBlogCategoryList();

			$blogList = array();
			$blogList = Blog::getBlogs();

			require_once ROOT."/views/blog/index.php";
			return true;

		}

		public function actionCategory($id) {
			$categories = array();
			$categories = Blog::getBlogCategoryList();

			$catName = Blog::getBlogCategoryName($id);

			$blogListByCat = array();
			$blogListByCat = Blog::getBlogListByCategory($id);

			require_once(ROOT.'/views/blog/category.php');
			return true;
		}

		public function actionView($id) {
			$categories = array();
			$categories = Blog::getBlogCategoryList();

			$blogById = Blog::getBlogById($id);

			require_once ROOT."/views/blog/view.php";
			return true;

		}

	}

?>