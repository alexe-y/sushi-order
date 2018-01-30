<?php
// FRONT CONTROLLER

// Настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);
// подключение Файлов системы
session_start();
define('ROOT', dirname(__FILE__));
require_once (ROOT.'/Components/Router.php');
require_once (ROOT.'/Components/db.php');
// Соединение с БД
// $db = db::getInstance()->db; // <- в модели
// Вызов роутера

$router=new Router();
$router->run();
?>