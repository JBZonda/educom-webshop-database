<?php

function show_webshop($data){
    echo "<h1>Webshop</h1>";
    
    foreach( $data["products"] as $product){
        show_product_in_overview($product, $data);
    }
}

function show_product_in_overview($product, $data){
    echo '<a class="product_link" href="\educom-webshop-database/index.php?page=webshop&id='. $product->get_id() .'">
    <div class="product">
    <p >'. $product->get_name() . '</p>
    <img src="Images/'. $product->get_image_location().'" alt="image of '. $product->get_id() .'">
    <p>Prijs:'. $product->get_price().'</p>';
    if (isUserLoggedIn()){
        if (in_array($product->get_id(), get_cart())){
            cart_button($product->get_id(), "overview", "remove", $data);
        } else {
            cart_button($product->get_id(), "overview", "add", $data);
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
            cart_button($product->get_id(), "detail", "remove", $data);	
        } else {
            cart_button($product->get_id(), "detail", "add", $data);
        }
    }
    echo '<p>Beschrijving:<br>'. $product->get_discription().'</p>
    </div>';
}

function show_content($data){
    if ($data["id"] != NULL) {
        show_product_in_detail($data);
    }   else {
        show_webshop($data);
    }
}
?>