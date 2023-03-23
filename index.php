<?php 
include "html_build_functions.php";
include "form_handle_functins.php";
include "file_repository.php";
include "session_functions.php";
session_start();
#create session variables on first load
session_initialize();

#handle the request and return the page to be loaded
$page = getRequestedPage();
$data = process_Request($page);
showResponsePage($data);

function getRequestedPage(){
    #handle each form from the POST request
    if (is_POST()) { return $_POST['page'];}
    
    return $_GET["page"];
}

function make_menu($data) {
    $menu = array("home" => "Home", "about" => "About", "contact" => "Contact", "webshop" => "Webshop");
    if (isUserLoggedIn()){
        $menu["logout"] = "Loguit " . get_current_user_name();
        $menu["change_password"] = "Wachtwoord veranderen";
        $menu["shoppingcart"] = "Winkelwagen";
    } else {
        $menu["register"] =  "Registeer";
        $menu["login"] = "Login";
    }
    $data["menu"] = $menu;
    return $data;
}

function process_Request($page){
    $page = htmlspecialchars($page);
    $data = array("page"=>$page,"errors"=>array());
    switch ($page){
        case "home":
            break;
        case "about":
            break;
        case "contact":
            if (is_POST()){
                $data = handle_form_contact($data);

                $thanks = is_valid($data);
                $data["thanks"] = $thanks;
            }
            break;
        case "register":
            if (is_POST()){
                $data = validate_form_register($data);
                if (is_valid($data)){
                    save_user($data["email"],$data["name"],$data["password"]);
                    $data["page"] = "login";
                }
            } 
            break;
        case "login":
            if (is_POST()){
                $data = validate_form_login($data);
                if (is_valid($data)){
                    login_user($data["email"],$data["name"]);
                    $data["page"] = "home";
                }

            }

            break;
        case "logout":
            $data = logout_user($data);
            break;
        case "change_password":
            if (is_POST()){
                $data = validate_form_change_password($data);
                if (is_valid($data)) {
                    set_new_password($data["email"], $data["password"]);
                }
            }
            break;
        case "webshop":
            try {
                $data["id"] =  $_GET["id"];
            } catch (Exception $e) {
                $data["id"] = NULL;
            }
            break;

        default:
            $data["page"] = "home";
            break;
    }

    $data = make_menu($data);
    return $data;
}
function is_POST(){
    return ($_SERVER["REQUEST_METHOD"] == "POST");
}




?>