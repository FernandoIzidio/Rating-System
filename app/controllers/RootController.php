<?php

namespace app\controllers;
use app\config\RootProject;
use Jenssegers\Blade\Blade;

require_once  "../app/config/config.php";


require_once RootProject::getRootPath()->controllers . "/BaseController.php";
class RootController extends BaseController{
    public function getRoot(){
        $this->redirectIfLogged();
        echo $this->getBlade()->render("root");
    }


}