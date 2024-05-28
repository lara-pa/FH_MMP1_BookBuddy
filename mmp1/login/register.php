<?php
$pagetitle = "Registrieren";
include "../header.php";
?>

<form method="post" action="user_add.php">
    <h3><label for="email">E-Mail:</label></h3>
    <input type="email" name="email" id="email" required>
    <h3><label for="username">Username:</label></h3>
    <input type="text" name="username" id="username" required>
    <h3><label for="password">Password:</label></h3>
    <input type="password" name="password" id="password" required>
    <br><br>

    <button type="submit">Registrieren</button>
</form>
<button><a href="login.php">Login</a></button>

<?php

?>