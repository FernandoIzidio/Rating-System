<?php

use app\config\RootProject;

function headContent(){


    echo /* html */ '
    <style>
        body {
            background-color: blue;
            color: white;
        }
    </style>

    ';
}


require_once "../app/config/config.php";

function mainContent() {
    
    
    require_once( RootProject::getRootPath()->views . "/global/partials/loginForm.php");
}


require_once  (RootProject::getRootPath()->views .  "/global/base.php");


?>