<?php
/* 
Módulo destinado a metódos de validação, os outros controllers, vão ter apenas metódos de acesso para requisições

*/



namespace app\controllers;
use app\database\config\Connection;
use app\models\ModelUser;


abstract class BaseController {

    protected function hasLogin(){
        if (isset($_SESSION) && array_key_exists("logged_in", $_SESSION) && $_SESSION["logged_in"]) {
            header("Location: /home");
            exit();
        }
    }

    protected function isvalidSession(){
        if (empty($_SESSION) || !isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]){
            header('Location: /');  
            exit();
        }
    }    
}

abstract class FormController extends BaseController{

    public function hasUser(){
       
        require_once "../app/database/config/connection.php";
        
        require_once "../app/models/User.php";

        Connection::configureConnection();

        $pdo = Connection::getConnection();

        $r1 = new ModelUser($pdo);

        $users = $r1->getUser(trim($_POST["user"]));


        return count($users) > 0;

    }

}

abstract class BaseRegister extends FormController{

    public function validName(){
        if ((strlen(trim($_POST["name"])) < 3)){
            header("Location: register?nameError");
            exit();
        }
    }

    public function validLengthUser(){
        if (strlen(trim($_POST["user"])) < 6){
            header("Location: register?userError");
            exit();
        }
    }


    public function validLenghtPasswords(string $var, int $number){
        if (strlen(trim($_POST[$var])) < 8){
            header("Location: register?password{$number}Error");
            exit();
        }
    }


    public function validMatchPasswords(){
        if (trim($_POST["password1"]) !== trim($_POST["password2"])){
            header("Location: register?passwdUnMatchError");    
            exit();    
        }
    }


    public function validStrongPasswords(){
        if (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", trim($_POST["password1"])) || 
            !preg_match("/[0-9]/", trim($_POST["password1"])) || 
            !preg_match("/[A-Z]/", trim($_POST["password1"])) || 
            !preg_match("/[a-z]/", trim($_POST["password1"]))) {
                header("Location: register?passwdInvalidError");
                exit();
        }
    }

    
}

abstract class BaseLogin extends FormController{
    public function validUser(){
        $hasUser = $this->hasUser();
        
        if (!$hasUser) {
            header("Location: login?loginError");
            exit();
        }
    }

}

