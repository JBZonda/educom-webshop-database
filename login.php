<?php
function show_content($data){
    show_form_start("register-login","form_login", $data);
    show_form_field("email", "Email:", "email", $data, "login");
    show_form_field("password", "Wachtwoord:", "password", $data, "login");

    show_form_end("Submit", "login");
}
?>
