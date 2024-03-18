<?php 

$json_path = "../logs/logerrors.json";
$json_desc  = fopen($json_path, "r");

if (filesize($json_path) > 0){
    $json_content = json_decode(fread($json_desc, filesize($json_path)), true);
}
?>

<form action="" method="post" id="iForm">
        <input type="text" name="name" id="iName" placeholder="Nome"  minlength="-3" value="<?php if (array_key_exists("form", $_SESSION) && array_key_exists("name", $_SESSION["form"])): ?><?=  $_SESSION["form"]["name"] ?><?php endif; ?>">
        
        
        <?php if (array_key_exists("nameError", $_GET)): ?>
            <div class='alert'>
                <?= $json_content["FORM_ERRORS"]["NAME_ERROR"] ?>
            </div>
        
        <?php endif; ?>
        
        <input type="text" name="user" id="iUser" placeholder="Usuário"  minlength="-6" value="<?php if (array_key_exists("form", $_SESSION) && array_key_exists("user", $_SESSION["form"])): ?><?=  $_SESSION["form"]["user"] ?><?php endif; ?>">
        

        <?php if (array_key_exists("userInvalidError", $_GET)): ?>
            <div class='alert'>
                <?= $json_content["FORM_ERRORS"]["USER_EXISTS_ERROR"] ?>
            </div>
        <?php endif; ?>



        <?php if (array_key_exists("userError", $_GET)): ?>
            
            <div class='alert'>
                <?= $json_content["FORM_ERRORS"]["USER_CHR_ERROR"] ?>    
            </div>
        
        <?php endif; ?>


        <input type="password" name="password1" id="iPassword1" placeholder="Digite a senha"  minlength="-8" value="<?php if (array_key_exists("form", $_SESSION) && array_key_exists("password1", $_SESSION["form"])): ?><?=  $_SESSION["form"]["password1"] ?><?php endif; ?>">


        <?php if (array_key_exists("password1Error", $_GET)): ?>
            
            <div class='alert'>
                <?= $json_content["FORM_ERRORS"]["PASSWORD_CHR_ERROR"] ?>
            </div>

        <?php endif; ?>


        <input type="password" name="password2" id="iPassword2" placeholder="Repita a senha"  minlength="-8" value="<?php if (array_key_exists("form", $_SESSION) && array_key_exists("password2", $_SESSION["form"])): ?><?=  $_SESSION["form"]["password2"] ?><?php endif; ?>">

        
        <?php if (array_key_exists("passwd2Error", $_GET)): ?>
            
            <div class='alert'>
                <?= $json_content["FORM_ERRORS"]["PASSWORD_CHR_ERROR"] ?>
            </div>
        
        <?php endif; ?>



        <?php if (array_key_exists("passwdUnMatchError", $_GET)): ?>
            <div class='alert'>
                <?= $json_content["FORM_ERRORS"]["PASSWORD_UNMATCH_ERROR"] ?>
            </div>
        <?php endif; ?>



    

        <button id="iSubmit" type="submit">Registrar</button>   
        
</form>



<script src="../static/js/register.js"></script>