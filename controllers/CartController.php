<?php

	class CartController
	{

		public function actionAdd($id) {

			Cart::addProduct($id);

			$referrer = $_SERVER['HTTP_REFERER'];

			header("Location: $referrer");

		}

		public function actionDel($id) {

			Cart::delProduct($id);

			$referrer = $_SERVER['HTTP_REFERER'];

			header("Location: $referrer");

		}

		public function actionDelete($id) {

			Cart::delProductById($id);

			$referrer = $_SERVER['HTTP_REFERER'];

			header("Location: $referrer");

		}

		public function actionAddAjax($id) {

			echo "(".Cart::addProduct($id).")";
			return true;
		}

		public function actionIndex() {

			$categories = array();
			$categories = Category::getCategoryList();

			$productsInCart = false;

			$productsInCart = Cart::getProducts();
			if($productsInCart) {

				$productsId = array_keys($productsInCart);

				$products = Product::getProductsByIds($productsId, $productsInCart);

				$totalPrice = Cart::getTotalPrice($products);

			}

			require_once ROOT."/views/cart/index.php";
			return true;

		}

		public function actionCheckout()
    {

        // Список категорий для левого меню
        $categories = array();
        $categories = Category::getCategoryList();


        // Статус успешного оформления заказа
        $result = false;


        // Форма отправлена?
        if (isset($_POST['submit'])) {
            // Форма отправлена? - Да
            // Считываем данные формы
            $userName = $_POST['name'];
            $userPhone = $_POST['phone'];
            $userComment = $_POST['message'];

            // Валидация полей
            $errors = false;
            if (!User::checkName($userName))
                $errors[] = 'Неправильное имя';
            if (!User::checkPhone($userPhone))
                $errors[] = 'Неправильный телефон';

            // Форма заполнена корректно?
            if ($errors == false) {
                // Форма заполнена корректно? - Да
                // Сохраняем заказ в базе данных
                // Собираем информацию о заказе
                $productsInCart = Cart::getProducts();
                if (User::isGuest()) {
                    $userId = false;
                } else {
                    $userId = User::checkLoged();
                }

                // Сохраняем заказ в БД
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);

                if ($result) {
                    // Оповещаем администратора о новом заказе                
                    $adminEmail = 'bzhuman@inbox.ru';
                    $message = 'http://localhost/admin/orders';
                    $subject = 'Новый заказ!';
                    mail($adminEmail, $subject, $message);

                    // Очищаем корзину
                    Cart::clear();
                }
            } else {
                // Форма заполнена корректно? - Нет
                // Итоги: общая стоимость, количество товаров
                $productsInCart = Cart::getProducts();
                $productsId = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsId);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItem();
            }
        } else {
            // Форма отправлена? - Нет
            // Получием данные из корзины      
            $productsInCart = Cart::getProducts();

            // В корзине есть товары?
            if ($productsInCart == false) {
                // В корзине есть товары? - Нет
                // Отправляем пользователя на главную искать товары
                header("Location: /");
            } else {
                // В корзине есть товары? - Да
                // Итоги: общая стоимость, количество товаров
                $productsId = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsId, $productsInCart);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItem();


                $userName = false;
                $userPhone = false;
                $userComment = false;

                // Пользователь авторизирован?
                if (User::isGuest()) {
                    // Нет
                    // Значения для формы пустые
                } else {
                    // Да, авторизирован                    
                    // Получаем информацию о пользователе из БД по id
                    $userId = User::checkLoged();
                    $user = User::getUserById($userId);
                    // Подставляем в форму
                    $userName = $user['name'];
                }
            }
        }

        require_once(ROOT . '/views/cart/checkout.php');

        return true;
    }

	}

?>