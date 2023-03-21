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
    $sql ="SELECT * FROM users WHERE email='". $email ."'";
    $result= mysqli_query($conn, $sql);
    if (!$result){
        throw new Exception("get_user_by_email: query error:" . mysqli_error($conn) );
    }
    if (mysqli_num_rows($result) > 0) {
        return $result;
    } else {
        return FALSE;
    }
}

function save_user($email,$name,$password){
    $conn = connect_database();
    $sql = "INSERT INTO users(email, name, password) VALUES ('" . $email . "', '" . $name . "', '" . $password . "')";

    if (!mysqli_query($conn, $sql)) {
        throw new Exception("get_user_by_email: query:". $sql . " error:" . mysqli_error($conn));
    }

    disconnect_database($conn);
}

function does_email_exist($email){
    #check if email is already in use
    $conn = connect_database();
    try{
        $result = get_user_by_email($conn, $email);
        if ($result != FALSE){
            return TRUE;
        } else {
            return FALSE;
        }
    } finally {
        disconnect_database($conn);
    }
    
}

function get_user_data_from_email($email){
    $conn = connect_database();
    
    try{
        $result = get_user_by_email($conn, $email);
        if (!$result){
            throw new Exception("get_user_data_from_email: email not in database");
        }
        $row = mysqli_fetch_assoc($result);
        $user_data["email"] = $row["email"];
        $user_data["name"] = $row["name"];
        $user_data["password"] = $row["password"];
        return $user_data;
    } finally {
        disconnect_database($conn);
    }
    
}
function set_new_password($email, $new_password){
    $conn = connect_database();
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
    $sql = "INSERT INTO products(name, discription, price, image_location) VALUES
    ('" . $product->get_name()."','" . $product->get_discription() . "','" . $product->get_price() . "','" . $product->get_img_file(). "')";
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

?>