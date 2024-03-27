<?php 

namespace app\controllers;

class ProfileController extends BaseController {
    public function getView(){
        if (!$this->hasSession()){
            header("Location: /login");
            exit();
        }
        
        echo $this->getBlade()->render("Dashboard.profile");
        
    }

}