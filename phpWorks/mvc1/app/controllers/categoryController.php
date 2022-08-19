<?php

class categoryController extends Controller {
    
    private static $instance;
    
    public function __construct($prefix) {
        parent::__construct($prefix);
        $this->view->setTitle("Категории новостей");
    }
    
    public function index() {
        parent::index();
    }
    
    public function getList() {
        if ($categories = $this->model->getList('category', "id asc","*"," `depth_level` = 0")) {
            return $this->getTreeForArray($categories);
        } else {
            return array();
        }
    }
    
    // Типо реализация паттерна ООП Фабрика (для экономии памяти)
    public static function getInstance($prefix) {
        
        $instance = null;
        
        if (!empty(self::$instance) && self::$instance instanceof categoryController) {
            $instance = self::$instance;
        } else {
            $instance = new categoryController($prefix);
        }
        
        return $instance;
    }
    
}