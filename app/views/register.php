<?php


function headContent() {
    echo /* html */ '
    <link rel="stylesheet" href="../static/css/forms.css">
    ';
}


function mainContent(){
    include "../app/views/global/partials/registerForm.php";
}


include "../app/views/global/base.php";

