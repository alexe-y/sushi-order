<?php

class Router
{

    private $routes;

    public function __construct()
    {
        // Записываем массив роутов в переменную
        $routesPath=ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        // Получить строку запроса
        $uri = $this->getURI();
        // Проверит наличие запроса в файле routes
        $result = 0;
        foreach ($this->routes as $uriPattern => $path)
        {
            // Если есть совпадение, определить контроллер и асtion для даного запроса
            if (preg_match("~$uriPattern~", $uri)) {

                // Получаем внутренний путь из внешнего

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute);

                $controllerName = ucfirst(array_shift($segments) . "Controller");
                $actionName = "action" . ucfirst(array_shift($segments));
                $parameters = $segments;


                // Подключить файл класса контроллера
                $controllerFile = ROOT . "/Controllers/" . $controllerName . ".php";
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }
                //else {Router::Error404();}
                // Создать обьект, вызвать action
                $controllerObject = new $controllerName;
                $result= call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != 0) {
                    break;
                }
            }

        }
        if ($result==0){
                include_once ROOT. '/Controllers/LandingController.php';
                $controllerObject = new LandingController;
                $controllerObject->actionIndex();

        }

    }

}