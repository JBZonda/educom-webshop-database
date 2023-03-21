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
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    disconnect_database($conn);
}

function does_email_exist($email){
    #check if email is already in use
    $conn = connect_database();
    
    $result = get_user_by_email($conn, $email);
    if ($result != FALSE){
        disconnect_database($conn);
        return TRUE;
    } else {
        disconnect_database($conn);
        return FALSE;
    }
}

function get_user_data_from_email($email){
    $conn = connect_database();
    
    $result = get_user_by_email($conn, $email);
    if ($result != FALSE){
        while($row = mysqli_fetch_assoc($result)){
            $user_data["email"] = $row["email"];
            $user_data["name"] = $row["name"];
            $user_data["password"] = $row["password"];
        }
        
        disconnect_database($conn);
        return $user_data;
    } else {
        disconnect_database($conn);
        return FALSE;
    }
}
function set_new_password($email, $new_password){
    $conn = connect_database();
    $sql ="UPDATE users SET password = '" .$new_password. "
    ' WHERE email='". $email ."'";
    $result= mysqli_query($conn, $sql);

    if (!mysqli_query($conn, $sql)) {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    disconnect_database($conn);
}


?>