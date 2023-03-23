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

function showNavbar($data){
    echo '<div id="nav_bar">
    <ul>';
    foreach($data['menu'] as $link => $label) {
        showNavItem($link, $label);
    }
    
    
    #show a register and login or a loguit option depending on if the user is loged in
    
    echo '</ul>
    </div>';
}
function showcontent_page($data){
    $page = $data["page"];
    if (file_exists( $page . ".php")){
        include $page . ".php";
        showcontent($data);
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
    showNavbar($data);
    showcontent_page($data);
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