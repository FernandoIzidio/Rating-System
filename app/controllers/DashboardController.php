<?php 

namespace app\controllers;


require_once  "../app/controllers/BaseController.php";

class DashboardController extends BaseController{
    public function getDashboard(){
        if (!$this->hasSession()){
            header("Location: login");
        }
        
        echo $this->getBlade()->render("Dashboard.dashboard");
    }

}