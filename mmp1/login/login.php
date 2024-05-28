<?php
$pagetitle = "Login";
include "../header.php";
?>

<form method="post" action="loginhandling.php">
    <h3><label for="username">Username:</label></h3>
    <input type="text" name="username" id="username" required>

    <h3><label for="password">Password:</label></h3>
    <input type="password" name="password" id="password" required>

    <br><br>

    <button type="submit" name="submit">Login</button>
</form>
<button><a href="register.php">Registrieren</a></button>

<?php

?>