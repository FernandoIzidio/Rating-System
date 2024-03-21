<?php 

namespace app\controllers;


use app\config\RootProject;
use app\database\config\Connection;
use app\models\ModelUser;
use Jenssegers\Blade\Blade;

require_once "../app/config/config.php";

require_once  RootProject::getRootPath()->controllers . "/BaseController.php";
class LoginController extends BaseLogin{

    public function getLogin(){
    
        echo $this->getBlade()->make("login", ['data' => $this->getLogs()])->render();

    }

    public function postLogin(){
        $this->validUser();
        
        require_once  self::getRootPath()->models . "/User.php";
        require_once  self::getRootPath()->connection . "/connection.php";

    
        $pdo  = Connection::getConnection();

        $user = new ModelUser($pdo);

        $status = $user->loginUser(trim($_POST['user']), trim($_POST["password"]));
        

        if (!$status) {
            header("Location: login?loginError");
            exit();
        };

    
        $_SESSION["logged_in"] = true;
        $_SESSION["user"] = $_POST["user"];
        
        $userData = $user->getField("workers", ["id_worker", "rating_permission", "admin_permission", "super_admin"], "user", $_POST["user"]);


        $_SESSION["user_id"] = $userData["id_worker"];

        $_SESSION["rating_permission"] =  $userData["rating_permission"];

    
        $_SESSION["admin_permission"] = $userData["admin_permission"];

        $_SESSION["super_admin"] = $userData["super_admin"];

        

        $_SESION["last_login"] = time();

    
        
        header("location: /home");
        exit();     

    }
    

}
