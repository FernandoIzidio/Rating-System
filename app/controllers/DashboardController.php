<?php 

namespace app\controllers;


require_once  "../app/controllers/BaseController.php";

class DashboardController extends BaseController{
    public function getDashboard(){
        if (!$this->hasSession()){
            header("Location: /login");
            exit();
        } else if ($this->hasAdmin()){
            header("Location: /admin");
            exit();
        }
        
        
        echo $this->getBlade()->render("dashboard.dashboard");
    }

}