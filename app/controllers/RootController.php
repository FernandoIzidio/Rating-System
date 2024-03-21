<?php

namespace app\controllers;
use app\config\RootProject;

require_once "../app/config/config.php";

require_once RootProject::getRootPath()->controllers . "/BaseController.php";
class RootController extends BaseController{
    public function getRoot(){
        $this->hasLogin();

        require_once self::getRootPath()->views . '/root.php';
    }


}