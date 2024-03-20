<?php 

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



function mainContent() {
    require_once("../app/views/global/partials/loginForm.php");
}


require_once ("../app/views/global/base.php");


?>