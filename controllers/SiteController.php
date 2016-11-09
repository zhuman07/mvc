<?php

	require_once ROOT.'/models/Category.php';
	require_once ROOT.'/models/Product.php';

	class SiteController
	{

		public function actionIndex() {

			$categories = array();
			$categories = Category::getCategoryList();

			$products = array();
			$products = Product::getProducts(6);

			$sliderProducts = Product::getRecommendedProducts();

			require_once(ROOT.'/views/site/index.php');
			return true;
		}

		public function actionContact() {

			$userName = '';
			$userEmail = '';
			$subject = '';
			$userMessage = '';
			$result = false;

			if(isset($_POST['submit'])) {

				$userName = $_POST['name'];
				$userEmail = $_POST['email'];
				$subject = $_POST['subject'];
				$userMessage = $_POST['message'];

				$errors = false;

				if(!User::checkName($userName)) {
					$errors[] = "Имя не должно быть короче 2-х символов";
				}

				if(!User::checkEmail($userEmail)) {
					$errors[] = "Не корректно введен Email";
				}

				if(!User::checkMessage($userMessage)) {
					$errors[] = "Поле яляется обязательным";
				}

				if($errors == false) {

					$adminEmail = 'bzhuman@inbox.ru';
					$message = "Текст: {$userMessage}. От: {$userName}. Email: {$userEmail}.";
					$subject = $subject;
					$result = mail($adminEmail, $subject, $message);
					$result = true;
				}

			}	

			require_once(ROOT.'/views/site/contact.php');
			return true;

		}

	}

?>