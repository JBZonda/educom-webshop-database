<?php

function showcontent($data) {
    echo '<div class=shoppingcart>
    <h1>Producten in winkelwaken:';
    $product_ids = get_cart();
    show_products($data, $product_ids);
    echo '</div>';
}

function show_products($data, $product_ids){
    echo "Product";
}

?>