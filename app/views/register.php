<?php

use app\config\RootProject;

function headContent() {
    echo /* html */ '
    <link rel="stylesheet" href="/static/css/forms.css">
    ';
}

require_once "../app/config/config.php";

function mainContent(){
    require_once  RootProject::getRootPath()->views . "/global/partials/registerForm.php";
}


require_once RootProject::getRootPath()->views . "/global/base.php";

