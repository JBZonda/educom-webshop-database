<?php

function show_upload_form($data){
    show_form_start("upload","upload_form",$data, $extra_option='enctype="multipart/form-data"');
    show_form_field("title", "Title:","text",$data,"title");
    show_form_field("discription", "Beschrijving:", "textarea", $data, "discription");
    show_form_field("price", "Prijs:","text",$data,"price");
    show_form_field("image", "Foto:","file",$data,"image");
    #echo '<input type="file" name="fileToUpload" id="fileToUpload">';
    show_form_end("Upload","upload");
}

function show_content($data) {
    show_upload_form($data);
}
?>