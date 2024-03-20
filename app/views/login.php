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
    echo /* html */ '

    <h1>Bem vindo a página de formulário</h1>

    <form action="/login" method="post">
        <input type="text" name="user" id="iUser" placeholder="Nome de usuário">

        <input type="text" name="password" id="iPassword" placeholder="Senha">
        <button type="submit">Login</button>
    </form>
    ';
}


require_once ("../app/views/global/base.php");


?>