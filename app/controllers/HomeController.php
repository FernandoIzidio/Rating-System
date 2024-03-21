<?php 

namespace app\controllers;
use app\config\RootProject;
use Jenssegers\Blade\Blade;

require_once "../app/config/config.php";
require_once  RootProject::getRootPath()->controllers . "/BaseController.php";

class HomeController extends BaseController{
    


    public function getHome(){
        $this->redirectIfLogged();
        
        echo $this->getBlade()->render("logged");
    }
}