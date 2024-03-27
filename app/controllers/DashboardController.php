<?php 

namespace app\controllers;


class DashboardController extends BaseController{
    public function getView(){
        if (!$this->hasSession()){
            header("Location: /login");
            exit();
        } else if ($this->hasAdmin()){
            header("Location: /admin");
            exit();
        }
        
        
        echo $this->getBlade()->render("Dashboard.dashboard");
    }

}