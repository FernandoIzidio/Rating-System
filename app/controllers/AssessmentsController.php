<?php

namespace app\controllers;



require_once "../app/controllers/BaseController.php";

class AssessmentsController extends BaseController {

    public function getAssessments(){
        if (!$this->hasSession()){
            header("Location: /login");
            exit();
        }
        
        

        echo $this->getBlade()->render("dashboard.assessment");
    }

}