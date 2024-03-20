<?php

namespace app\controllers;

require_once '../app/controllers/BaseController.php';

class RootController extends BaseController{
    public function getRoot(){
        $this->hasLogin();

        include '../app/views/home.php';
    }


}