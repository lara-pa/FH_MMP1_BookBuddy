<!-- Author: Lara Pantlitschko
MultiMediaTechnology / FH Salzburg
Purpose: MultiMediaProjekt 1 -->

<?php
$pagetitle = "Benutzer bearbeiten";
include "../header.php";

if (isset($_SESSION['username'])) {
    if (isset($_GET['username']) && !empty($_GET['username'])) {
        $username = htmlspecialchars($_GET['username']);
        $useredit = $dbh->prepare("SELECT * FROM newuser WHERE username = ?");
        $useredit->execute([$username]);
        $user = $useredit->fetch(PDO::FETCH_OBJ);

        if ($user) {
            ?>

            <form class="loginform" method="post" action="user_editor.php">
                <div class="loginbox">
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
                        <h3><label for="password">Passwort:</label></h3>
                        <input type="password" name="password" id="password">
                    </div>

                    <div>
                        <a class="cancel" href="../index.php">Abbrechen</a>
                        <p><input type="submit" value="Ändern"></p>
                    </div>
                </div>
            </form>

            <?php
        } else {
            echo "Benutzer nicht gefunden.";
        }
    } else {
        echo "Fehler: Kein Benutzername angegeben.";
    }
} else {
    header("Location: login.php");
    exit;
}
?>