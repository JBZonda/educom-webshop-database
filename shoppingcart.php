<?php

function show_order_button() {

    echo '<div class="order_button">
    <form action="\educom-webshop-database/index.php" method="post">
    <input type="hidden" name="page" value="shoppingcart" />
    <input type="submit" value="Afrekenen">
    </form>
    </div>
    ';
}

function show_total_price($data){
    echo '<div class="total_price_cart">
    <span>Totale prijs</span>
    <span class="total_price_value" >'. $data["total_price"].'</span>
    </div>'
    ;
}

function show_content($data) {

    
    echo '<div class="shoppingcart">
    <h1>Producten in winkelwaken:</h1><br>';
    
    if (array_key_exists("products", $data)) {
        show_products($data);
        show_total_price($data);
        show_order_button($data);
        
    } else {
        echo '<h2>winkelwaken is leeg</h2>';
    }
    echo '</div>';
}

function show_products($data){
    var_dump(get_cart());
    $products = $data['products'];
    foreach( $products as $product){
        echo '<div class="shoppingcart_item">
        <a href="\educom-webshop-database/index.php?page=webshop&id='.$product->get_id().'">'
        .$product->get_name() .'</a>
        <span class="cart_price">'.$product->get_price().'</span>
        </div>
        <br>'
        ;
    }
}

?>