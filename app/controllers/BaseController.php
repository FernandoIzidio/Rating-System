<?php
/* 
Módulo destinado a metódos de validação, os outros controllers vão ter apenas metódos de acesso para requisições

*/

namespace app\controllers;
use app\models\UserModel;
use Jenssegers\Blade\Blade;


abstract class BaseController {
    protected static $blade;

    protected function hasSession():bool{
        return (isset($_SESSION) && array_key_exists("logged_in", $_SESSION) && $_SESSION["logged_in"]);
    }
    

    protected function getLogs(): array{
        $json_path = "./logs/logerrors.json";
        $json_desc  = fopen($json_path, "r");

        if (filesize($json_path) > 0){
            $json_content = json_decode(fread($json_desc, filesize($json_path)), true);
        }
        return $json_content;
    }


    protected function getBlade():Blade{
        if (!isset(self::$blade)){
        self::$blade = new Blade("../app/views", "../app/cache");
        }
        return self::$blade;
    }

    protected function hasAdmin():bool{
        return (isset($_SESSION) && array_key_exists("admin_permission", $_SESSION) && ($_SESSION["admin_permission"] || $_SESSION["super_admin"]));
        
    }

    public function hasUser(string $user):bool{
        $users=  UserModel::getField("user", $user, ["user"]);
  
        return count($users) > 0;

    }

    protected abstract function getView();

}

abstract class BaseRegister extends BaseController{
 


    public function isValidName(string $name){
        return ((strlen(trim($name)) >= 3));
    }

    public function isValidUser(string $user){
        return (strlen(trim($user)) >= 6);
    }


    public function isValidPassword(string $password){
        return (strlen(trim($password)) >= 8);
    }


    public function isMatchPasswords(string $password1, string $password2){
        return (trim($password1) === trim($password2));
     }
    


    public function isStrongPassword(string $password){
        return (preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", trim($password)) && 
            preg_match("/[0-9]/", trim($password)) && 
            preg_match("/[A-Z]/", trim($password)) && 
            preg_match("/[a-z]/", trim($password)));
        }

    protected abstract function postView();

}

abstract class BaseLogin extends BaseController{
  

    protected abstract function postView();

}

