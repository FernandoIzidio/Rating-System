<?php

use app\config\RootProject;
use app\controllers\BaseController;

require_once("../app/config/config.php");
require_once RootProject::getRootPath()->controllers . "/BaseController.php";

class AdminController extends BaseController {

    public function getAdmin(){
        $this->redirectIfnotAdmin();
    }

}