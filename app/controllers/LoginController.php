<?php 

namespace app\controllers;

use app\database\config\Connection;
use app\models\ModelUser;

require_once "../app/controllers/BaseController.php";
class LoginController extends BaseLogin{

    public function getLogin(){
        require_once "../app/views/login.php";
    }

    public function postLogin(){
        $this->validUser();
        
        require_once "../app/models/User.php";
        require_once "../app/database/config/connection.php";

        Connection::configureConnection();

        

        $pdo  = Connection::getConnection();

        $user = new ModelUser($pdo);

        $status = $user->loginUser(trim($_POST['user']), trim($_POST["password"]));
        
        if (!$status) header("Location: login?loginError");


    
        $_SESSION["logged_in"] = true;
        $_SESSION["user"] = $_POST["user"];
        
        $userData = $user->getField("workers", ["id_worker", "rating_permission", "admin_permission"], "user", $_POST["user"]);

        print_r($userData);

        echo "<br>";

        $_SESSION["user_id"] = $userData["id_worker"];

        $_SESSION["rating_permission"] =  $userData["rating_permission"];

    
        $_SESSION["admin_permission"] = $userData["admin_permission"];

        

        $_SESION["last_login"] = time();

        
        print_r($_SESSION);
        
        header("location: /home");
        exit();     

    }
    

}
