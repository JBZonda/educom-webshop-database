<?php
class Product {
    public $id;
    public $name;
    public $price;
    public $img_location;
    public $discription;

    function __construct($id, $name, $discription,  $img_location, $price){
        $this->id = $id;
        $this->img_location = $img_location;
        $this->name = $name;
        $this->price = $price;
        $this->discription = $discription;
    }
    function get_id(){
        return $this->id;
    }
    function get_name(){
        return $this->name;
    }
    function get_price(){
        return $this->price;
    }
    function get_image_location(){
        return $this->img_location;
    }
    function get_discription(){
        return $this->discription;
    }
    function set_name($name){
        $this->name = $name;
    }
    function set_price($price){
        $this->price = $price;
    }
    function set_img_file($img_location){
        $this->img_location = $img_location;
    }
    function set_discription($discription){
        $this->discription = $discription;
    }
    
}

function show_product_in_overview($id){
    
    $product = get_product_by_id($id);
    echo '<a class="product" href="\educom-webshop-database/index.php?page=webshop&id='. $id .'"> <div class="product">
    <p >'. $product->get_name() . '</p>
    <img src="Images/'. $product->get_image_location().'" alt="image of '. $product->get_id() .'">
    <p>Prijs:'. $product->get_price().'</p>
    </div>
    </a>';
}

echo "<h1>Webshop</h1>";
show_product_in_overview(1);


?>