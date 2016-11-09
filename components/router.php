<?php

	class Router
	{

		public $routes;

		public function __construct()
		{
			$routesPath = ROOT.'/config/routes.php';
			$this->routes = include($routesPath);
		}

		/*
		* return request string
		*/
		private function getURI()
		{
			if(!empty($_SERVER['REQUEST_URI'])) {
				return trim($_SERVER['REQUEST_URI'], '/');
			}
		}

		public function run()
		{
			// Получить строку запроса
			$uri = $this->getURI();

			// Проверить наличие такого запроса в routes.php
			foreach ($this->routes as $uriPattern => $path) {
				
				if(preg_match("~$uriPattern~", $uri)) {

					// Получаем внутренни путь из внешнего согласно правилу
					$internalRouter = preg_replace("~$uriPattern~", $path, $uri);

					// Если есть совпадение, определить какой контроллер и action обрабатывают запрос
					$segments = explode("/", $internalRouter);

					$controllerName = array_shift($segments)."Controller";
					$controllerName = ucfirst($controllerName);

					$actionName = 'action'.ucfirst(array_shift($segments));

					$parametrs = $segments;

					// Подключить файл класса контроллера
					$controllerFile = ROOT."/controllers/".$controllerName.".php";

					if(file_exists($controllerFile)) {
						include_once($controllerFile);
					}

					// Создать объект, вызвать метод(т.е action)
					$controllerObject = new $controllerName;
					$result = call_user_func_array(array($controllerObject, $actionName), $parametrs);
					if($result != null) {
						break;
					}
				}
			}
		}
	}

?>