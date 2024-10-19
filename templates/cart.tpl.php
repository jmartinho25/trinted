<?php declare(strict_types = 1);
require_once('product.tpl.php') ?>

<?php function drawCart(array $products, string $name) { ?>
    <div class="Cart">
    <?php if (count($products) == 0) { ?>
        <div class="Shopping_List">
        <section class="Product_Catalog">   
        <h1>Sem produtos no carrinho</h1>
        </section>
        </div>
    <?php } else { ?>
    <?php drawShoppingList( $products, $name);?>
    <div class="List_Resume">
                <h1>Resumo</h1>
                <?php 
                $totalPrice = 0;
                foreach ($products as $product) {
                    $totalPrice += $product->price; 
                } 
                ?>
                <div class="Total">
                    Total: <span class="Price"><?=$totalPrice?>&#128;</span>
                </div>
                <?php if(isset($_SESSION['id'])) {?>
                    <button id="Buy_Button" onclick="addPurchase()">Comprar</button>
                <?php } ?>
            </div>
    <div>
    <?php } ?>
    <?php } ?>