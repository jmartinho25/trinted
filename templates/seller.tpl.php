<?php
declare(strict_types = 1); 
require_once('classes/user.class.php');
require_once('database/connection.db.php');
require_once('classes/product.class.php');
require_once('templates/common.tpl.php');
require_once('templates/product.tpl.php');
require_once('templates/seller.tpl.php');
require_once('classes/session.class.php');


function drawSellerInfo(User $user) { ?>
    <div class='Seller_Section'>
        <div class='Seller_Picture_Name'>
            <img id="Seller_Img"src="<?=htmlentities($user->getPhoto($user->id))?>" alt="foto de utilizador" width='200'>
            <div class='Names'>
                <h1><?=$user->firstName.' '.$user->lastName?></h1>
                <h2><?=$user->userName?></h2>
                <span><?=$user->address?></span>
            </div>
        </div>
        <div class='Sales_Info'>
                <span id="Seller_Rating"> Classificação: <?= $user->rating?>/10</span>
        </div>
    </div> <?php
} 

function drawSeller(int $id) { 
    $db=getDatabaseConnection();
    $seller=User::getUser($db,$id);
    drawSellerInfo($seller);
    $products=Product::getProductsBySellerId($db, $id);
    drawRecommended($products, "Produtos");
    $sold=Product::getSoldProducts($db, $id);//Comprados
    $sold2=Product::getSoldProducts2($db, $id);//Vendidos
    if(isset($_SESSION['id'])){
        $admin=User::getUser($db, $_SESSION['id']);
        if($_SESSION['id']==$id||$admin->userType==1){
            if(count($sold)!=0){
                if($_SESSION['id']==$id){
                    drawRecommended3($sold, "Comprados", $seller);
                }else {
                    drawRecommended2($sold, "Comprados", $seller);
                }
            }
            if(count($sold2)!=0){
                drawRecommended2($sold2, "Vendidos", $seller);
            }
            if($admin->userType==1 && $id!=$_SESSION['id']){
                drawEdits3($id,$seller);
            }
            }
            if(isset($_SESSION['id'])&&$_SESSION['id']==$id)
                drawEdits2($id,$admin);
    }
    
}

function drawEdits3(int $id, User $seller) { ?>
    <div class="Edit_Buttons">
    <?php if($seller->userType==0) { ?>
        <div class="Edit_Buttons">
        <section id="editUser">
        <button id="Edit_Button" onclick="addAdmin(<?=$id?>)">Promover a Admin</button>
        </section> 
        </div>
    <?php } else {?>
        <div class="Edit_Buttons">
        <section id="editUser">
        <button id="Edit_Button" onclick="removeAdmin(<?=$id?>)">Remover de Admin</button>
        </section> 
        </div>
    <?php }?>
    </div>
  <?php 
  }

function drawEdits2(int $id, User $admin) { ?>
  <div class="Edit_Buttons">
  <section id="editRestaurant">
      <a href="../newProductPage.php"><button id="Edit_Button">Adicionar produto</button></a>
  </section> 
  <section id="editUser">
      <a href="../editUserPage.php?id=<?=$id?>"><button id="Edit_Button">Editar perfil</button></a>
  </section> 
  <?php if($admin->userType==1) { ?>
  <section id="editUser">
      <button id="Edit_Button" onclick="addCategory()">Adicionar Categoria</button>
  </section> 
  <section id="editUser">
      <button id="Edit_Button" onclick="addCondition()">Adicionar Condição</button>
  </section> 
  <?php }?>
</div>
<?php 
}
?>