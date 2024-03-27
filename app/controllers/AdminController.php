<?php

namespace app\controllers;


class AdminController extends BaseController {

    protected function getView(){
        if (!$this->hasAdmin() || !$this->hasSession()){
            header("Location: /login");
            exit();
        }
        
        echo $this->getBlade()->render("admin");
    }

}