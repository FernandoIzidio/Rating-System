<?php

use app\controllers\BaseController;


require_once "../app/controllers/BaseController.php";

class AdminController extends BaseController {

    public function getAdmin(){
        if (!$this->hasAdmin()){
            header("Location: /");
        }
        
        

        echo $this->getBlade()->render("admin");
    }

}