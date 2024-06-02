<?php
session_start();
include "../classes/dbh.classes.php";
include "../classes/feedback.classes.php";
include "../classes/feedback-contr.classes.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input data
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "";
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
    $candidates = isset($_POST['candidates']) ? htmlspecialchars($_POST['candidates']) : "";
    $msg = isset($_POST['msg']) ? htmlspecialchars($_POST['msg']) : "";



    


    // Instantiate RegisterContr class
    $register = new RegisterContr(
        $name,
        $email,
        $candidates,
        $msg,
    );

    // Call the RegisterUser method with the required arguments
    if ($register->registerUser(
        $name,
        $email,
        $candidates,   
        $msg,
    )) {
        // Registration successful
        header("Location: ../success.php?status=success");
        exit(); 
    }
}