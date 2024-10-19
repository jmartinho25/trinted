<?php declare(strict_types = 1); 
require_once('classes/product.class.php');
require_once('database/connection.db.php');
require_once('classes/user.class.php');


function drawRecommended(array $recommended, string $name) { ?>
    <section class="Recomended_Section">
        <h1 id="Recomended"><?= $name ?> </h1>
        <div>
            <?php foreach ($recommended as $product) { ?>
                <a class="Recomended_Product" href="productPage.php?id=<?=$product->id?>">
                    <img src="<?= $product->getPhoto($product->id)?>" height="200"  >
                    <div class="Product_Details">
                        <h1><?=$product->name?></h1>
                        <span class="Price"> <?=$product->price?>&#128;</span>
                    </div>
                </a>
            <?php } ?>
        </div>
    </section>
<?php }    

function drawRecommended2(array $recommended, string $name, User $user) { ?>
    <section class="Recomended_Section">
        <h1 id="Recomended"><?= $name ?> </h1>
        <div>
            <?php foreach ($recommended as $product) { ?>
                <a class="Recomended_Product" href="productPage.php?id=<?=$product->id?>">
                    <img src="<?= $product->getPhoto($product->id)?>" height="200"  >
                    <div class="Product_Details">
                        <h1><?=$product->name?></h1>
                        <span class="Date"> <?=getPDate($product->id)?></span>
                    </div>
                </a>
            <?php } ?>
        </div>
    </section>
<?php }    

function drawRecommended3(array $recommended, string $name, User $user) { ?>
    <section class="Recomended_Section">
        <h1 id="Recomended"><?= $name ?> </h1>
        <div>
            <?php foreach ($recommended as $product) { ?>
                <div class=Rating> 
                <div class="Recomended_Product">

                    <a  href="productPage.php?id=<?=$product->id?>">
                        <img src="<?= $product->getPhoto($product->id)?>" height="200"  >
                        <div class="Product_Details">
                            <h1><?=$product->name?></h1>
                            <span class="Date"> <?=getPDate($product->id)?></span>
                    </a>
                    </div>
                    <?php if(getRating($product->id) == 0){ ?>
                            <form class="Rating_Input" action="../actions/addRating.action.php" method="post">
                                    <div>
                                    <input type="hidden" name="id" value="<?= $product->id ?>">
                                    <label for="rating">Classificação:</label>
                                    <input type="number" name="rating" id="rating" min="1" max="5" required>
                                    </div>
                                    <button class="Submit_Button"type="submit">Submeter</button>
                            </form>
                    <?php } ?>
                </div>
                </div>
            <?php } ?>
        </div>
    </section>
<?php }   


function drawProducts(array $products, string $name) { ?>
    <section class="Product_Catalog">
        <h1><?= $name ?> </h1>
        <?php foreach ($products as $product) { ?>
        <a class="Product_Preview" href="productPage.php?id=<?=$product->id?>">
            <img src="<?= $product->getPhoto($product->id)?>" width="300" >
            <div class="Product_Details">
                <h2><?=$product->name?></h2>
                <h3> Condição:  <span class="Condition"><?=$product->condition?></span></h3>
                <span class="Product_Description"><?=$product->description?></span>
            </div>
            <span class="Price"><?=$product->price?>&#128;</span>
        </a>
        <?php } ?>
    </section>
<?php } 



function drawShoppingList(array $products, string $name) { ?>
    <div class="Shopping_List">
        <?php drawProducts($products, $name); ?>
    </div>
<?php } 

 function drawFavoritesList(array $products, string $name) { ?>
    <div class="Favorites_List">
    <?php if (count($products) == 0) { ?>
        <div class="Shopping_List">
        <section class="Product_Catalog">  
        <h1>Sem produtos favoritos</h1>
        </section>
        </div>
    <?php } else { ?>
        <?php drawProducts($products, $name); ?>
    </div>
    <?php }?>
<?php } 

 function drawProductInfo(Product $product) { ?>


    <div class="Product_Page_Outline">
                    <div class="Product_Page">
                        <div class="Product_Images">
                            <h1><?=$product->name?></h1>
                            <div class="Main_Image">
                                <img src="<?= $product->getPhoto($product->id)?>" width="500">
                            </div>
                            <div class="galery"></div>
                        </div>  
                        
                        <div class="Product_Info">
                            <div class="First_Info">
                                <a  href="sellerPage.php?id=<?=$product->seller_id?>">
                                     <div href class="Seller_Info">
                                         <img id="Profile_Picture" src="<?= $product->getUserPhoto($product->seller_id)?>" width="60px">
                                         <div>
                                             <span id="Seller_Name"> <?=$product->seller_name?></span>
                                             <span id="Seller_Rating"> Classificação: <?=$product->seller_rating?></span>
                                         </div>

                                     </div>
                                </a>
                                <div class="Product_Buy">
                                <?php if(isset($_SESSION['id'])) { ?>
                                <?php if(verifyCart($product->id)==0 &($product->sold==0)) { ?>
                                    <button id="Buy_Button" onclick="addCart(<?=$product->id?>)">Adicionar</button>
                                <?php } else if($product->sold==0) {?>
                                     <button id="Buy_Button" onclick="removeCart(<?=$product->id?>)">Remover</button> 
                                <?php }else{ ?>
                                    <div class="Unavailable"> Indisponível </div>

                                <?php } ?>
                                <?php } ?>
                                </div>
                            </div>
                            
                            <div class="Product_Description">
                                <body class="Long_Description">
                                    <blockquote><?=$product->description?> </blockquote>
                                </body>
                                <div class="Description_Details">
                                    <div><span class="Caracteristic">Condição: </span><span><?=$product->condition?></span></div>
                                    <div><span class="Caracteristic">Marca:</span><span> <?=$product->brand?></span></div>
                                    <div><span class="Caracteristic">Tamanho: </span><span><?=$product->size?></span></div>
                                    <div><span class="Caracteristic">Categoria: </span><span><?=$product->category?></span></div>
                                    <?php if($product->sold==1 && getRating($product->id)!=0) {?>
                                    <div><span class="Caracteristic">Classificação: </span><span><?=getRating($product->id)?></span></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php if(isset($_SESSION['id'])) { ?>
                                <?php if(verifyfavorite($product->id)==0) { ?>
                                    <button class="Favorite_Button" id="Favorite_Button" onclick="addFavorite(<?=$product->id?>)">Adicionar aos favoritos</button>
                                <?php } else {?>
                                        <button class="Favorite_Button" id="Unfavorite_Button" onclick="removeFavorite(<?=$product->id?>)">Remover dos favoritos</button> 
                                    <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                
<?php }

function drawProduct(int $id){
    $db=getDatabaseConnection();
    $product=Product::getProduct($db,$id);
    drawProductInfo($product);
    if(isset($_SESSION['id']) && $_SESSION['id']==$product->seller_id){
        drawEdits($id);
    }
}

function verifyfavorite(int $id){
    $db=getDatabaseConnection();
    $stmt = $db->prepare('SELECT * FROM Favorites WHERE UserId=? AND ProductId= ?');
    $stmt->execute(array($_SESSION['id'], $id));

    $a = $stmt->fetch();
    if (!$a) {
        return 0;
      } else return 1;
}

function verifyCart(int $id){
    $db=getDatabaseConnection();
    $stmt = $db->prepare('SELECT * FROM Cart WHERE UserId=? AND ProductId= ?');
    $stmt->execute(array($_SESSION['id'], $id));

    $a = $stmt->fetch();
    if (!$a) {
        return 0;
      } else return 1;
}

function getPDate(int $id){
    $db=getDatabaseConnection();
    $stmt = $db->prepare('SELECT Date FROM Purchase WHERE ProductId= ?');
    $stmt->execute(array($id));

    $a = $stmt->fetch();
    return $a['Date'];
}

function getRating(int $id){
    $db=getDatabaseConnection();
    $stmt = $db->prepare('SELECT Rating FROM Purchase WHERE ProductId= ?');
    $stmt->execute(array($id));

    $a = $stmt->fetch();
    return $a['Rating'];
}

function drawProductSearch() { ?>
    <section id = "searching">
      <select id = "critério" >
        <option value = "Pname">Nome do Produto</option>
        <option value = "Cname">Categoria</option>
        <option value = "Uname">Nome do Vendedor</option>
      </select>
      <div>
          <input id="searchproduct" type="text" placeholder="pesquisa">
          <section id="searchproducts">
              </section> 
            </div>
    </section>
  <?php 
}


function drawProductRegister(array $categories, array $conditions){?>
    <form class="Product_Form" action="../actions/addProduct.action.php" method="post"> 
        <h1>Adicionar produto</h1>
        <div class="Form_Section">
        <label>Título
            <input type="text" name="name" required="required" value="<?=htmlentities($_SESSION['input']['name newProduct'])?>">
        </label>
        </div>
        <div class="Form_Section">
        <label>Categoria
            <select id="category" name="category" required>
                <option value="">Selecione uma categoria...</option>
                <?php 
                    foreach ($categories as $category) {
                    echo '<option value="' . $category . '" ' . ($_SESSION['input']['category_newProduct'] == $category ? 'selected' : '') . '>' . $category . '</option>';
                    }
                ?>

    <!-- Add more options as needed -->
            </select>
        </label>
        </div>
        <div class="Form_Section">
        <label>Marca
            <input type="text" name="brand"  value="<?=htmlentities($_SESSION['input']['brand newProduct'])?>">
        </label>
        </div>
        <div class="Form_Section">
        <label>Tamanho(se aplicável)
            <input type="text" name="size"  value="<?=htmlentities($_SESSION['input']['size newProduct'])?>">
        </label>
        </div>
        <div class="Form_Section">
        <label>Condição
            <select id="condition" name="condition" required>
                <option value="">Selecione uma condição...</option>
                <?php 
                    foreach ($conditions as $condition) {
                    echo '<option value="' . $condition . '" ' . ($_SESSION['input']['condition_newProduct'] == $condition ? 'selected' : '') . '>' . $condition . '</option>';
                    }
                ?>

    <!-- Add more options as needed -->
            </select>
        </label>
        </div>
        <div  class="Form_Section">
        <label>Descrição
            <input type="text" name="description" required="required" value="<?=htmlentities($_SESSION['input']['description newProduct'])?>">
        </label>
        </div>
        <div class="Form_Section">
        <label>Preço(&#128;)
            <input type="text" name="price" required="required" value="<?=htmlentities($_SESSION['input']['price newProduct'])?>">
        </label>
        </div>
        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
        <input type="submit" value="Register" class="Submit_Button">
    </form>
    <!--<form>
        <div>
            <label>Foto(s) do Produto: <input type="file" name="image"></label>
        </div>
    </form>-->
<?php } 

function drawProductEdit(int $id){?>
    <form class="Product_Form" action="../actions/editProduct.action.php?id=<?=$id?>" method="post"> 
        <h1>Editar produto</h1>
        <div class="Form_Section">
        <label>Nome
            <input type="text" name="name" required="required" value="<?=htmlentities($_SESSION['input']['name oldProduct'])?>">
        </label>
        </div>
        <div class="Form_Section">
        <label>Categoria
            <select id="category" name="category" required>
                <option value="">Select a category...</option>
                <option value="Moda" <?= ($_SESSION['input']['category oldProduct'] == 'Moda') ? 'selected' : '' ?>>Moda</option>
                <option value="Tecnologia" <?= ($_SESSION['input']['category oldProduct'] == 'Tecnologia') ? 'selected' : '' ?>>Tecnologia</option>
                <option value="Casa" <?= ($_SESSION['input']['category oldProduct'] == 'Casa') ? 'selected' : '' ?>>Casa</option>
                <option value="Automóveis" <?= ($_SESSION['input']['category oldProduct'] == 'Automóveis') ? 'selected' : '' ?>>Automóveis</option>
                <option value="Geral" <?= ($_SESSION['input']['category oldProduct'] == 'Geral') ? 'selected' : '' ?>>Geral</option>
            </select>
        </label>
        </div>
        <div class="Form_Section">
        <label>Marca
            <input type="text" name="brand"  value="<?=htmlentities($_SESSION['input']['brand oldProduct'])?>">
        </label>
        </div>
        <div class="Form_Section">
        <label>Tamanho(se aplicável)
            <input type="text" name="size"  value="<?=htmlentities($_SESSION['input']['size oldProduct'])?>">
        </label>
        </div>
        <div class="Form_Section">
        <label>Condição
            <select id="condition" name="condition" required>
                <option value="">Select a condition...</option>
                <option value="Novo" <?= ($_SESSION['input']['condition oldProduct'] == 'Novo') ? 'selected' : '' ?>>Novo</option>
                <option value="Como Novo" <?= ($_SESSION['input']['condition oldProduct'] == 'Como Novo') ? 'selected' : '' ?>>Como Novo</option>
                <option value="Usado" <?= ($_SESSION['input']['condition oldProduct'] == 'Usado') ? 'selected' : '' ?>>Usado</option>
            </select>
        </label>
        </div>
        <div class="Form_Section">
        <label>Descrição
            <input type="text" name="description" required="required" value="<?=htmlentities($_SESSION['input']['description oldProduct'])?>">
        </label>
        </div>
        <div class="Form_Section">
        <label>Preço(&#128;)
            <input type="text" name="price" required="required" value="<?=(float)$_SESSION['input']['price oldProduct']?>">
        </label>
        </div>
        <input type="text" name="id" value="<?=$id?>" hidden>
        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
        <input type="submit" value="Register" class="Submit_Button">
    </form>
    <form class="Picture_Input" action="../actions/productPhoto.action.php?id=<?=$id?>" method="post" enctype="multipart/form-data">
        <div>
            <label>Foto(s) do Produto: <input type="file" name="image"></label>
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <input class="Submit_Button" type="submit" value="Upload">
        </div>
    </form>
<?php } 

function drawEdits(int $id) { ?>
    <div class="Edit_Buttons">
        <section id="editProduct">
            <a href="../editProductPage.php?id=<?=$id?>"><button id="Edit_Button">Editar produto</button></a>
        </section> 
        <section id="removeProduct">
            <a href="../actions/removeProduct.action.php?id=<?=$id?>"><button id="Remove_Button">Remover produto</button></a>
        </section> 
        <?php $product = Product::getProduct(getDatabaseConnection(), $id);
         if($product->sold==1){?>
            <section id="shippingForm">
            <a href="../shippingFormPage.php?id=<?=$id?>"><button id="Edit_Button">Shipping Form</button></a>
            </section> 
         <?php } ?>
    </div>
<?php } 

function drawShippingForm(int $id){ ?>
    <?php $db=getDatabaseConnection();
    $product=Product::getProduct($db, $id);
    
    $stmt = $db->prepare('SELECT * FROM Purchase WHERE ProductId= ?');
    $stmt->execute(array($id));

    $purchase = $stmt->fetch();

    $buyer=User::getUser($db, $purchase['UserId']);
    ?>

<div class="Shipping_Form">
        <h1>Shipping Form</h1>
        <h2>Product: </h2><h3><?= htmlspecialchars($product->name) ?></h3>
        <h2>Seller: </h2><h3><?= htmlspecialchars($product->seller_name) ?></h3>
        <h2>Buyer: </h2><h3><?= htmlspecialchars($buyer->firstName . ' ' . $buyer->lastName) ?></h3>
        <h2>Shipping Address: </h2><h3><?= htmlspecialchars($buyer->address) ?></h3>
        <h2>Shipping Cost: </h2><h3>Free</h3>
        <h2>Purchase Date: </h2><h3><?= htmlspecialchars($purchase['Date']) ?></h3>
    </div>
<?php } ?>