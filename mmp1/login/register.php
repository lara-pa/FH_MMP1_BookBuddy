<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->

<?php
$pagetitle = "Registrieren";
include "../header.php";
?>

<script>
    function linktoLogin() {
        window.location.href = 'login.php';
    }
</script>

<form class="loginform" method="post" action="user_add.php">
    <div class="logintitle">
        <h2>Registrieren</h2>
    </div>
    <div class="loginbox">
        <h3><label for="email">E-Mail:</label></h3>
        <input type="email" name="email" id="email" required>
        <h3><label for="username">Username:</label></h3>
        <input type="text" name="username" id="username" required>
        <h3><label for="password">Password:</label></h3>
        <input type="password" name="password" id="password" required>

        <div class="loginbuttondiv">
            <button class="login" type="submit">Registrieren</button>
            <button class="login" onclick="linktoLogin()">Login</button>
        </div>
    </div>
</form>

<?php

?>