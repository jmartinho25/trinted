<?php declare(strict_types = 1); ?>

<?php function drawUserEdit(int $id) { ?>
<form class="Login_Form" action='../actions/editUser.action.php?id=<?=$id?>' method='post'>   
    
                <div class="Form_Section">
                    <label>Nome de utilizador
                        <input type="text" name="userName" required="required" value="<?=htmlentities($_SESSION['input']['userName oldUser'])?>">
                    </label>
                </div> 
                <div class="Form_Section">
                    <label>Email
                        <input  type="email" name="email" required="required" value="<?=htmlentities($_SESSION['input']['email oldUser'])?>">
                    </label>
                </div>    
                <div class="Form_Section">
                    <label>Password antiga
                        <input  type="password" name="password1">
                    </label>
                </div> 
                <div class="Form_Section">
                    <label>Password Nova
                        <input type="password" name="password2">
                    </label>
                </div> 
                <div class="Form_Section">
                    <label>Primeiro nome
                        <input type="text" name="firstName" required="required"  value="<?=htmlentities($_SESSION['input']['firstName oldUser'])?>">
                    </label>
                </div> 
                <div class="Form_Section">
                    <label>Último nome
                        <input type="text" name="lastName" required="required" value="<?=htmlentities($_SESSION['input']['lastName oldUser'])?>">
                    </label>
                </div>
                <div class="Form_Section">
                    <label>Morada
                        <input type="text" name="userAddress" required="required" value="<?=htmlentities($_SESSION['input']['userAddress oldUser'])?>">
                    </label>
                </div>
                <div class="Form_Section">
                    <label>Telemóvel
                        <input type="text" name="phone" required="required" value="<?=htmlentities($_SESSION['input']['phone oldUser'])?>">
                    </label>
                </div>
                <input type="text" name="id" value="<?=$id?>" hidden>
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <input type="submit" value="Register" class="Submit_Button">
            </form>
            <form class="Picture_Input" action="../actions/userPhoto.action.php?id=<?=$id?>" method="post" enctype="multipart/form-data">
                <div class="Photo_Section">
                    <label>Foto de perfil: <input id="Img_Input" type="file" name="image"></label>
                </div>
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <input class="Submit_Button" type="submit" value="Atualizar">
            </form>
<?php } ?>     