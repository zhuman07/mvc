<?php

	class Blog
	{

		const SHOW_BY_DEFAULT = 6;

		public static function getBlogCategoryList() {
			$db = Db::getConnect();
			$categoryList = array();
			$result = $db->query('SELECT id, name FROM blog_category ORDER BY sort_order ASC');
			$i = 0;
			while ($row = $result->fetch()) {
				$categoryList[$i]['id'] = $row['id'];
				$categoryList[$i]['name'] = $row['name'];
				$i++;
			}
			return $categoryList;
		}

		public static function getBlogCategoryName($id) {
			$id = intval($id);
			if($id) {
				$db = Db::getConnect();
				$result = $db->query("SELECT name FROM blog_category where id=".$id);
				$result->setFetchMode(PDO::FETCH_ASSOC);
				return $result->fetch();
		}
	}

	public static function getBlogs($count = self::SHOW_BY_DEFAULT) {
			$count = intval($count);

			$db = Db::getConnect();

			$blogList = array();

			$result = $db->query("SELECT id, h1, short_content, content, date, preview FROM blog "
				. "WHERE status = '1' "
				. "ORDER BY id DESC "
				. "LIMIT ".$count);

			$i = 0;

			while ($row = $result->fetch()) {
				$blogList[$i]['id'] = $row['id'];
				$blogList[$i]['h1'] = $row['h1'];
				$blogList[$i]['short_content'] = $row['short_content'];
				$blogList[$i]['content'] = $row['content'];
				$blogList[$i]['date'] = explode(" ", $row['date']);
				$blogList[$i]['preview'] = $row['preview'];
				$i++;
			}

			return $blogList;
	}

	public static function getBlogListByCategory($categoryId = false) {

			if($categoryId) {

				$db = Db::getConnect();

				$blogList = array();

				$result = $db->query("SELECT id, h1, short_content, content, date, preview FROM blog "
					. "WHERE status = '1' AND category_id = $categoryId "
					. "ORDER BY id DESC "
					. "LIMIT ".self::SHOW_BY_DEFAULT);

				$i = 0;

				while ($row = $result->fetch()) {
				$blogList[$i]['id'] = $row['id'];
				$blogList[$i]['h1'] = $row['h1'];
				$blogList[$i]['short_content'] = $row['short_content'];
				$blogList[$i]['content'] = $row['content'];
				$blogList[$i]['date'] = $row['date'];
				$blogList[$i]['preview'] = $row['preview'];
				$i++;
			}

			return $blogList;
			}

		}

		public static function getBlogById($id){

			$id = intval($id);
			if($id) {
				$db = Db::getConnect();
				$result = $db->query("SELECT * FROM blog where id=".$id);
				$result->setFetchMode(PDO::FETCH_ASSOC);
				return $result->fetch();
			}

		}



		public static function getBlogCategoriesListAdmin()
    {
        // Соединение с БД
        $db = Db::getConnect();
        // Запрос к БД
        $result = $db->query('SELECT id, name, sort_order, status FROM blog_category ORDER BY sort_order ASC');
        // Получение и возврат результатов
        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }
        return $categoryList;
    }
    /**
     * Удаляет категорию с заданным id
     * @param integer $id
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteBlogCategoryById($id)
    {
        // Соединение с БД
        $db = Db::getConnect();
        // Текст запроса к БД
        $sql = 'DELETE FROM blog_category WHERE id = :id';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    /**
     * Редактирование категории с заданным id
     * @param integer $id <p>id категории</p>
     * @param string $name <p>Название</p>
     * @param integer $sortOrder <p>Порядковый номер</p>
     * @param integer $status <p>Статус <i>(включено "1", выключено "0")</i></p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateBlogCategoryById($id, $name, $sortOrder, $status)
    {
        // Соединение с БД
        $db = Db::getConnect();
        // Текст запроса к БД
        $sql = "UPDATE blog_category
            SET 
                name = :name, 
                sort_order = :sort_order, 
                status = :status
            WHERE id = :id";
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }
    /**
     * Возвращает категорию с указанным id
     * @param integer $id <p>id категории</p>
     * @return array <p>Массив с информацией о категории</p>
     */
    public static function getBlogCategoryById($id)
    {
        // Соединение с БД
        $db = Db::getConnect();
        // Текст запроса к БД
        $sql = 'SELECT * FROM blog_category WHERE id = :id';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        // Выполняем запрос
        $result->execute();
        // Возвращаем данные
        return $result->fetch();
    }
    /**
     * Возвращает текстое пояснение статуса для категории :<br/>
     * <i>0 - Скрыта, 1 - Отображается</i>
     * @param integer $status <p>Статус</p>
     * @return string <p>Текстовое пояснение</p>
     */
    public static function getBlogStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }
    /**
     * Добавляет новую категорию
     * @param string $name <p>Название</p>
     * @param integer $sortOrder <p>Порядковый номер</p>
     * @param integer $status <p>Статус <i>(включено "1", выключено "0")</i></p>
     * @return boolean <p>Результат добавления записи в таблицу</p>
     */
    public static function createBlogCategory($name, $sortOrder, $status)
    {
        // Соединение с БД
        $db = Db::getConnect();
        // Текст запроса к БД
        $sql = 'INSERT INTO blog_category (name, sort_order, status) '
                . 'VALUES (:name, :sort_order, :status)';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }



	}

?>