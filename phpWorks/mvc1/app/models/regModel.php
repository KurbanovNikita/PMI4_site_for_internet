<?php

class regModel extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function registration($data) {
        // готовим запрос --- метод PDO::prepare() возвращает не PDO объект, а объект класса PDOStatment
        $sth = $this->db->prepare("INSERT users (login, role, password, name, email)"
                ." VALUES (:login, :role, :password, :name, :email) ");
        $sth->execute($data);
        
        if ( $sth->rowCount() > 0) {
            $m = $this->db->prepare("SELECT id FROM users WHERE login = :login"); 
            $m->execute(array(":login" => $data["login"]));
            if ($m->rowCount() > 0) {
                return $m->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    
    public function loginExists( $login ) {
        // sth - statment --- db лежит в объекте PDO
        $sth = $this->db->prepare("SELECT id FROM users WHERE login = :login");
        // поскольку мы находимся в модели, то логин необходимо проверять (на корректность и т. д.) в контроллере, а не вможеле
        $sth->execute(array(":login" => $login));
        
        if ( $sth->rowCount() > 0 ) { // если execute что-то вернул
            //return $this->db->lastInsertId();
            return true;
        } else {
            return false;
        }
    }
    
    public function emailExist( $email ) {
        
        $sth = $this->db->prepare("SELECT id FROM users WHERE email = :email");
        $sth->execute(array(":email" => $email));
        
        if ( $sth->rowCount() > 0 ) {
            return true;
        } else {
            return false;
        }
    }
    
    public function authorization($data){
        $sth = $this->db->prepare("SELECT id, name, role, login FROM users WHERE login = :login AND password = :password");
        $sth->execute(array(":login" => $data["LOGIN"], ":password" => md5($data["PASSWORD"])));
        
        if ($res = $sth->fetch(PDO::FETCH_ASSOC)) {
            return $res;
        } else {
            return false;
        }
    }
}
