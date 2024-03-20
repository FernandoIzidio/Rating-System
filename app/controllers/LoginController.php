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

        if ($status){
            print_r($status);
            exit();
        }


    }
    

}
