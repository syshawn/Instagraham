<?php 
include '../connection.php';
include 'includes/authcheck.php';
$update_query = "UPDATE creator SET ";

    /* Getting file name */
    
    if(isset($_FILES['file']['name'])){
        $tmp = $_FILES["file"]["tmp_name"];
        $filename = $_FILES['file']['name'];
    }else{
        $filename="";
    }

    // /* Location */
     $location = '../uploads/'.$filename;

     $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
     $imageFileType = strtolower($imageFileType);
 
    /* Valid extensions */
    $valid_extensions = array("jpg","jpeg","png","gif");
 
    /* value */
    $name = $_POST['name'];
    $website = $_POST['website'];
    $bio = $_POST['bio'];
    $email = $_POST['email'];
    $phoneNo = $_POST['phoneNo'];
    $gender = $_POST['gender'];
    $profilePhoto = $filename;
    $idcreator = $_POST['idcreator'];

    $update_query .= "name ="."'".$name."',";
    $update_query .= "website ="."'".$website."', ";
    $update_query .= "bio ="."'".$bio."', ";
    $update_query .= "email ="."'".$email."', ";
    $update_query .= "phoneNo ="."'".$phoneNo."', ";
    $update_query .= "gender ="."'".$gender."', ";
    $update_query .= "profilePhoto ="."'".$profilePhoto."' ";
    $update_query .= "WHERE idcreator = ".$idcreator;

     if ($mysqli->query($update_query) === TRUE) {
       
         if(in_array(strtolower($imageFileType), $valid_extensions)) {
        //     /* Upload file */
        if(move_uploaded_file($tmp,$location)){
            echo json_encode(true);
         }
         }else{
             echo json_encode('withoutimage');
          }
         
         
     }else{
         echo json_encode(false);
        }


$mysqli->close();
 ?>