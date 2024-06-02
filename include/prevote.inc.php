<?php
session_start();
include "../classes/dbh.classes.php";
include "../classes/prevote.classes.php";
include "../classes/prevote-contr.classes.php";


function generateUniqueId() {
    $year = date('Y'); // Current year
     $randomNumber = mt_rand(100, 999); //random number
    $profileid = 'VOTE' . "/". $year . "/" . $randomNumber; // Combine to form the unique ID
    return $profileid;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input data
    $v_img = isset($_POST['v_img']) ? htmlspecialchars($_POST['v_img']) : "";
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "";
    $precandidate = isset($_POST['precandidate']) ? htmlspecialchars($_POST['precandidate']) : "";
    $vicecandidate = isset($_POST['vicecandidate']) ? htmlspecialchars($_POST['vicecandidate']) : "";
    //Generating Staff Id
    $profileid = generateUniqueId();
    

    


    // Instantiate RegisterContr class
    $register = new RegisterContr(
        $v_img, $name, $precandidate, $vicecandidate, $profileid);

    // Call the RegisterUser method with the required arguments
    if ($register->registerUser(
          $v_img, $name, $precandidate, $vicecandidate, $profileid
        )) {
        // Registration successful
        header("Location: ../secvote.php?name=" .$name);
        exit(); 
    }
}