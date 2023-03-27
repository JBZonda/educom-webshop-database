<?php

function cart_button($id, $place, $action) {

    switch  ($action) {
        case 'add':
            $submit_value = "Add to cart";
            break;
        case 'remove':
            $submit_value = "Remove from cart";
            break;
    }    
     
    echo '<div class="cart_button">
    <form action="\educom-webshop-database/index.php" method="post">
    <input type="hidden" name="page" value="webshop" />
    <input type="hidden" name="id_in_cart" value="'.$id.'" />
    <input type="hidden" name="place" value="'.$place.'" />
    <input type="hidden" name="action" value="'. $action .'" />
    <input type="submit" value="'. $submit_value .'">
    </form>
    </div>
    ';
}



function show_webshop($data){
    echo "<h1>Webshop</h1>";
    
    foreach( $data["products"] as $product){
        show_product_in_overview($product);
    }
}

function show_product_in_overview($product){
    echo '<a class="product_link" href="\educom-webshop-database/index.php?page=webshop&id='. $product->get_id() .'">
    <div class="product">
    <p >'. $product->get_name() . '</p>
    <img src="Images/'. $product->get_image_location().'" alt="image of '. $product->get_id() .'">
    <p>Prijs:'. $product->get_price().'</p>';
    if (isUserLoggedIn()){
        if (in_array($product->get_id(), get_cart())){
            cart_button($product->get_id(), "overview", "remove");
        } else {
            cart_button($product->get_id(), "overview", "add");
        }
    }
    echo '</div>
    </a>';
}

function show_product_in_detail($data){
    $product = $data["products"][0];
    echo 
    '<h1>'. $product->get_name() . '</h1>
    <div class="product">
    
    <img src="Images/'. $product->get_image_location().'" alt="image of product id:  '. $product->get_id() .'">
    <p>Prijs:'. $product->get_price().'</p>';
    if (isUserLoggedIn()){
        if (in_array($product->get_id(), get_cart())){
            cart_button($product->get_id(), "detail", "remove");
        } else {
            cart_button($product->get_id(), "detail", "add");
        }
    }
    echo '<p>Beschrijving:'. $product->get_discription().'</p>
    </div>';
}

function showcontent($data){
    if ($data["id"] != NULL) {
        show_product_in_detail($data);
    }   else {
        show_webshop($data);
    }
}
?>