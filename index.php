<?php

	// Month: 11, Day: 21, Year: 2015
/*
	$string = '21-11-2015';

	$pattern = '/([0-9]{2})-([0-9]{2})-([0-9]{4})/';

	$replacement = "Month: $2, Day: $1, Year: $3";

	echo preg_replace($pattern, $replacement, $string);
*/
	/*
	// День 30, Месяц 2, Год 2006
	$subjected = "2-30-2006";
	$pattern = "/([0-9]{1})-([0-9]{2})-([0-9]{4})/";
	$replacement = "День $2, Месяц $1, Год $3";
	echo preg_replace($pattern, $replacement, $subjected);
*/

	// Front Controller

	// 1. Общие настройки
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	session_start();
	
	// 2. Подключение файлов системы
	define('ROOT', dirname(__FILE__));
	require_once(ROOT.'/components/Autoload.php');

	// 3. Установка соеденений с базой данных

	// 4. Вызов Router
	$router = new Router;
	$router->run();

?>