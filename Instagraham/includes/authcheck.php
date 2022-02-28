<?php 
// Initialize the session
session_start();

// get loggedin from session
$loggedin = $_SESSION['loggedin'];

// get idcreator from session
$idcreator = $_SESSION["idcreator"];

// check user login or without login 
if (empty($loggedin)) {

    // if user visit page without login redirect to sign-in page
    echo '<script>window.location.replace("./signin-signup.php");</script>';
    
    }
 ?>