<?php

use app\controllers\BaseController;


require_once "../app/controllers/BaseController.php";

class AdminController extends BaseController {

    public function getAdmin(){
        if (!$this->hasAdmin() || !$this->hasSession()){
            header("Location: /login");
            exit();
        }
        
        

        echo $this->getBlade()->render("admin");
    }

}