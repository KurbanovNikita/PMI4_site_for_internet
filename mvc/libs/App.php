<?php

class App{
    
    public function __construct() {
        if (isset($_GET['url'])) {
            $url = explode('/', rtrim($_GET['url'], '/'));
        } else {
            $url[0] = 'index';
        }

        $file_name = 'controllers/'.$url[0].'.php';
        if (file_exists($file_name)) {
            // Подключение контроллера
            require_once $file_name;
            $controller = new $url[0];
            // Вызов метода
            if (isset($url[1])) {

                if (method_exists($controller, $url[1])) {
                    // Передача параметров методу
                    if (isset($url[2])) {
                        $controller->{$url[1]}($url[2]);
                    } else {
                        $controller->{$url[1]}();
                    }
                } else {
                    echo 'Erro method dose not exists';
                }
            } else {
                $controller->index();
            }
        } else {
            echo 'Error file dose not exists';
        }
    }
}
