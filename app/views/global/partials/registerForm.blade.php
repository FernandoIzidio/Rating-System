<form action="/register" method="post" id="iForm">
        <input type="text" name="name" id="iName" placeholder="Nome"  minlength="-3">
        
        
        <?php if (array_key_exists("nameError", $_GET)): ?>
            <div class='alert'>
                {{ $data["FORM_ERRORS"]["NAME_ERROR"] }} 
            </div>
        
        <?php endif; ?>
        
        <input type="text" name="user" id="iUser" placeholder="Usuário"  minlength="-6">
        

        <?php if (array_key_exists("userInvalidError", $_GET)): ?>
            <div class='alert'>
                {{ $data["FORM_ERRORS"]["USER_EXISTS_ERROR"] }} 
            </div>
        <?php endif; ?>



        <?php if (array_key_exists("userError", $_GET)): ?>
            
            <div class='alert'>
                {{ $data["FORM_ERRORS"]["USER_CHR_ERROR"] }}    
            </div>
        
        <?php endif; ?>


        <input type="email" name="user" id="iUser" placeholder="Usuário"  minlength="-6">
        

        <?php if (array_key_exists("emailInvalidError", $_GET)): ?>
            <div class='alert'>
                {{ $data["FORM_ERRORS"]["EMAIL_EXISTS_ERROR"] }} 
            </div>
        <?php endif; ?>





        <input type="password" name="password1" id="iPassword1" placeholder="Digite a senha"  minlength="-8">


        <?php if (array_key_exists("password1Error", $_GET)): ?>
            
            <div class='alert'>
                {{ $data["FORM_ERRORS"]["PASSWORD_CHR_ERROR"] }} 
            </div>

        <?php endif; ?>


        <input type="password" name="password2" id="iPassword2" placeholder="Repita a senha"  minlength="-8">

        
        <?php if (array_key_exists("password2Error", $_GET)): ?>
            
            <div class='alert'>
                {{ $data["FORM_ERRORS"]["PASSWORD_CHR_ERROR"] }} 
            </div>
        
        <?php endif; ?>


        <label for="setor">Escolha seu setor de atuação:</label>
        
        <select name="sector" id="setor">
            <option value="Recursos Humanos">Recursos Humanos</option>
            <option value="Administração">Administração</option>
            <option value="Marketing">Marketing</option>
            <option value="Financeiro">Financeiro</option>
            <option value="Produção">Produção</option>
            <option value="Tecnologia">Tecnologia</option>
            <option value="Vendas">Vendas</option>
        </select>

        
        <?php if (array_key_exists("passwdUnMatchError", $_GET)): ?>
            <div class='alert'>
                {{ $data["FORM_ERRORS"]["PASSWORD_UNMATCH_ERROR"] }}
            </div>
        <?php endif; ?>

        
        <?php if (array_key_exists("passwdInvalidError", $_GET)): ?>
            <div class='alert'>
                {{ $data["FORM_ERRORS"]["PASSWORD_STRONG_ERROR"] }} 
            </div>
        <?php endif; ?>

        <button id="iSubmit" type="submit">Registrar</button>   
        
</form>



<script src="/static/js/register.js"></script>