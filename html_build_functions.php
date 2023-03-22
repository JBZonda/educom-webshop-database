<?php
function showHTMLstart(){
    echo '<!DOCTYPE html>
    <html lang="en">';
}

function showHTMLend(){
    echo "</html>";
}
function showHeadSection(){
    echo '<head>
    <title>Home</title>
    <link rel="stylesheet" href="CSS/stylesheet.css">
    </head>';
}

function showBodyStart(){
    echo '<body class="standard_body">';

}

function showNavItem($link, $label){
    echo '<li> <a href="\educom-webshop-database/index.php?page='. $link .'">' . $label . '</a></li>';
}

function showNavbar(){
    echo '<div id="nav_bar">
    <ul>';
    showNavItem("home", "Home");
    showNavItem("about", "About");
    showNavItem("contact", "Contact");
    showNavItem("webshop", "Webshop");
    
    #show a register and login or a loguit option depending on if the user is loged in
    if (isUserLoggedIn()){
        showNavItem("logout", "Loguit " . get_current_user_name());
        showNavItem("change_password", "Wachtwoord veranderen");
    } else {
        showNavItem("register", "Registeer");
        showNavItem("login", "Login");
    }
    echo '</ul>
    </div>';
}
function showcontent($data){
    $page = $data["page"];
    if (file_exists( $page . ".php")){
        include $page . ".php";
    }
    else {
        echo "<h1> deze pagina bestaat niet </h1>";
    }
}

function showFooter(){
    echo '<footer  class="standard_footer"> 
    <p>&copy;2023 Autheur: Jeroen van der Borgh</p>
    </footer>';
}

function showBodyEnd(){
    echo "</body>";
}

function get_variable($data, $key, $key_array_in_array=NULL){
    if ($key_array_in_array != NULL){
        $value = isset($data[$key][$key_array_in_array]) ? $data[$key][$key_array_in_array] : "";
    } else {
        $value = isset($data[$key]) ? $data[$key] : "";
    }
    return $value;
}

function showBodySection($data){
    showBodyStart();
    showNavbar();
    showcontent($data);
    showFooter();
    showBodyEnd();
}

function showResponsePage($data){
    showHTMLstart();
    showHeadSection();
    showBodySection($data);
    showHTMLend();
}
?>