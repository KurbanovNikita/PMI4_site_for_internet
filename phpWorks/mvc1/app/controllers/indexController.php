<?php

class IndexController extends Controller {
    
    private static $instance;
    
    public function __construct($prefix) {
        parent::__construct($prefix);
    }
    
    public static function getInstance($prefix) {
        
        $instance = null;
        
        if (!empty(self::$instance) && self::$instance instanceof indexController) {
            $instance = self::$instance;
        } else {
            $instance = new indexController($prefix);
        }
        
        return $instance;
    }
    
    // метод вызывается автоматом при загрузке страницы
    public function index() {
        if ($news = $this->model->getList('news', "date DESC LIMIT 3")) {
            //var_dump($news = $this->model->getList('news', "date DESC LIMIT 3"));
            $this->view->arResult["NEWS"] = $news;
        } else {
            $this->view->arResult["NEWS"] = array();
        }
        parent::index();
    }
}
