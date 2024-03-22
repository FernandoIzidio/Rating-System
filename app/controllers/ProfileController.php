<?php 

namespace app\controllers;

require_once "../app/controllers/BaseController.php";

class ProfileController extends BaseController {
    public function getProfile(){
        if (!$this->hasSession()){
            header("Location: /login");
            exit();
        }
        
        echo $this->getBlade()->render("dashboard.profile");
        
    }

}