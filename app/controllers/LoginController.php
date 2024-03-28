<?php 

namespace app\controllers;
use app\models\UserModel;

require_once "../app/config/loader.php";


class LoginController extends BaseLogin{
    public function getView(){
        if ($this->hasSession()){
            header("Location: /dashboard");
            exit();
        }

        echo $this->getBlade()->make("login", ['data' => $this->getLogs()])->render();

    }


    public function postView(){
        $this->validUser();
        
    

        $hash = UserModel::getHash(trim($_POST['user']))[0]['password'];
        
        $status = password_verify($_POST["password"], $hash);

        if (!$status) {
            header("Location: /login?loginError");
            exit();
        };

    
        $_SESSION["logged_in"] = true;
        $_SESSION["user"] = $_POST["user"];
        
        $userData = UserModel::getField("user", $_POST["user"], ["id_worker", "rating_permission", "admin_permission", "super_admin"])[0];


        $_SESSION["user_id"] = $userData["id_worker"];

        $_SESSION["rating_permission"] =  $userData["rating_permission"];

    
        $_SESSION["admin_permission"] = $userData["admin_permission"];

        $_SESSION["super_admin"] = $userData["super_admin"];

        

        $_SESION["last_login"] = time();

    
        
        header("location: /dashboard");
        exit();     

    }
    
}
