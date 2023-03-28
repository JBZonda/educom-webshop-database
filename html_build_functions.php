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

/* show form functions*/
function show_form_start($div_class, $form_class, $data){
    echo '<div class="'.$div_class.'">
    <form class="'.$form_class.'" method="post" action="\educom-webshop-database/index.php">
    <span class="error">'; echo get_variable($data,"errors","generic"); echo '</span><br>';
}
function show_form_field($field_name, $label, $type, $data, $error_name, $options=NULL){
    	
    echo '<label for="name">'.$label.'</label><br>';
    switch($type){
        case "textarea":
            echo
            '<textarea id="'.$field_name.'" name="'.$field_name.'">'; echo get_variable($data,$field_name); echo '</textarea>
            <span class="error">'; echo get_variable($data,"errors", $error_name); echo '</span><br>';
            break;
        case "radio":
            echo '<span class="error">'; echo get_variable($data,"errors",  $error_name); 
            
            echo '</span><br>';
            foreach ($options as $option) {
                echo '<input type="radio" name="'.$field_name.'" value="'.$option.'"';
                if (get_variable($data, "com_pref") == $option) {
                    echo 'checked="checked"';
                }
                echo '><label for="">'.$option.'</label><br>';
            }
            break;

        default:
            echo '<input type="'.$type.'" name="'.$field_name.'" value="'; echo get_variable($data,$field_name); echo '">
            <span class="error">'; echo get_variable($data,"errors",$error_name); echo'</span><br><br>';
    }
}

function show_form_end($submit_text,$page){
    echo
    '<input type="hidden" name="page" value="'.$page.'"><br>
    <input type="submit" value="'.$submit_text.'">
    </form>
    </div>
    ';
}
/*---------------------------------------------------*/
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