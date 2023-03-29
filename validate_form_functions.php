<?php
#return true if there are no errors saved
function validate_input_fields($fields, $data){
    foreach ($fields as $key => $field){
        $data = validate_specific_response($field, clean_and_check_input($field,$data));
    } 
    return $data;
}


function is_valid($data){
    $valid = TRUE;
    $errors = $data["errors"];
    foreach( $errors as $key => $error) {
        if ($error != ""){
            $valid = False;
            break;
        }
    }
    return $valid;
}

function validate_form_contact($data){
    #check input and set errors is the errors array in $data
    $fields = array("address","name", "email", "phone_number", "comment","com_pref");
    $data = validate_input_fields($fields, $data);
    return $data;
    
}

function validate_form_register($data){
    $fields = array("name","email", "password", "password_re");
    $data = validate_input_fields($fields, $data);
    if ($data["password"] != $data["password_re"]) {
        $data["errors"]["password"] = "Herhaalde wachtwoord komt niet over een.";
    }
    try {
        if (does_email_exist($data["email"])) {
            $data["errors"]["email"] = "Email is al in gebruik.";
        }
    } catch(Exception $e){
        $data["errors"]["generic"] = "Er is een fout probeer het later nog eens.";
    }
    return $data;
}

function validate_form_change_password($data){
    $fields = array("old_password", "password", "password_re");
    $data = validate_input_fields($fields, $data);

    if ($data["password"] != $data["password_re"]) {
        $data["errors"]["password"] = "Herhaalde wachtwoord komt niet over een.";
    }

    if (is_valid($data)) {
        try{
        $user_data = get_current_user_data();
        if ($user_data["password"] != $data["old_password"]){
            $data["errors"]["old_password"] = "Wachtwoord is incorrect.";
        } else {
            $data["email"] = $user_data["email"];
        }
        } catch(Exception $e){
            $data["errors"]["generic"] = "Er is een fout probeer het later nog eens.";
        }
       
    } 
    return $data;
}


function validate_form_login($data){
    $fields = array("email", "password");
    $data = validate_input_fields($fields, $data);

    #check the login data
    if (is_valid($data)) {
        try{
            $user_data = get_user_data_from_email($data["email"]);
            if ($user_data == NULL || ($data["password"] != $user_data["password"])){
                $data["errors"]["login"] = "Login is incorrect.";
            } else {
                $data["name"] = $user_data["name"];
                $data["id"] = $user_data["id"];
            }
        } catch(Exception $e){
            $data["errors"]["generic"] = "Er is een fout probeer het later nog eens.";
        }
        }
    return $data;
    
}


function clean_and_check_input($variable_name, $data) {
    # give errors to the missing variables
    if (empty($_POST[$variable_name])){
        $emty_error = "is verplicht";
        $data[$variable_name]= "";
        $data["errors"][$variable_name] = $emty_error;
    } else {
        #trim the data to protect against malicious input
        $input = $_POST[$variable_name];
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        $data[$variable_name]= $input;
        $data["errors"][$variable_name] = "";
    }
    
    return $data;
}


function validate_specific_response($variable_name, $data) {
    if ($variable_name == "phone_number") {
        #check if the input is a correct phonenumber by checking for letters, special signs are allowed
        if (preg_match("/[a-z]/i", $data["phone_number"])){
            $data["errors"][$variable_name] = "Incorrect telefoonnummer";
            return $data;
        }
    }
    return $data;
}

function validate_cart($data){
    $fields = array("id_in_cart", "place", "action", "amount");
    $data = validate_input_fields($fields, $data);
    return $data;
}

function validate_upload($data){
    $fields = array("title", "discription", "price");
    $data = validate_input_fields($fields, $data);
    return $data;
}
?>