<?php

namespace app\controllers;



require_once "../app/controllers/BaseController.php";

class AssessmentsController extends BaseController {

    public function getAssessments(){
        if (!$this->hasAdmin() || !$this->hasSession()){
            header("Location: /login");
            exit();
        }
        
        

        echo $this->getBlade()->render("Dashboard.assessment");
    }

}