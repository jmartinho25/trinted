<?php declare(strict_types = 1); ?>

<?php function drawLogin() { ?>
    <form class="Login_Form" action="../actions/loginUser.action.php" method= "post">   
                <header>
                    <a href="loginPage.php">Login</a>
                    <a href="registerPage.php">Register</a>
                </header>
                <div class="Form_Section">
                    <label>Email
                    <input type="email" name="email" value="<?=htmlentities($_SESSION['input']['email login'])?>">
                    </label>
                </div>    
                <div class="Form_Section">
                    <label>Password
                    <input type="password" name="password" value="<?=htmlentities($_SESSION['input']['password login'])?>">
                    </label>
                </div> 
                <input type="submit" value="Login" class="Submit_Button">
            </form>
<?php } ?>