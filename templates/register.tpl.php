<?php declare(strict_types = 1); ?>

<?php function drawRegister() { ?>
<form class="Login_Form" action='../actions/addUser.action.php' method='post'>   
    
                <header class="Register_Form">
                    <a href="loginPage.php">Login</a>
                    <a href="registerPage.php">Register</a>
                </header>
                <div class="Form_Section">
                    <label>Nome de utilizador
                        <input type="text" name="userName" required="required" value="<?=htmlentities($_SESSION['input']['userName newUser'])?>">
                    </label>
                </div> 
                <div class="Form_Section">
                    <label>Email
                        <input  type="email" name="email" required="required" value="<?=htmlentities($_SESSION['input']['email newUser'])?>">
                    </label>
                </div>    
                <div class="Form_Section">
                    <label>Password
                        <input  type="password" name="password1" required="required" value="<?=htmlentities($_SESSION['input']['password1 newUser'])?>">
                    </label>
                </div> 
                <div class="Form_Section">
                    <label>Confirme Password
                        <input type="password" name="password2"required="required" value="<?=htmlentities($_SESSION['input']['password2 newUser'])?>">
                    </label>
                </div> 
                <div class="Form_Section">
                    <label>Primeiro nome
                        <input type="text" name="firstName" required="required"  value="<?=htmlentities($_SESSION['input']['firstName newUser'])?>">
                    </label>
                </div> 
                <div class="Form_Section">
                    <label>Último nome
                        <input type="text" name="lastName" required="required" value="<?=htmlentities($_SESSION['input']['lastName newUser'])?>">
                    </label>
                </div>
                <div class="Form_Section">
                    <label>Morada
                        <input type="text" name="userAddress" required="required" value="<?=htmlentities($_SESSION['input']['userAddress newUser'])?>">
                    </label>
                </div>
                <div class="Form_Section">
                    <label>Telemóvel
                        <input type="text" name="phone" required="required" value="<?=htmlentities($_SESSION['input']['phone newUser'])?>">
                    </label>
                </div>
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <input type="submit" value="Registar" class="Submit_Button">
            </form>
<?php } ?>            