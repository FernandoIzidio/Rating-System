<?php
session_start();
require_once("../database/config/connection.php");

if (!empty($_POST)){

    if (strlen($_POST["name"] < 3)){
        header("Location: " . $_SERVER['PHP_SELF'] . "?nameError");
        exit();
    }
    
    
    $_SESSION["form"] = [
        "name"=> $_POST["name"],
    ];


    if (strlen($_POST["user"]) < 6){
        header("Location: " . $_SERVER['PHP_SELF'] . "?userError");
        exit();
    }

    $_SESSION["form"]["user"] = $_POST["user"];

   
    

    if (strlen($_POST["password1"]) < 8){
        header("Location: " . $_SERVER['PHP_SELF'] . "?passwd1Error");
        exit();
    }

    $_SESSION["form"]["password1"] = $_POST["password1"];

    

    if (strlen($_POST["password2"]) < 8){
        header("Location: " . $_SERVER['PHP_SELF'] . "?passwd2Error");
        exit();
    }

    $_SESSION["form"]["password2"] = $_POST["password2"];
   
    if ($_POST["password1"] !== $_POST["password2"]){
        header("Location: " . $_SERVER['PHP_SELF'] . "?passwdUnMatchError");        
        exit();
    }


    $query = $pdo->prepare("SELECT fc.user FROM workers as fc where fc.login = :login");

    $query->bindValue(":login", $_POST["user"]);

    $query->execute();

    $dados = $query->fetchAll(PDO::FETCH_ASSOC);

    if (count($dados) > 0){

        header("Locaiton: " . $_SERVER['PHP_SELF'] . "?userInvalidError");
        exit();
    }


    $query = $pdo->prepare("INSERT INTO workers(name, user, password, id_manager) VALUES (:nome, :login, :senha, :id_gerente)");

    $hash = password_hash($_POST["password1"], PASSWORD_DEFAULT);

    $query->bindValue(":nome", $_POST['name']);
    $query->bindValue(":login", $_POST['user']);
    $query->bindValue(":senha", $hash);
    $query->bindValue(":id_gerente", 1);

    $status = $query->execute();

    if ($status) {
        header("Location: ./login.php" );
    } else {
        header("Location: " . $_SERVER["PHP_SELF"] . "?Error");
    }
}





// Render Templates
function headContent(){
    echo /* html */ '
    <link rel="stylesheet" href="../static/css/forms.css">
    ';
}


function mainContent() {
    include('../templates/partials/registerForm.php');
}


require_once ("../templates/base.php");



?>
