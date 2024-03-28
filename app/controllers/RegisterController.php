<?php

namespace app\controllers;
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
            $name = trim($_POST['name']);
            $username = trim($_POST['user']);
            $email = trim($_POST['email']);
            $password1 = trim($_POST['password1']);
            $sector = trim($_POST['sector']);



            $this->validName($name);
    
            $this->validLengthUser($username);
    
            for ($i=1; $i < 3; $i++) { 
                $this->validLenghtPasswords($_POST["password{$i}"], $i);
            }
            
            $this->validMatchPasswords($_POST["password1"], $_POST["password2"]);
    
    
            $this->validStrongPasswords($_POST["password1"]);
    
            $hasUser = $this->hasUser($username);
    
            if ($hasUser) {
                header("Location: /register?userInvalidError");
                exit();
            }
            
    
    
            
            
            $registerStatus = UserModel::registerUser(trim($name), trim($username), trim($_POST["password1"]), trim($_POST["sector"]));
    
    
            if ($registerStatus) {
                header("Location: /login");
                exit();
            }
    
            header("Location: /register?error");
    
            exit();
        }
    }


}

