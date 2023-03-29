<?php

function show_top5($data){
    echo "<h1>Top 5 bestelde producten in de laatste week:</h1>";
    
    foreach( $data["products"] as $product){
        show_product_in_overview($product, $data);
    }
}

function show_product_in_overview($product, $data){
    echo '<a class="product_link" href="\educom-webshop-database/index.php?page=webshop&id='. $product->get_id() .'">
    <div class="product_top">
    <img src="Images/'. $product->get_image_location().'" alt="image of '. $product->get_id() .'">
    <p >'. $product->get_name() . '</p>
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

function show_content($data){
    show_top5($data);
}

?>