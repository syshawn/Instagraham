<?php  
    // connect to the database
    $mysqli = new mysqli("localhost", "root", "", "5114asst1");
    if ($mysqli->connect_error) {   // if there is an error, output the details
        die("Connection failed: " . $mysqli->connect_error);
    }
?>