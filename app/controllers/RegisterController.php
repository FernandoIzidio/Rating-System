<?php

namespace app\controllers;

use app\models\SectorModel;
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
            $password2 = trim($_POST['password2']);
            $sector = trim($_POST['sector']);

            

            if (!$this->isValidName($name)){
                header("Location: /register?nameError");
                exit();
            }

            
            if (!$this->isValidUser($username)){
                header("Location: /register?userError");
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                header("Location: /register?emailError");
                exit();
            }
            
            
            
            if (!$this->isValidPassword($password1)){
                header("Location: /register?password1Error");
                exit();
            }
            
            if (!$this->isValidPassword($password2)){
                header("Location: /register?password2Error");
                exit();
            }
            
            if (!$this->isMatchPasswords($password1, $password2)){
                header("Location: /register?passwdUnMatchError");
                exit();
            }
            
            if (!$this->isStrongPassword($password1)){
                header("Location: /register?passwdInvalidError");
                exit();
            }

            
        

            $hasUser = $this->hasUser($username);
            
            if ($hasUser) {
                header("Location: /register?userInvalidError");
                exit();
            }
            
            
            $emails =UserModel::getField("email", $email, ["*"]);
            
            if (count($emails) > 0){
                header("Location: /register?emailExistsError");
                exit();
            }

            
            $sectors = array_column(SectorModel::getAll(), "sector_name");
            
            
            if (!in_array($sector, $sectors)){
                header("Location: /register?sectorInvalidError");
                exit();
            }
            


            
            $registerStatus = UserModel::registerUser($name, $username, $email, $password1, $sector);
    
    
            if ($registerStatus) {
                header("Location: /login");
                exit();
            }
    
            header("Location: /register?error");
    
            exit();
        }
    }


}

