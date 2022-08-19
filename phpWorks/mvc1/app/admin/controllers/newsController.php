<?php

use Libs\Files;

include_once 'categoryController.php';

class newsController extends Controller {
    public function __construct($prefix) {
        parent::__construct($prefix);
        $this->view->setTitle("Новости");
        
        $categories = $this->getTreeForArray($this->model->getList('category'));
        $this->view->categories = $categories;
    }
    
    
        // метод вызывается автоматом при загрузке страницы
    public function index() {
        if ($news = $this->model->getList('news')) {
            //var_dump($this->model->getList('products'));
            $this->view->arResult["ITEMS"] = $news;
        } else {
            $this->view->arResult["ITEMS"] = array();
        }

        parent::index();
    }

    public function add() {
        $data = array();
        $error = array();
        $files_to_remove = array();
        //var_dump($_POST); // var_dump($_FILES) - покажет информацию о файле
        
        if (count($_POST) > 0) {
            foreach ($_POST as $key => $rd) { // rd - response data
                $data[htmlspecialchars($key)] = htmlspecialchars($rd);
            }
        }
        
        if (strlen($data['news_title']) < 2) {
            $error["title"] = "short";
        }
        if (strlen($data['news_code']) < 2) {
            $error["code"] = "short";
        }
        
        // заполняем информацию о загружаемых файлах
        if (isset($_FILES["news_p_img"])) {
            $data["p_img"] = Files::uploadFile($_FILES["news_p_img"], get_class($this));
        }
        if (isset($_FILES["news_d_img"])) {
            $data["d_img"] = Files::uploadFile($_FILES["news_d_img"], get_class($this));
        }
        
        if (count($error) == 0) {
            $addData = array(
            "title" => $data["news_title"],
            "code" => $data["news_code"],
            "category_id" => $data["parent_category"],
            "description" => $data["news_description"],
            "p_img" => $data["p_img"],
            "d_img" => $data["d_img"],
            "text" => $data["news_text"],
            
            );
            //var_dump($addData);  
            //var_dump($addData);
            if ($id = $this->model->add($addData)) {
                echo json_encode(array("error" => false));
            } else {
                $files_to_remove["p_img"] = $addData["p_img"];
                $files_to_remove["d_img"] = $addData["d_img"];
                var_dump("Файлы к удалению - их нельзя загрузить", $files_to_remove);
                $this->model->deleteIMGS($files_to_remove);
                echo json_encode(array("error" => true));
            }
        } else {
            echo json_encode(array("errors" => $error));
        }
        
    }
    
    public function del(){
        $data = array(
            "id" =>  htmlspecialchars((int) $_POST["id"])
        );
        if ($data["id"] > 0) {
            $imgs = $this->model->getByID($data["id"], "news", $select = "p_img, d_img");
            // Впринципе, delete вызывается из "name"Model, т. е. метод можно не создавать там и он выполниться из родительского, либо метод можно переопределить
            if ($this->model->delete("news", "id", $data["id"], $imgs)) {
                
                echo json_encode(array('success' => "true"));
            } else {
                echo json_encode(array('success' => "false"));
            }
        }
    }
    
    public function edit() {
        $data = array();
        $error = array();
        $files_to_remove = array();
        $old_data = $this->model->getByID($_POST["id"], 'news');
        
        if (count($_POST) > 0) {
            foreach ($_POST as $key => $rd) { // rd - response data
                $data[htmlspecialchars($key)] = htmlspecialchars($rd);
            }
        }
        
        if (strlen($data['news_title']) < 2) {
            $error["title"] = "short";
        }
        if (strlen($data['news_code']) < 2) {
            $error["code"] = "short";
        }
        
        // заполняем информацию о загружаемых файлах
        if (isset($_FILES["news_p_img"])) {
            $data["p_img"] = Files::uploadFile($_FILES["news_p_img"], get_class($this));
        }
        if (isset($_FILES["news_d_img"])) {
            $data["d_img"] = Files::uploadFile($_FILES["news_d_img"], get_class($this));
        }
        
        var_dump($_POST);
        if (count($error) == 0) {
            $editData = array(
                "id" => $data["id"],
                "title" => $data["news_title"],
                "code" => $data["news_code"],
                "category_id" => $data["parent_category"],
                "description" => $data["news_description"],
                "p_img" => $data["p_img"],
                "d_img" => $data["d_img"],
                "text" => $data["news_text_2"],
            );
            // управление загружаемыми и имеющимеся картинками
            if ($data["p_img"] == "") {
                var_dump("П картинка пустая!");
                $editData["p_img"] = $old_data["p_img"];
            } else {
                $files_to_remove["p_img"] = $old_data["p_img"];
            }
            if ($data["d_img"] == "") {
                var_dump("Д картинка пустая!");
                $editData["d_img"] = $old_data["d_img"];
            } else {
                $files_to_remove["d_img"] = $old_data["d_img"];
            }
            
            var_dump("Картинки к удалению", $files_to_remove);
            
            if ($id = $this->model->edit($editData)) {
                $this->model->deleteIMGS($files_to_remove);
                echo json_encode(array("error" => false));
            } else {
                // Если изменить данные не удалось, то надо удалить загруженные ранее картинки
                $files_to_remove["p_img"] = $data["p_img"];
                $files_to_remove["d_img"] = $data["d_img"];
                var_dump("Файлы к удалению - их нельзя загрузить", $files_to_remove);
                $this->model->deleteIMGS($files_to_remove);
                echo json_encode(array("error" => true));
            }
        } else {
            echo json_encode(array("errors" => $error));
        }
    }

    public function getEditFormByID($id){
        
        $data = $this->model->getByID($id, 'news');
        //var_dump($data);
        $this->view->news = $data;
        $categories = $this->model->getList('category');
        
        $this->view->all_categories = $this->getTreeForArray($categories);
        $this->view->render(strtolower(get_class($this)), "edit_form");
    }
}
