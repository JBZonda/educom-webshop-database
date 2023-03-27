<?php

function connect_database(){
    $servername = "localhost";
    $username = "jeroens_webshop_user";
    $password = "p@TL!Cz7m2qes7V!";
    $database = "jeroens_webshop";
    $conn = mysqli_connect($servername, $username, $password, $database);
    return $conn;
}

function disconnect_database($conn){
    mysqli_close($conn);
}

function get_user_by_email($conn ,$email){
    $email = mysqli_real_escape_string($conn, $email);
    $sql ="SELECT * FROM users WHERE email='". $email ."'";
    $result= mysqli_query($conn, $sql);
    if (!$result){
        throw new Exception("get_user_by_email: query error:" . mysqli_error($conn) );
    }    
    return $result;
    
}

function save_user($email,$name,$password){
    $conn = connect_database();
    $email = mysqli_real_escape_string($conn, $email);
    $name = mysqli_real_escape_string($conn, $name);
    $password = mysqli_real_escape_string($conn, $password);
    $sql = "INSERT INTO users(email, name, password) VALUES ('" . $email . "', '" . $name . "', '" . $password . "')";
    try{
        if (!mysqli_query($conn, $sql)) {
            throw new Exception("save_user: query:". $sql . " error:" . mysqli_error($conn));
        }
    } finally{
        disconnect_database($conn);
    }
}

function does_email_exist($email){
    $conn = connect_database();
    try{
        $result = get_user_by_email($conn, $email);
        $exists = mysqli_num_rows($result) > 0;
        return $exists;
        
    } finally {
        disconnect_database($conn);
    }
    
}

function get_user_data_from_email($email){
    $conn = connect_database();
    
    try{
        $result = get_user_by_email($conn, $email);
        if (!$result){
            throw new Exception("get_user_data_from_email: error:" . mysqli_error($conn));
        }
        $user_data = mysqli_fetch_assoc($result);
        return $user_data;

    } finally {
        disconnect_database($conn);
    }
    
}
function set_new_password($email, $new_password){
    $conn = connect_database();
    $email = mysqli_real_escape_string($conn, $email);
    $new_password = mysqli_real_escape_string($conn, $new_password);
    $sql ="UPDATE users SET password = '" . $new_password . "' WHERE email='". $email ."'";

    try{
    $result= mysqli_query($conn, $sql);
    if (!mysqli_query($conn, $sql)) {
        throw new Exception("get_user_by_email: query:". $sql . " error:" . mysqli_error($conn));
    }
    } finally {
        disconnect_database($conn);
    }
    
}

function save_product($product){
    $conn = connect_database();
    $name = mysqli_real_escape_string($conn, $product->get_name());
    $discription = mysqli_real_escape_string($conn, $product->get_discription());
    $price = mysqli_real_escape_string($conn, $product->get_price());
    $img_location = mysqli_real_escape_string($conn, $product->get_img_location());

    $sql = "INSERT INTO products(name, discription, price, image_location) VALUES
    ('" . $name ."','" . $discription . "','" . $price . "','" . $img_location . "')";
    try{
    if (!mysqli_query($conn, $sql)) {
        throw new Exception("save_product: query:". $sql. " error:". mysqli_error($conn));
    }
    } finally {
        disconnect_database($conn);
    }
}

function get_product_by_id($id){
    $conn = connect_database();
    $sql = "SELECT * FROM products WHERE id='$id'";
    $result= mysqli_query($conn, $sql);
    if (!$result){
        throw new Exception("get_product_by_id: query error:". mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($result);
    $product = new Product($row["id"], $row["name"], $row["discription"], $row ["image_location"], $row["price"]);
    return $product;
}
function get_products($id_array){
    $sql = "SELECT * FROM products WHERE";
    foreach($id_array as $key => $id) {
        if (substr($sql,-5) == "WHERE"){
            $sql = $sql .  ' id=' . $id;
        } else {
            $sql = $sql . ' OR id=' . $id;
        }
    }
    $conn = connect_database();
    try {
        $result= mysqli_query($conn, $sql);
        if (!$result){
            throw new Exception("get_product_by_id: query error:". mysqli_error($conn));
        }
        $products = array();
        while ($row = mysqli_fetch_assoc($result)){
            $product = new Product($row["id"], $row["name"], $row["discription"], $row ["image_location"], $row["price"]);
            array_push($products, $product);
        }
        return  $products;
    } finally {
        disconnect_database($conn);
    }
}

function save_order($data){
    $user_id = $data["user_id"];
    $time = $data["time"];
    $product_ids = $data["ordered_product_ids"];
    $sql = "INSERT INTO orders(user_id, time, product_id) VALUES ";
    foreach ($product_ids as $product_id) {
        if (substr($sql,-7) != "VALUES "){
            $sql = $sql . " , ";
        }
        $sql = $sql . "('" . $user_id ."','" . $time . "','" . $product_id . "')";
    }

    echo $sql;
    $conn = connect_database();
    try {
        $result= mysqli_query($conn, $sql);
        if (!$result){
            throw new Exception("save_order: query error:". mysqli_error($conn));
        }
    } finally {
        disconnect_database($conn);
    }


}


?>