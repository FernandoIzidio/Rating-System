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
        $user = trim($_POST["user"]);
        $password = trim($_POST["password"]);

        if (!$this->hasUser($user)){
            header("Location: /login?loginError");
            exit();
        }
        
    

        $hash = UserModel::getHash($user)[0]['password'];
        
        $status = password_verify($password, $hash);

        if (!$status) {
            header("Location: /login?loginError");
            exit();
        };

    
        $_SESSION["logged_in"] = true;
        $_SESSION["user"] = $user;
        
        $userData = UserModel::getField("user", $user, ["id_worker", "rating_permission", "admin_permission", "super_admin"])[0];


        $_SESSION["user_id"] = $userData["id_worker"];

        $_SESSION["rating_permission"] =  $userData["rating_permission"];

    
        $_SESSION["admin_permission"] = $userData["admin_permission"];

        $_SESSION["super_admin"] = $userData["super_admin"];

        

        $_SESION["last_login"] = time();

    
        
        header("location: /dashboard");
        exit();     

    }
    
}
