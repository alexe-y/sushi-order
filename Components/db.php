<?php
class db{
    public $db;
    private static $_instance=null;
    private function __construct(){
        // Получаем параметры соединения
        $paramsPath = ROOT. '/config/db_params.php';
        $params = include($paramsPath);

        // Соединяемся с БД
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset={$params['charset']}";
        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->db = new PDO($dsn, $params['user'], $params['password'], $opt);
    }
    protected function __clone(){

    }
    protected function __wakeup(){

    }
    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance= new self();
        }
        return self::$_instance;
    }
}