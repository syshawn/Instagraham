<?php 
include '../connection.php';
$return_arr = array();
$select_query = "SELECT name,website,imageurl,bio,email,phoneNo,gender,username ,created_at,profilePhoto FROM creator WHERE idcreator = ";
// update
$update_query = "UPDATE creator SET ";

//check auth
$auth_query = "SELECT password FROM creator WHERE idcreator = ";

//delete
$delete_query = "DELETE FROM creator WHERE idcreator = ";

// delete account START
if(isset($_POST['delete_account'])){
    
    //get id from post method 
    $idcreator = $_POST['idcreator'];
    
    $delete_query.= $idcreator;
    
    // run delete query in mysql
    if ($mysqli->query($delete_query) === TRUE) {

        //return true when query successfully
        echo json_encode(true);
    } else {
        //return false when query failed
        echo json_encode(false);
    }   
}
// delete account END

// get account detail START
if(isset($_POST['acc_detail'])){
    //get id from post method 
    $idcreator = $_POST['idcreator'];
    
    $select_query .= $idcreator;
    
    //run query in mysql
    $result = $mysqli->query($select_query);
    
    //return row of data from result
    while($row = $result->fetch_assoc()){
        
        $name = $row['name'];
        $website = $row['website'];
        $imageurl = $row['imageurl'];
        $bio = $row['bio'];
        $email = $row['email'];
        $phoneNo = $row['phoneNo'];
        $created_at = $row['created_at'];
        $profilePhoto = $row['profilePhoto'];
        $gender = $row['gender'];
        $username = $row['username'];
        
        $return_arr[] = array(
            "name" => $name,
            "website" => $website,
            "imageurl" => $imageurl,
            "bio" => $bio,
            "email" => $email,
            "phoneNo" => $phoneNo,
            "created_at" => $created_at,
            "profilePhoto" => $profilePhoto,
            "gender" => $gender,
            "username" => $username,
            
        );
    }
    
    // Encoding array in JSON format
    echo json_encode($return_arr);
}
// get account detail END

// change password START
if(isset($_POST['change_password'])){
    
    //get id from post method 
    $idcreator = $_POST['idcreator'];
    
    //get password post method 
    $new_pw = $_POST['new_pw'];
    
    //hash password
    $hash_pw = password_hash($new_pw, PASSWORD_DEFAULT);
    
    $update_query .= "password = "."'".$hash_pw."'"." WHERE idcreator = ".$idcreator;
    
    // run delete query in mysql
    if ($mysqli->query($update_query) === TRUE) {
        
        //return true when query successfully
        echo json_encode(true);
    } else {
        
        //return false when query failed
        echo json_encode($update_query);
    } 
}
// change password END

// validate password START
if(isset($_POST['validate_pw'])){
    
    //get id from post method 
    $idcreator = $_POST['idcreator'];
    
    //get password post method 
    $old_pw = $_POST['old_pw'];
    
    $auth_query .= $idcreator;

       //run query in mysql
       $result = $mysqli->query($auth_query);
    
       //return row of data from result
       while($row = $result->fetch_assoc()){
           $pw = $row['password'];
        }

        if (password_verify($old_pw, $pw))
        {
            // return true if password is correct.
            echo json_encode(true);
        } else {
           // return false if password is incorrect.
            echo json_encode(false);
        }
    
}
// validate password END


$mysqli->close();
 ?>