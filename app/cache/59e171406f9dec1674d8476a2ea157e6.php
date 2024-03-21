<h1>Bem vindo a página de formulário</h1>

<form action="/login" method="post">
    
    <input type="text" name="user" id="iUser" placeholder="Nome de usuário">

    <input type="password" name="password" id="iPassword" placeholder="Senha">
    
    <?php if (array_key_exists("loginError", $_GET)):?>
        <div class='alert'>
            <?php echo e($data["FORM_ERRORS"]["LOGIN_ERROR"]); ?>

        </div>
    <?php endif;?>

    <button type="submit">Login</button>

    

</form><?php /**PATH /var/www/rating_system/app/views/global/partials/loginForm.blade.php ENDPATH**/ ?>