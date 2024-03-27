<?php

namespace app\controllers;

use app\database\config\Connection;
use app\models\UserModel;

require_once "../app/config/loader.php";



class RegisterController extends BaseRegister {
    public function getView(){
        if ($this->hasSession()){
            header("Location: /dashboard");
            exit();
        }

        echo $this->getBlade()->make("register", ['data' => $this->getLogs()])->render();
    }

    public function postView(){

        if (!empty($_POST)){

            $this->validName($_POST["name"]);
    
            $this->validLengthUser($_POST["user"]);
    
            for ($i=1; $i < 3; $i++) { 
                $this->validLenghtPasswords($_POST["password{$i}"], $i);
            }
            
            $this->validMatchPasswords($_POST["password1"], $_POST["password2"]);
    
    
            $this->validStrongPasswords($_POST["password1"]);
    
            $hasUser = $this->hasUser($_POST["user"]);
    
            if ($hasUser) {
                header("Location: /register?userInvalidError");
                exit();
            }
    
    
            $pdo = Connection::getConnection();
    
            $userModel = new UserModel($pdo);
            
            $registerStatus = $userModel->registerUser(trim($_POST["name"]), trim($_POST["user"]), trim($_POST["password1"]), trim($_POST["sector"]));
    
    
            if ($registerStatus) {
                header("Location: /login");
                exit();
            }
    
            header("Location: /register?error");
    
            exit();
        }
    }


}

