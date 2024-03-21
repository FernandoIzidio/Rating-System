<?php

namespace app\controllers;

use app\config\RootProject;
use app\database\config\Connection;
use app\models\ModelUser;
use Jenssegers\Blade\Blade;

require_once "../app/config/config.php";

require_once RootProject::getRootPath()->controllers . "/BaseController.php";


class RegisterController extends BaseRegister {
    public function getRegister(){
        $this->hasLogin();

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
            header("Location: register?userInvalidError");
            exit();
        }


        require_once  self::getRootPath()->connection . "/connection.php";
        require_once self::getRootPath()->models . "/User.php";

        $pdo = Connection::getConnection();

        $userModel = new ModelUser($pdo);
        
        $registerStatus = $userModel->registerUser(trim($_POST["name"]), trim($_POST["user"]), trim($_POST["password1"]), trim($_POST["sector"]));


        if ($registerStatus) {
            header("Location: login");
            exit();
        }

        header("Location: register?error");

        exit();
    }
}
}

