<?php

namespace app\controllers;

use app\database\config\Connection;
use app\models\ModelUser;

require_once "../app/controllers/BaseController.php";


class RegisterController extends BaseRegister {
    public function getRegister(){
        if ($this->hasSession()){
            header("Location: /dashboard");
            exit();
        }

        echo $this->getBlade()->make("register", ['data' => $this->getLogs()])->render();
    }


    public function postRegister(){
                
    if (!empty($_POST)){

        $this->validName($_POST["name"]);

        $this->validLengthUser($_POST["user"]);

        for ($i=1; $i < 3; $i++) { 
            $this->validLenghtPasswords($_POST["password{$i}"], $i);
        }
        
        $this->validMatchPasswords($_POST["password1"], $_POST["password2"]);


        $this->validStrongPasswords($_POST["password1"]);

        $statusUser = $this->hasUser($_POST["user"]);

        if ($statusUser) {
            header("Location: /register?userInvalidError");
            exit();
        }


        require_once  "../app/database/config/connection.php";
        require_once "../app/models/User.php";

        $pdo = Connection::getConnection();

        $userModel = new ModelUser($pdo);
        

        $hash = password_hash($password, PASSWORD_DEFAULT);
    
    
        $idSector = $userModel->getField("sectors", ["id_sector"],  "sector_name", $sector)["id_sector"];
    
    
        $query = $userModel->getSecureQuery("INSERT INTO workers(name, user, password, id_sector) VALUES (:name, :user, :password, :id_sector)", [":name"=> $name, ":user" => $username,":password" => $hash,":id_sector" => $idSector]);
        
        $status = $query->execute();
    
         
        
        
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

