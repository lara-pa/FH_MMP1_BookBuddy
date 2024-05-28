<?php
include "../header.php";

if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sth = $dbh->prepare("SELECT * FROM newuser WHERE username = ?");
    $sth->execute(array($username));
    $userExists = $sth->fetch();

    if ($userExists) {
        $passwordDatabase = $userExists->password;
        $checkPassword = $password == $passwordDatabase;

        if ($checkPassword) {
            echo "Login successful";
            $_SESSION["username"] = $username;
            $_SESSION["user_id"] = $userExists->user_id;

            header("Location: ../index.php");

            exit();
        } else {
            echo "Login failed. Wrong Username or Password";
        }

    } else {
        echo "Login failed. Wrong Username or Password";
    }
}
