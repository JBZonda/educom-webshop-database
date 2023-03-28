<?php
function show_content($data) {
    echo '<div class="register-login">
    <form class="form_register" method="post" action="\educom-webshop-database/index.php">

    <span class="error">'; echo get_variable($data,"errors","generic"); echo '</span><br>
    <label for="name">Oud wachtwoord:</label><br>
    <input type="password" id="name" name="old_password" >
    <span class="error">'; echo get_variable($data,"errors", "old_password"); echo '</span><br>


    <label for="name">Nieuw wachtwoord:</label><br>
    <input type="password" id="name" name="password" >
    <span class="error">'; echo get_variable($data,"errors", "password"); echo '</span><br>
    <label for="name">Herhaal wachtwoord:</label><br>
    <input type="password" id="name" name="password_re" ><br>

    <input type="hidden" name="page" value="change_password"><br>
    <input type="submit" value="Submit">
    </form>
    </div>
    ';
}

?>