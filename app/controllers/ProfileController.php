<?php 

namespace app\controllers;
use app\config\RootProject;
use Jenssegers\Blade\Blade;

require_once "../app/config/config.php";

require_once RootProject::getRootPath()->controllers . "/BaseController.php";

class ProfileController extends BaseController {

    public function getProfile(){
        $this->isvalidSession();
        
        echo $this->getBlade()->render("profile");
    }

}