<?php

use Libs\Files;

include_once 'sectionsController.php';

class productsController extends Controller {
    public function __construct($prefix) {
        parent::__construct($prefix);
        $this->view->setTitle("Товары");
        
        $sections = $this->getTreeForArray($this->model->getList('sections'));
        $this->view->sections = $sections;
        
    }
    
    // метод вызывается автоматом при загрузке страницы
    public function index() {
        if ($products = $this->model->getList('products')) {
            //var_dump($this->model->getList('products'));
            $this->view->arResult["ITEMS"] = $products;
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
        
        if (strlen($data['product_name']) < 2) {
            $error["name"] = "short";
        }
        if (strlen($data['product_code']) < 2) {
            $error["code"] = "short";
        }
        
        // заполняем информацию о загружаемых файлах
        if (isset($_FILES["product_p_img"])) {
            $data["p_img"] = Files::uploadFile($_FILES["product_p_img"], get_class($this));
        }
        if (isset($_FILES["product_d_img"])) {
            $data["d_img"] = Files::uploadFile($_FILES["product_d_img"], get_class($this));
        }
        if (isset($_FILES["product_imgs"])) {
            $arr_files = array();
            foreach ($_FILES["product_imgs"] as $key => $values) {
                foreach ($values as $k => $v) {
                    $arr_files[$k][$key] = $v;
                }
            }
            foreach ($arr_files as $file) {
                $data["imgs"][] = Files::uploadFile($file, get_class($this));
            }
        }
        
        //var_dump(Files::uploadFile($_FILES["product_p_img"], get_class($this)));
        
        if (count($error) == 0) {
            $addData = array(
            "name" => $data["product_name"],
            "code" => $data["product_code"],
            "price" => (int) $data["product_price"],
            "sections_id" => $data["parent_section"],
            "active" => is_null($data["product_active"]) ? "0" : "1",
            "description" => $data["product_description"],
            "p_img" => $data["p_img"],
            "d_img" => $data["d_img"],
            "imgs" => json_encode($data["imgs"]),
            
            );
            //var_dump($addData);
            if ($id = $this->model->add($addData)) {
                echo json_encode(array("error" => false));
            } else {
                $files_to_remove["p_img"] = $addData["p_img"];
                $files_to_remove["d_img"] = $addData["d_img"];
                $files_to_remove["imgs"] = $addData["imgs"];
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
            $imgs = $this->model->getByID($data["id"], "products", $select = "p_img, d_img, imgs");
            // Впринципе, delete вызывается из "name"Model, т. е. метод можно не создавать там и он выполниться из родительского, либо метод можно переопределить
            if ($this->model->delete("products", "id", $data["id"], $imgs)) {
                
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
        $old_data = $this->model->getByID($_POST["id"], 'products');
        
        if (count($_POST) > 0) {
            foreach ($_POST as $key => $rd) { // rd - response data
                $data[htmlspecialchars($key)] = htmlspecialchars($rd);
            }
        }
        if (strlen($data['product_name']) < 2) {
            $error["name"] = "short";
        }
        if (strlen($data['product_code']) < 2) {
            $error["code"] = "short";
        }
        
        //$artcl = strlen($data["product_code"]) >= 6 ? substr($data["product_code"], 6) : $data["product_code"];
        // заполняем информацию о загружаемых файлах
        if (isset($_FILES["product_p_img"])) {
            $data["p_img"] = Files::uploadFile($_FILES["product_p_img"], get_class($this));
        }
        if (isset($_FILES["product_d_img"])) {
            $data["d_img"] = Files::uploadFile($_FILES["product_d_img"], get_class($this));
        }
        if (isset($_FILES["product_imgs"])) {
            $arr_files = array();
            foreach ($_FILES["product_imgs"] as $key => $values) {
                foreach ($values as $k => $v) {
                    $arr_files[$k][$key] = $v;
                }
            }
            foreach ($arr_files as $file) {
                $data["imgs"][] = Files::uploadFile($file, get_class($this));
            }
        }

        if (count($error) == 0) {
            $editData = array(
                "id" => $data["id"],
                "name" => $data["product_name"],
                "code" => $data["product_code"],
                "price" => (int) $data["product_price"],
                "sections_id" => $data["parent_section"],
                "active" => is_null($data["product_active"]) ? "0" : "1",
                "description" => $data["product_description"],
                "p_img" => $data["p_img"],
                "d_img" => $data["d_img"],
                "imgs" => json_encode($data["imgs"]),
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
            if ($data["imgs"][0] == false) {
                $data["imgs"] = array();
            }
            if (count(explode(",", substr($data["old_src"],0,-1)))>0) {
                $t = array();
                $old = json_decode($old_data["imgs"]);
                foreach (explode(",", substr($data["old_src"],0,-1)) as $old_img) {
                    foreach ($old as $l) {
                        if ($l == $old_img) {
                            unset($old[array_search($l, $old)]);
                            break;
                        }
                    }
                    if (!$old_img == "") {
                        $t[] = $old_img;
                    }
                }
                $editData["imgs"] = json_encode(array_merge($t, $data["imgs"]));
                $files_to_remove["imgs"] = json_encode($old);
            }
            
            var_dump("Поступили новые картинки: ", $data["imgs"]);
            var_dump("Новые ", $editData["imgs"], "\n");
            var_dump("Картинки к удалению", $files_to_remove);
            
            if ($id = $this->model->edit($editData)) {
                $this->model->deleteIMGS($files_to_remove);
                echo json_encode(array("error" => false));
            } else {
                // Если изменить данные не удалось, то надо удалить загруженные ранее картинки
                $files_to_remove["p_img"] = $data["p_img"];
                $files_to_remove["d_img"] = $data["d_img"];
                $files_to_remove["imgs"] = json_encode($data["imgs"]);
                var_dump("Файлы к удалению - их нельзя загрузить", $files_to_remove);
                $this->model->deleteIMGS($files_to_remove);
                echo json_encode(array("error" => true));
            }
        } else {
            echo json_encode(array("errors" => $error));
        }
    }

    public function getEditFormByID($id){
        
        $data = $this->model->getByID($id, 'products');
        //var_dump($data);
        $this->view->products = $data;
        $sections = $this->model->getList('sections');
        
        $this->view->all_sections = $this->getTreeForArray($sections);
        $this->view->render(strtolower(get_class($this)), "edit_form");
    }
    
}
