<?php

namespace app\controllers;



require_once "../app/controllers/BaseController.php";

class RequestsController extends BaseController {

    public function getRequests(){
        if (!$this->hasAdmin() || !$this->hasSession()){
            header("Location: /login");
            exit();
        }
        
        

        echo $this->getBlade()->render("Dashboard.requests");
    }

}