<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->

<?php
$pagetitle = "Login";
include "../header.php";
?>

<script>
    function linktoRegister() {
        window.location.href = 'register.php';
    }
</script>

<form class="loginform" method="post" action="loginhandling.php">
    <div class="logintitle">
        <h2>Login</h2>
    </div>
    <div class="loginbox">
        <h3><label for="username">Username:</label></h3>
        <input type="text" name="username" id="username" required>

        <h3><label for="password">Passwort:</label></h3>
        <input type="password" name="password" id="password" required>

        <div class="loginbuttondiv">
            <button class="login" type="submit" name="submit">Login</button>
            <button class="login" onclick="linktoRegister()">Registrieren</button>
        </div>
    </div>
</form>


<?php

?>