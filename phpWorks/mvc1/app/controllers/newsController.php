<?php

include_once 'categoryController.php';

class newsController extends Controller {
    
    private static $instance;
    
    public function __construct($prefix) {
        parent::__construct($prefix);
        $this->view->setTitle("Новости");
    }
    
    public static function getInstance($prefix) {
        
        $instance = null;
        
        if (!empty(self::$instance) && self::$instance instanceof newsController) {
            $instance = self::$instance;
        } else {
            $instance = new newsController($prefix);
        }
        
        return $instance;
    }    
    
        // метод вызывается автоматом при загрузке страницы
    public function index() {
        parent::index();
    }
    
    public function getList() {
        if ($news = $this->model->getList('news', "date DESC","*")) {
            return $news;
        } else {
            return array();
        }
    }
    
    public function addComment(){
        $data = array(
            'user_id' => (int) htmlspecialchars($_POST["user_id"]),
            'news_id' => (int) htmlspecialchars($_POST["news_id"]),
            'text' => htmlspecialchars($_POST["comm_text"]),
        );
        //var_dump($data);
        if (!is_null($data['user_id']) && !is_null($data['news_id'])) {
            if ($id = $this->model->add($data,"commentaries","(user_id, news_id, text)","(:user_id, :news_id, :text)")) {
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
            if ($this->model->delete("commentaries", "id", $data["id"])) {
                echo json_encode(array('success' => "true"));
            } else {
                echo json_encode(array('success' => "false"));
            }
        }
    }
    
    public function showNewsByID($id) {
        $data = $this->model->getByID($id, 'news');
        //var_dump($data);
        $this->view->news = $data;
        $comments = $this->model->getList("commentaries, users", "commentaries.data asc","commentaries.id, users.name, commentaries.user_id, commentaries.data, commentaries.text", " commentaries.news_id = ".$id." AND users.id = commentaries.user_id ");
        $this->view->comments = $comments;
        
        $this->view->render(strtolower(get_class($this)), "show_news");
    }


    public function showNewsByCategory($cat_id){
        $correct = array();
        $iter = 0;
        $now_id = array();
        $now_id[] = $cat_id;
        $next_id = array();
        $filter = " category_id in (";
        if ($categories = $this->model->getList("category")) {
            while (true) {
               $iter = $iter + 1;
               foreach ($now_id as $id) {
                    foreach ($categories as $cat) {
                        if ($cat["parent_id"] == $id) {
                            $next_id[] = $cat["id"];
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
        
        $data = $this->model->getList("news", "date DESC", "*", $filter);
        $this->view->news = $data;
        
        $this->view->render(strtolower(get_class($this)), "news_by_category");
    }
}
