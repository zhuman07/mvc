<?php

	class Product
	{

		const SHOW_BY_DEFAULT = 6;

		public static function getProducts($count = self::SHOW_BY_DEFAULT) {

			$count = intval($count);

			$db = Db::getConnect();

			$productList = array();

			$result = $db->query("SELECT id, name, price, image, is_new FROM product "
				. "WHERE status = '1' "
				. "ORDER BY id DESC "
				. "LIMIT ".$count);

			$i = 0;

			while ($row = $result->fetch()) {
				$productList[$i]['id'] = $row['id'];
				$productList[$i]['name'] = $row['name'];
				$productList[$i]['image'] = $row['image'];
				$productList[$i]['price'] = $row['price'];
				$productList[$i]['is_new'] = $row['is_new'];
				$i++;
			}

			return $productList;

		}

		public static function getProductListByCategory($categoryId = false, $page = 1) {

			if($categoryId) {

				$page = intval($page);
				$offset = ($page - 1) * self::SHOW_BY_DEFAULT;

				$db = Db::getConnect();

				$products = array();

				$result = $db->query("SELECT id, name, price, image, is_new, category_id FROM product "
					. "WHERE status = '1' AND category_id = $categoryId "
					. "ORDER BY id DESC "
					. "LIMIT ".self::SHOW_BY_DEFAULT
					. " OFFSET ".$offset);

				$i = 0;

				while ($row = $result->fetch()) {
					$products[$i]['id'] = $row['id'];
					$products[$i]['name'] = $row['name'];
					$products[$i]['image'] = $row['image'];
					$products[$i]['price'] = $row['price'];
					$products[$i]['is_new'] = $row['is_new'];
					$i++;
				}
				return $products;
			}

		}

		public static function getProductById($id) {
			$id = intval($id);
			if($id) {
				$db = Db::getConnect();
				$result = $db->query("SELECT * FROM product where id=".$id);
				$result->setFetchMode(PDO::FETCH_ASSOC);
				return $result->fetch();
			}
		}

		public static function getTotalProductInCategory($categoryId) {

			$db = Db::getConnect();

			$result = $db->query("SELECT count(id) as count FROM product "
				. "WHERE status='1' AND category_id=$categoryId");
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$row = $result->fetch();
			return $row['count'];
		}

		public static function getProductsByIds($idsArray, $prodInCart = false) {
			$products = array();
			$db = Db::getConnect();
			$idsString = implode(',', $idsArray);
			$sql = "SELECT * FROM product WHERE status = '1' AND id IN ($idsString)";
			$result = $db->query($sql);
			$result->setFetchMode(PDO::FETCH_ASSOC);

			$i = 0;

			while ($row = $result->fetch()) {
				$products[$i]['id'] = $row['id'];
				$products[$i]['name'] = $row['name'];
				$products[$i]['code'] = $row['code'];
				$products[$i]['price'] = $row['price'];
				$products[$i]['total'] = $row['price'] * $prodInCart[$row['id']];
				$i++;
			}
			return $products;
		}


		public static function getRecommendedProducts() {

			$db = Db::getConnect();
			$sql = "SELECT id, name, price, is_new FROM product WHERE status = '1' AND is_recomended = '1' ORDER BY id DESC";
			$result = $db->query($sql);
			$i = 0;
			$prouctsList = array();
			while ($row = $result->fetch()) {
				$prouctsList[$i]['id'] = $row['id'];
				$prouctsList[$i]['name'] = $row['name'];
				$prouctsList[$i]['price'] = $row['price'];
				$prouctsList[$i]['is_new'] = $row['is_new'];
				$i++;
			}
			return $prouctsList;
		}

		public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';
        // Путь к папке с товарами
        $path = '/upload/images/products/';
        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }
        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }


    public static function getProductsList()
    {
        // Соединение с БД
        $db = Db::getConnect();
        // Получение и возврат результатов
        $result = $db->query('SELECT id, name, price, code FROM product ORDER BY id ASC');
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['price'] = $row['price'];
            $i++;
        }
        return $productsList;
    }
    /**
     * Удаляет товар с указанным id
     * @param integer $id <p>id товара</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteProductById($id)
    {
        // Соединение с БД
        $db = Db::getConnect();
        // Текст запроса к БД
        $sql = 'DELETE FROM product WHERE id = :id';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    /**
     * Редактирует товар с заданным id
     * @param integer $id <p>id товара</p>
     * @param array $options <p>Массив с информацей о товаре</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateProductById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnect();
        // Текст запроса к БД
        $sql = "UPDATE product
            SET 
                name = :name, 
                code = :code, 
                price = :price, 
                category_id = :category_id, 
                brand = :brand, 
                availability = :availability, 
                description = :description, 
                is_new = :is_new, 
                is_recomended = :is_recomended, 
                status = :status
            WHERE id = :id";
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recomended', $options['is_recomended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }
    /**
     * Добавляет новый товар
     * @param array $options <p>Массив с информацией о товаре</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createProduct($options)
    {
        // Соединение с БД
        $db = Db::getConnect();
        // Текст запроса к БД
        $sql = 'INSERT INTO product '
                . '(name, code, price, category_id, brand, availability,'
                . 'description, is_new, is_recomended, status)'
                . 'VALUES '
                . '(:name, :code, :price, :category_id, :brand, :availability,'
                . ':description, :is_new, :is_recomended, :status)';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recomended', $options['is_recomended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }
    /**
     * Возвращает текстое пояснение наличия товара:<br/>
     * <i>0 - Под заказ, 1 - В наличии</i>
     * @param integer $availability <p>Статус</p>
     * @return string <p>Текстовое пояснение</p>
     */
    public static function getAvailabilityText($availability)
    {
        switch ($availability) {
            case '1':
                return 'В наличии';
                break;
            case '0':
                return 'Под заказ';
                break;
        }
    }

		
	}

?>