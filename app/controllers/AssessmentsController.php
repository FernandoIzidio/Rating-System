<?php

namespace app\controllers;

class AssessmentsController extends BaseController {

    public function getView(){
        if (!$this->hasSession()){
            header("Location: /login");
            exit();
        }
        
        

        echo $this->getBlade()->render("Dashboard.assessment");
    }

}