<?php

class categoryController extends Controller {
    
    private static $instance;
    
    public function __construct($prefix) {
        parent::__construct($prefix);
        $this->view->setTitle("Категории новостей");
    }
    
    public function index() {
        if ($category = $this->model->getList('category')) {
            $this->view->arResult["ITEMS"] = $this->getTreeForArray($category);
        } else {
            $this->view->arResult["ITEMS"] = array();
        }
        
        parent::index();
    }
    
    public function add(){
        $data = array(
            'name' => htmlspecialchars($_POST["category_name"]),
            'code' => htmlspecialchars($_POST["category_code"]),
            'parent_id' => htmlspecialchars($_POST["parent_category"]) == 0 ? null : htmlspecialchars($_POST["parent_category"]),
            'depth_level' => is_null(($_POST["depth_level"])) ? 0 : htmlspecialchars($_POST["depth_level"])
        );
        
        if (strlen($data['name']) >= 2 && strlen($data['code']) >= 2) {
            if ($id = $this->model->add($data)) {
                echo json_encode(array("error" => false));
            } else {
                echo json_encode(array("error" => true));
            }
        } else {
            echo json_encode(array("error" => true));
        }
    }
    
    public function del(){
        $data = array(
            "id" =>  htmlspecialchars((int) $_POST["id"])
        );
        if ($data["id"] > 0) {
            if ($this->model->delete("category", "id", $data["id"])) {
                echo json_encode(array('success' => "true"));
            } else {
                echo json_encode(array('success' => "false"));
            }
        }
    }
    
    public function edit(){
        $data = array(
            'id' => htmlspecialchars($_POST["id"]),
            'name' => htmlspecialchars($_POST["category_name"]),
            'code' => htmlspecialchars($_POST["category_code"]),
            'parent_id' => htmlspecialchars($_POST["parent_category"]) == 0 ? null : htmlspecialchars($_POST["parent_category"]),
            'depth_level' => is_null(($_POST["depth_level"])) ? 0 : htmlspecialchars($_POST["depth_level"])
        );
        
        if (strlen($data['name']) >= 2 && strlen($data['code']) >= 2 && $data['id']>0) {
            if ($id = $this->model->edit($data)) {
                echo json_encode(array("error" => false));
            } else {
                echo json_encode(array("error" => true));
            }
        } else {
            echo json_encode(array("error" => true));
        }
    }
    
    public function getEditFormByID($id){
        
        $data = $this->model->getByID($id, 'category');
        $this->view->category = $data;
        $category = $this->model->getList('category');
        
        $this->view->all_category = $this->getTreeForArray($category);
        $this->view->render(strtolower(get_class($this)), "edit_form");
    }
    
    
        // Типо реализация паттерна ООП Фабрика (для экономии памяти)
    public static function getInstance() {
        
        $instance = null;
        
        if (!empty(self::$instance) && self::$instance instanceof categoryController) {
            $instance = self::$instance;
        } else {
            $instance = new categoryController();
        }
        
        return $instance;
    }
}