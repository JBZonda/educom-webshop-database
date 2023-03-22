<?php

function session_initialize(){
    if ($_SESSION == array()){
        $_SESSION["user_name"] = NULL;
        $_SESSION["user_email"] = NULL;
    }
}
function login_user($email,$name){
    $_SESSION["user_email"] = $email;
    $_SESSION["user_name"] = $name;
    
}

function get_current_user_name() {
    return $_SESSION["user_name"];
}

function get_current_user_data() {
    return get_user_data_from_email($_SESSION["user_email"]);
}

function logout_user($data){
    $_SESSION["user_name"] = NULL;
    $_SESSION["user_email"] = NULL;
    $data["page"] = "home";
    return $data;
}

function isUserLoggedIn(){
    return ($_SESSION["user_name"] != NULL);
}

?>