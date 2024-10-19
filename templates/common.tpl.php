<?php declare(strict_types = 1);
require_once('product.tpl.php') ?>


<?php function drawHeader() { ?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title> Trinted </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <script src="../javascript/buttons.js" defer></script>

    </head>
    <body>
        <header>
            <a href="../index.php"> <img src="/resources/logos/logo.png" width="60"></a>
            <div class="spacer"></div> <!-- Empty div for spacing -->
            
            <!-- just for the hamburguer menu in responsive layout -->
            <input type="checkbox" id="toggle" />
            <label for="toggle" class="hamburger-menu">
                <div class="hamburger-icon">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </label>
            <div class="Category_Menu">                
                <div class="Category_Menu_Option" id="Moda"> <a href="categoryPage.php?name=Moda"> <span>Moda</span></a> </div>
                <div class="Category_Menu_Option" id="Tecnologia"> <a href="categoryPage.php?name=Tecnologia"> <span>Tecnologia</span></a> </div>
                <div class="Category_Menu_Option" id="Casa"> <a href="categoryPage.php?name=Casa"> <span>Casa</span></a> </div>
                <div class="Category_Menu_Option" id="Automóveis"> <a href="categoryPage.php?name=Automóveis"> <span>Automóveis</span></a> </div>
                <div class="Category_Menu_Option" id="Geral"> <a href="categoryPage.php?name=Geral"> <span>Geral</span></a> </div>
            </div>
            <?php             
            if (isset($_SESSION['id'])) {
                $profileURL= "sellerPage.php?id=".$_SESSION['id'];
            }else $profileURL= "loginPage.php";
            ?>
            <div class="Secundary_Menu_Option" id="Cart"> <?php drawProductSearch() ?></div>
            <div  id="Search_Logo"><img src="/resources/logos/search.svg"></div>
            <!--div class="Secondary_Menu" --> 
                <div class="Secundary_Menu_Option" id="Profile"> <a href="<?=$profileURL?>"><img src="/resources/logos/profile.svg" width="20" ></a></div>
                <div class="Secundary_Menu_Option" id="Favorites"> <a href="favoritesPage.php"><img src="/resources/logos/favorite.svg" width="20"></a></div>
                <div class="Secundary_Menu_Option" id="Shopping_Cart"> <a href="listPage.php"><img src="/resources/logos/bag.svg" width="20"></a></div>
            <!--/div-->
            <?php 
            if(isset($_SESSION['id'])){
                drawUserIn($_SESSION['id'], $_SESSION['name'], $_SESSION['photo'] );
            }
            ?>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    function toggleProfileDisplay() {
                        var profileElement = document.getElementById('Profile');
                        if (window.innerWidth <= 768 && <?= isset($_SESSION['id']) ? 'true' : 'false' ?>) {
                            profileElement.style.display = 'none';
                        } else {
                            profileElement.style.display = 'block';
                        }
                    }

                    // Initial check
                    toggleProfileDisplay();

                    // Listen for window resize events
                    window.addEventListener('resize', toggleProfileDisplay);
                });
            </script>
        </header>
        <main>
            <?php } ?>
            
            <?php function drawFooter() { ?>
            </main>
            <footer>LTW Trinted © 2024</footer>
            <script src="../javascript/search.js" defer></script>
        </body>
        </html>
        <?php } 

function drawMessages(Session $session) { ?>
    <section id="messages">
    <?php foreach ($session->getMessages() as $message) { ?>
        <article class="<?=$message['type']?>">
        <i class='fas fa-exclamation-circle'></i>
        <?=$message['text']?>
        </article>
    <?php } ?> </section> 
<?php 
}

function drawUserIn(int $id, string $name, string $photo) { ?>
<section id="user">
    <a href="../sellerPage.php?id=<?=$id?>"> <img src="<?=$photo?>" alt="user photo" id="profile" height="60px"></a>
    <div class="Username-Logout"> 
        <a href="../sellerPage.php?id=<?=$id?>"><h3 class="userItem"> <?=$name?> </h3></a>
        <h3 id="logout"> <a href="../actions/logoutUser.action.php"> Logout </a></h3>
    </div>
</section>
<?php


}