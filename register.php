<?php
function show_content($data){
    show_form_start("register-login","form_register", $data);
    show_form_field("email", "Email:", "email", $data, "email");
    show_form_field("name", "Naam:", "text", $data, "name");
    show_form_field("password", "Wachtwoord:", "password", $data, "password");
    show_form_field("password_re", "Herhaal wachtwoord:", "password", $data, "password_re");
    show_form_end("Submit", "register");
}

?>