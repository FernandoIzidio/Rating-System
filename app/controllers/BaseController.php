<?php
/* 
Módulo destinado a metódos de validação, os outros controllers, vão ter apenas metódos de acesso para requisições

*/



namespace app\controllers;
use app\database\config\Connection;
use app\models\ModelUser;

abstract class FormController{

    public function hasUser(){
       
        require_once "../app/database/config/connection.php";
        
        require_once "../app/models/User.php";

        Connection::configureConnection();

        $pdo = Connection::getConnection();

        $r1 = new ModelUser($pdo);

        $users = $r1->getUser($_POST["user"]);


        return count($users) > 0;

    }

}

abstract class BaseRegister extends FormController{

    public function validName(){
        if ((strlen($_POST["name"]) < 3)){
            header("Location: register?nameError");
            exit();
        }
    }

    public function validLengthUser(){
        if (strlen($_POST["user"]) < 6){
            header("Location: register?userError");
            exit();
        }
    }


    public function validLenghtPasswords(string $var, int $number){
        if (strlen($_POST[$var]) < 8){
            header("Location: register?passwd{$number}Error");
            exit();
        }
    }


    public function validMatchPasswords(){
        if ($_POST["password1"] !== $_POST["password2"]){
            header("Location: register?passwdUnMatchError");    
            exit();    
        }
    }


    public function validStrongPasswords(){
        if (!preg_match("/[!@#$%^&*()\-_=+{};:,<.>]/", $_POST["password1"]) || 
            !preg_match("/[0-9]/", $_POST["password1"]) || 
            !preg_match("/[A-Z]/", $_POST["password1"]) || 
            !preg_match("/[a-z]/", $_POST["password1"])) {
                header("Location: register?passwdInvalidError");
                exit();
        }
    }

    
}

abstract class BaseLogin extends FormController{

}

