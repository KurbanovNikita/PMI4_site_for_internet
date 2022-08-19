<?php

include_once 'sectionsController.php';

class productsController extends Controller {
    private static $instance;
    
    public function __construct($prefix) {
        parent::__construct($prefix);
        $this->view->setTitle("Товары");
        
    }
    
    public static function getInstance($prefix) {
        
        $instance = null;
        
        if (!empty(self::$instance) && self::$instance instanceof productsController) {
            $instance = self::$instance;
        } else {
            $instance = new productsController($prefix);
        }
        
        return $instance;
    }
    
    // метод вызывается автоматом при загрузке страницы
    public function index() {

        parent::index();
    }

    public function getList() {
        if ($products = $this->model->getList('products', "id asc","*")) {
            return $products;
        } else {
            return array();
        }
    }
    
    public function getShowFormByID($id){
        
        $data = $this->model->getByID($id, 'products');
        //var_dump($data);
        $this->view->products = $data;
        
        $this->view->render(strtolower(get_class($this)), "show_form");
    }
    
    public function getProductsBySection($sec_id){
        $correct = array();
        $iter = 0;
        $now_id = array();
        $now_id[] = $sec_id;
        $next_id = array();
        $filter = " sections_id in (";
        if ($sections = $this->model->getList("sections")) {
            while (true) {
               $iter = $iter + 1;
               foreach ($now_id as $id) {
                    foreach ($sections as $sec) {
                        if ($sec["parent_id"] == $id) {
                            $next_id[] = $sec["id"];
                        }
                    }
                    $filter = $filter.$id.", ";
                }

                if (count($next_id) == 0) {
                    break;
                } else {
                    $now_id = $next_id;
                    $next_id = array();
                }
                
                if ($iter > 10000)
                    break;
            }
        }
        $filter = substr($filter,0,-2).") ";
        //var_dump($filter);
        
        $data = $this->model->getList("products", "id asc", "*", $filter);
        $this->view->products = $data;
        
        $this->view->render(strtolower(get_class($this)), "product_by_section");
    }
}
