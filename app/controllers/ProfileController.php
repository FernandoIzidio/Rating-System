<?php 

namespace app\controllers;
use app\config\RootProject;


require_once "../app/config/config.php";

require_once RootProject::getRootPath()->controllers . "/BaseController.php";

class ProfileController extends BaseController {

    public function getProfile(){
        $this->isvalidSession();

        require_once self::getRootPath()->views . "/profile.php";
    }

}