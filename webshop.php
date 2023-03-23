<?php

function add_to_cart_button($id, $place) {

    echo '<div class="cart_button">
    <form action="\educom-webshop-database/index.php" method="post">
    <input type="hidden" name="page" value="webshop" />
    <input type="hidden" name="id_in_cart" value="'.$id.'" />
    <input type="hidden" name="place" value="'.$place.'" />
    <input type="submit" value="Add to cart">
    </form>
    </div>
    ';
}

function show_webshop($data, $id_array){
    echo "<h1>Webshop</h1>";
    
    foreach( $id_array as $id){
        show_product_in_overview($data, $id);
    }
}

function show_product_in_overview($product, $id){
    
    get_product_by_id($id);
    echo '<a class="product_link" href="\educom-webshop-database/index.php?page=webshop&id='. $id .'">
    <div class="product">
    <p >'. $product->get_name() . '</p>
    <img src="Images/'. $product->get_image_location().'" alt="image of '. $product->get_id() .'">
    <p>Prijs:'. $product->get_price().'</p>';
    add_to_cart_button($id, "detail");
    echo '</div>
    </a>';
}

function show_product_in_detail($data, $id){

    $product = get_product_by_id($id);
    echo 
    '<div class="product">
    <h1>'. $product->get_name() . '</h1>
    <img src="Images/'. $product->get_image_location().'" alt="image of product id:  '. $product->get_id() .'">
    <p>Prijs:'. $product->get_price().'</p>';
    add_to_cart_button($id, $data, "detail");
    echo '<p>Beschrijving:'. $product->get_discription().'</p>
    </div>';
}

function showcontent($data, $id_array = array(1,2,3,4,5)){
    if ($data["id"] != NULL) {
        show_product_in_detail($data, $data["id"]);
    }   else {
        show_webshop($data, $id_array);
    }
}
?>