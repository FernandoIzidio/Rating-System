<?php 

namespace app\controllers;
require_once '../app/controllers/BaseController.php';

class HomeController extends BaseController{
    


    public function getHome(){
        $this->isvalidSession();
        include "../app/views/logged.php";
    }
}