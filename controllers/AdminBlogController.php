<?php

	class AdminBlogController extends AdminBase
		{

		public function actionIndex() {

		self::checkAdmin();

		$categoriesList = Blog::getBlogCategoriesListAdmin();

		require_once ROOT."/views/admin_blog/index.php";
		return true;

		}

		public function actionCreate()
		{
		// Проверка доступа
		self::checkAdmin();
		// Обработка формы
		if (isset($_POST['submit'])) {
			// Если форма отправлена
			// Получаем данные из формы
			$name = $_POST['name'];
			$sortOrder = $_POST['sort_order'];
			$status = $_POST['status'];
			// Флаг ошибок в форме
			$errors = false;
			// При необходимости можно валидировать значения нужным образом
			if (!isset($name) || empty($name)) {
			  $errors[] = 'Заполните поля';
			}
			if ($errors == false) {
			  // Если ошибок нет
			  // Добавляем новую категорию
			  Blog::createBlogCategory($name, $sortOrder, $status);
			  // Перенаправляем пользователя на страницу управлениями категориями
			  header("Location: /admin/blog");
			}
		}
		require_once(ROOT . '/views/admin_blog/create.php');
		return true;
		}
		/**
		* Action для страницы "Редактировать категорию"
		*/
		public function actionUpdate($id)
		{
		// Проверка доступа
		self::checkAdmin();
		// Получаем данные о конкретной категории
		$category = Blog::getBlogCategoryById($id);
		// Обработка формы
		if (isset($_POST['submit'])) {
		// Если форма отправлена   
		// Получаем данные из формы
		$name = $_POST['name'];
		$sortOrder = $_POST['sort_order'];
		$status = $_POST['status'];
		// Сохраняем изменения
		Blog::updateBlogCategoryById($id, $name, $sortOrder, $status);
		// Перенаправляем пользователя на страницу управлениями категориями
		header("Location: /admin/blog");
		}
		// Подключаем вид
		require_once(ROOT . '/views/admin_blog/update.php');
		return true;
		}
		/**
		* Action для страницы "Удалить категорию"
		*/
		public function actionDelete($id)
		{
		// Проверка доступа
		self::checkAdmin();
		// Обработка формы
		if (isset($_POST['submit'])) {
		// Если форма отправлена
		// Удаляем категорию
		Blog::deleteBlogCategoryById($id);
		// Перенаправляем пользователя на страницу управлениями товарами
		header("Location: /admin/blog");
		}
		// Подключаем вид
		require_once(ROOT . '/views/admin_blog/delete.php');
		return true;
		}

	}

?>