<?php 
session_start();

function headContent(){
    
}



function mainContent() {
    echo "OI OI";
}


require ("../templates/base.php");


if (array_key_exists("LOGGED", $_SESSION) && $_SESSION["LOGGED"] == true){
    header("Location: ./logged.php");
}
?>