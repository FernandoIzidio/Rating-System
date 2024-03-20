<?php 

namespace app\controllers;

require_once '../app/controllers/BaseController.php';

class ProfileController extends BaseController {

    public function getProfile(){
        $this->isvalidSession();

        require_once ("../app/views/profile.php");
    }

}