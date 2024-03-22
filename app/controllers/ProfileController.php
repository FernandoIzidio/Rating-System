<?php 

namespace app\controllers;

require_once "../app/controllers/BaseController.php";

class ProfileController extends BaseController {
    public function getProfile(){
        if (!$this->hasSession()){
            header("Location: login");
        }
        
        echo $this->getBlade()->render("Dashboard.profile");
        
    }

}