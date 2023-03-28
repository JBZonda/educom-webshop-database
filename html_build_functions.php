<?php
function show_HTML_start(){
    echo '<!DOCTYPE html>
    <html lang="en">';
}

function show_HTML_end(){
    echo "</html>";
}
function show_head_section(){
    echo '<head>
    <title>Home</title>
    <link rel="stylesheet" href="CSS/stylesheet.css">
    </head>';
}

function show_body_start(){
    echo '<body class="standard_body">';

}

function show_nav_item($link, $label){
    echo '<li> <a href="\educom-webshop-database/index.php?page='. $link .'">' . $label . '</a></li>';
}

function show_nav_bar($data){
    echo '<div id="nav_bar">
    <ul>';
    foreach($data['menu'] as $link => $label) {
        show_nav_item($link, $label);
    }
    
    
    #show a register and login or a loguit option depending on if the user is loged in
    
    echo '</ul>
    </div>';
}
function showcontent_page($data){
    $page = $data["page"];
    if (file_exists( $page . ".php")){
        include $page . ".php";
        show_content($data);
    }
    else {
        echo "<h1> deze pagina bestaat niet </h1>";
    }
}

function show_footer(){
    echo '<footer  class="standard_footer"> 
    <p>&copy;2023 Autheur: Jeroen van der Borgh</p>
    </footer>';
}

function show_body_end(){
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

function show_body_section($data){
    show_body_start();
    show_nav_bar($data);
    showcontent_page($data);
    show_footer();
    show_body_end();
}

function showResponsePage($data){
    show_HTML_start();
    show_head_section();
    show_body_section($data);
    show_HTML_end();
}
?>