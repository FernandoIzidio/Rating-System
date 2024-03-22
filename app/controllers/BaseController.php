<?php
/* 
Módulo destinado a metódos de validação, os outros controllers vão ter apenas metódos de acesso para requisições

*/



namespace app\controllers;

use app\database\config\Connection;
use app\models\ModelUser;
use Jenssegers\Blade\Blade;



abstract class BaseController {
    protected static $blade;

    protected function hasSession(){
        return (isset($_SESSION) && array_key_exists("logged_in", $_SESSION) && $_SESSION["logged_in"]);
    }


    private function configureBlade(){
        if (!isset(self::$blade)){
            require_once '../vendor/autoload.php';
    
    
            $views = "../app/views";
            $cache = "../app/cache";
            self::$blade =  new Blade($views, $cache);
        }
    }

    protected function getBlade(){
        $this->configureBlade();
        return self::$blade;
    }

    protected function getLogs(){
        $json_path = "./logs/logerrors.json";
        $json_desc  = fopen($json_path, "r");

        if (filesize($json_path) > 0){
            $json_content = json_decode(fread($json_desc, filesize($json_path)), true);
        }
        return $json_content;
    }


    protected function hasAdmin(){
        return (isset($_SESSION) && array_key_exists("admin_permission", $_SESSION) && ($_SESSION["admin_permission"] || $_SESSION["super_admin"]));
        
    }

}

abstract class FormController extends BaseController{

    public function hasUser(string $user){

        

        require_once "../app/database/config/connection.php";
        
        require_once "../app/models/User.php";



        $pdo = Connection::getConnection();

        $r1 = new ModelUser($pdo);

        $users = $r1->getUser(trim($user));


        return count($users) > 0;

    }

}

abstract class BaseRegister extends FormController{

    public function validName(string $name){
        if ((strlen(trim($name)) < 3)){
            header("Location: /register?nameError");
            exit();
        }
    }

    public function validLengthUser(string $user){
        if (strlen(trim($user)) < 6){
            header("Location: /register?userError");
            exit();
        }
    }


    public function validLenghtPasswords(string $password, string $index = '1'){
        if (strlen(trim($password) < 8)){
            header("Location: /register?password{$index}Error");
            exit();
        }
    }


    public function validMatchPasswords(string $password1, string $password2){
        if (trim($password1) !== trim($password2)){
            header("Location: /register?passwdUnMatchError");    
            exit();    
        }
    }


    public function validStrongPasswords(string $password){
        if (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", trim($password)) || 
            !preg_match("/[0-9]/", trim($password)) || 
            !preg_match("/[A-Z]/", trim($password)) || 
            !preg_match("/[a-z]/", trim($password))) {
                header("Location: /register?passwdInvalidError");
                exit();
        }
    }

    
}

abstract class BaseLogin extends FormController{
    public function validUser(){
        $hasUser = $this->hasUser($_POST["user"]);
        
        if (!$hasUser) {
            header("Location: /login?loginError");
            exit();
        }
    }

}

