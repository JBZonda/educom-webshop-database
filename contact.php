<?php
function show_contact_thanks($data){
    echo '<div class="thanks_message">
    <p>Bedankt</p>
    <p>'; echo get_variable($data,"address"); echo" "; echo get_variable($data,"name"); echo '</p>
    <p>Email:'; echo get_variable($data,"email"); echo'</p>
    <p>Telefoonnummer:'; echo get_variable($data,"phone_number"); echo '</p>
    <p>Bericht: <br>';
    echo get_variable($data,"comment"); 
    echo ' </p>
    <p>Communicatievoorkeur: '; echo get_variable($data, "com_pref"); echo '.</div>';
}

function show_contact_form($data){
    show_form_start("contact_form","form_contact", $data);
    show_form_field("address","Aanhef:","select", $data, "address", array("","Dhr.","Mvr.","..."));
    show_form_field("name", "Naam:", "text", $data, "name");
    show_form_field("email", "Email:", "email", $data, "email");
    show_form_field("phone_number", "Telefoonnummer:", "text", $data, "phone_number");
    show_form_field("comment", "Bericht:", "textarea", $data, "comment");
    show_form_field("com_pref","Selecteer communicatievoorkeur:", "radio", $data, "com_pref", array("Email", "Telefoon"));
    show_form_end("Submit", "contact");
}


function show_content($data){
    if (get_variable($data,"thanks")) {
        show_contact_thanks($data);
    } else {
        show_contact_form($data);
    }
}
?>

