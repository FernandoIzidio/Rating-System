<?php 

namespace app\controllers;

use app\database\config\Connection;
use app\models\ModelUser;

require_once "../app/controllers/BaseController.php";
class LoginController extends BaseLogin{

    public function getLogin(){

    }

    public function postLogin(){
        require_once "../app/models/User.php";
        require_once "../app/database/config/connection.php";

        Connection::configureConnection();

        Connection::getConnection();

        // $user = new ModelUser();

    }
    

}
