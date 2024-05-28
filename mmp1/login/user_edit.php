<?php
session_start();
include "functions.php";
$pagetitle = "Benutzer bearbeiten";
include "header.php";

if (isset($_SESSION['USER']) && ($_SESSION['USER'] == "admin")) {
    $username = htmlspecialchars($_GET['username']);
    $useredit = $dbh->prepare("SELECT * FROM newuser WHERE username = ?");
    $useredit->execute([$username]);
    $user = $useredit->fetch(PDO::FETCH_OBJ);
    ?>

    <form method="post" action="user_editor.php">
        <div>
            <h3><label for="email">E-Mail:</label></h3>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user->email) ?>" required>
        </div>

        <div>
            <h3><label for="username">Username:</label></h3>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user->username) ?>"
                required>
            <input type="hidden" name="original_username" value="<?php echo htmlspecialchars($username) ?>">
        </div>

        <div>
            <h3><label for="password">Password (leer lassen, um nicht zu ändern):</label></h3>
            <input type="password" name="password" id="password">
        </div>

        <div>
            <a class="cancel" href="user_list.php">Abbrechen</a>
            <p><input type="submit" value="Ändern"></p>
        </div>
    </form>

    <?php
} else {
    header("Location: login.php");
    exit;
}
?>