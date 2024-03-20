<?php

namespace app\controllers;

class RootController{
    public function getRoot(){
        include '../app/views/home.php';
    }


}