<?php

include "../classes/dbh.classes.php";
include "../classes/login.classes.php";
include "../classes/login-contr.classes.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $pass_word = htmlspecialchars($_POST['pass_word']);

    $login = new LoginContr($email, $pass_word);
    $login->loginUser();
    header("Location: ../dashboard.php?error=none");
    exit;
}
