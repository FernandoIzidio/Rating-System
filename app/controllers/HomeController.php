<?php 

namespace app\controllers;
use app\config\RootProject;
use Jenssegers\Blade\Blade;

require_once "../app/config/config.php";
require_once  RootProject::getRootPath()->controllers . "/BaseController.php";

class HomeController extends BaseController{
    


    public function getHome(){
        $this->isvalidSession();
        
        /** @var Blade $blade */
        $blade = require_once "../app/config/blade.php";

        
        echo $blade->render("logged");
    }
}