<?php
session_start();
include "../classes/dbh.classes.php";
include "../classes/regteacher.classes.php";
include "../classes/regteacher-contr.classes.php";


function generateUniqueId() {
    $year = date('Y'); // Current year
     $randomNumber = mt_rand(10, 99); //random number
    $profileid = 'CAN' . "/". $year . "/" . $randomNumber; // Combine to form the unique ID
    return $profileid;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input data
    $profile_pics = isset($_POST['profile_pics']) ? htmlspecialchars($_POST['profile_pics']) : "";
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "";
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
    $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : "";
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
    $dob = isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : "";
    $state = isset($_POST['state']) ? htmlspecialchars($_POST['state']) : "";
    $dep = isset($_POST['dep']) ? htmlspecialchars($_POST['dep']) : "";
    $level = isset($_POST['level']) ? htmlspecialchars($_POST['level']) : "";
    $position = isset($_POST['position']) ? htmlspecialchars($_POST['position']) : "";
    $why = isset($_POST['why']) ? htmlspecialchars($_POST['why']) : "";
    $matric = isset($_POST['matric']) ? htmlspecialchars($_POST['matric']) : "";
    $pass_word = isset($_POST['pass_word']) ? htmlspecialchars($_POST['pass_word']) : "";
    //Generating Staff Id
    $profileid = generateUniqueId();
    

    


    // Instantiate RegisterContr class
    $register = new RegisterContr(
        $profile_pics, $name, $gender, $email, $dob, $state, $dep, $level, $position, $why, $matric,  $pass_word, $profileid);

    // Call the RegisterUser method with the required arguments
    if ($register->registerUser(
          $profile_pics, $name, $gender, $email, $dob, $state, $dep, $level, $position, $why, $matric, $pass_word, $profileid
        )) {
        // Registration successful
        header("Location: ../addteacher.php?status=sucess");
        exit(); 
    }
}