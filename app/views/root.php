<?php

use app\config\RootProject;

function headContent(){
    
}

function mainContent() {
    echo /* html */"
        <h1>Hello from Index</h1>
    ";
}

require_once "../app/config/config.php";

require_once RootProject::getRootPath()->views . "/global/base.php";