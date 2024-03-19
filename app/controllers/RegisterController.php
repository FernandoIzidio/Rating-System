<?php

namespace app\controllers;

use app\database\config\Connection;
use app\models\ModelUser;

require "../app/controllers/BaseController.php";

class RegisterController extends BaseRegister {
    public function getRegister(){

        include "../app/views/register.php";
    }





    public function postRegister(){
            
    if (!empty($_POST)){

        $this->validName();

        $this->validLengthUser();

        for ($i=1; $i < 3; $i++) { 
            $this->validLenghtPasswords("password{$i}", $i);
        }
        
        $this->validMatchPasswords();


        $this->validStrongPasswords();

        $statusUser = $this->hasUser();

        if ($statusUser) {
            header("Location: register?userInvalidError");
            exit();
        }


        require_once "../app/database/config/connection.php";
        require_once "../app/models/User.php";

        Connection::configureConnection();

        $pdo = Connection::getConnection();

        $userModel = new ModelUser($pdo);
        
        $registerStatus = $userModel->registerUser($_POST["name"], $_POST["user"], password_hash($_POST["password1"], PASSWORD_DEFAULT), $_POST["sector"]);


        if ($registerStatus) {
            header("Location: login");
            exit();
        }

        header("Location: register?error");

        exit();
    }
}
}

