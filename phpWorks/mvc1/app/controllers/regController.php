<?php
use Libs\User as User;

class regController extends Controller {
    public function __construct($prefix) {
        parent::__construct($prefix);
        
        $this->view->setTitle("Регистрация/Авторизация");
    }
    
    public function registration() {
        // лучше присваивание делать не на прямую, а через метод, который экранирует от sql инъекций
        $name = htmlspecialchars($_POST['name']);
        $login = htmlspecialchars($_POST['login']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_confirm = htmlspecialchars($_POST['password_confirm']);
        
        if ($password_confirm == $password) {
            
            if ($name == "" or $login == "" or $email == "" or $password == ""){
                echo json_encode(array("error" => "Форма не заполнена"));
                die; // убивает дальнейщее выполнение кода
            }
            
            if ($this->model->loginExists($login)) {
                echo json_encode(array("error" => "Логин уже существует"));
                die; // убивает дальнейщее выполнение кода
            }
            if ($this->model->emailExist($email)) {
                echo json_encode(array("error" => "Почта уже используется"));
                die; // убивает дальнейщее выполнение кода
            }
            
            $data = array(
                "login" => $login, 
                "role" => 2, 
                "password" => md5($password), 
                "name" => $name, 
                "email" => $email,
                );
            
            if ($id = $this->model->registration($data)) {
                $data['id'] = $id["id"];
                //var_dump($id["id"]);
                //User::login(array("id" => $id, "name" => $data["name"], "role" => $data["role"]));
                User::login($data);
                echo json_encode(array("error" => ""));
            } else {
                echo json_encode(array("error" => "Произошла ошибка"));
            };
        } else {
            echo json_encode(array("error" => "Пароли не совпадают"));
        }
    }
    
    public function login( ){
        $data["LOGIN"] = htmlspecialchars($_POST['login']);
        $data["PASSWORD"] = htmlspecialchars($_POST['password']);
        sleep(2);
        if ($this->model->loginExists($data["LOGIN"])) {
            if ($user = $this->model->authorization($data)) {
                User::login($user);
                echo json_encode(array("error" => ""));
            } else {
               echo json_encode(array("error" => "Пароль указан неверно?!")); 
            }
            } else {
            echo json_encode(array("error" => "Логин не существует"));
        }
    }
    
    public function logout() {
        User::logout();
        header('Location:'.MAIN_PREFIX.'/');
    }
}

