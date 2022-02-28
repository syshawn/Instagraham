<?php 
include 'includes/authcheck.php';
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Instagraham</title>
	
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Link for the Cascading Style Sheets -->
		<link rel="stylesheet" href="Instagraham.css">
		
		<!-- Link for the logo font style -->
		<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet'>
		
		<!-- Link for the body font style -->
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
		
		<!-- Back To Top -->
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

		<style>
    		/*Back Button*/
            .back-btn {
    			background: none;
    			border: solid 2px #000000;
    			border-style: dotted;
    			font-family: "Raleway";
    			color: #000000;
    			font-size: 10pt;
    			font-weight: bold;
    			display: flex;
    			align-items: center;
    			height: 35px;
    			width: 150px;
    			border-radius: 30px;
    			padding: 0 40px;
    			cursor: pointer;
    			transition: all ease-out 200ms;
    		}
    		
    		.back-btn:hover {
    		    border: solid 2px #000000;
    		}

            /*Animated Button*/
            *:focus {
			    outline: none;
		    }
		    
            .button {
                border-radius: 30px;
                background-color: #E74C3C;
                border: none;
                color: #000000;
                text-align: center;
                font-size: 14px;
                padding: 10px;
                width: 150px;
                transition: all 0.5s;
                cursor: pointer;
                margin: 5px;
            }
            
            .button span {
                cursor: pointer;
                display: inline-block;
                position: relative;
                transition: 0.5s;
            }
            
            .button span:after {
                content: '\00bb';
                position: absolute;
                opacity: 0;
                top: 0;
                right: -20px;
                transition: 0.5s;
            }
            
            .button:hover span {
                padding-right: 25px;
            }
            
            .button:hover span:after {
                opacity: 1;
                right: 0;
            }	
            
            /* Profile picture (navbar) */
            .profileIcon img {
                border-radius: 50%;
                width:30px; 
                height:30px;
                object-fit: cover;
                margin-left: -290px;
            }	
            
            /* Navigation Button (ProfileIcon) */
            .profile-content {
                display: none;
                position: absolute;
                min-width: 100px;
                z-index: 1;
                margin-left: 1010px;
                margin-top: 150px;
                box-shadow: 0 5px 10px 0 #F7F7F7, 0 2px 2px 0 rgba(0, 0, 0, 0.19);
            }
            
            .profile-content a {
                float: none;
                font-size: 10pt;
                background-color: #F6F6F6;
                color: black;
                padding: 10px 10px;
                text-decoration: none;
                display: block;
                text-align: left;
            }
    
            .profile-content a:hover {
                background-color: #EEEEEE;
            }
            
            .show {display: block;}
		</style>
	</head>
	
	<body>
	
		<!-- Navigation bar -->
		<nav>
			<div class="logo" onclick="window.location='view-post.php';">
				<div class="tooltip">Instagraham
					<span class="tooltiptext" style="font-family:Raleway; font-size: 10px">View Post</span>
				</div>
			</div>
			
			<ul class="navbar" style="cursor:pointer">
			   	<li><span style="margin-left:250px;"><a href="upload.html">
			   	<img src="icon/house-door.svg" alt="home" width="30px" height="30px"></a></span>
			    </li>
			    <!-- Profile Picture -->
    	       	<li>
        	       	<div class="profileIcon">
                   		<img src="uploads/xinyi.jpg" alt="profile" onclick="navFunction()">
                   	</div>
            	</li>
            </ul>
            
            <div id="profileIconDropdown" class="profile-content">
            	<a href="profile.php"><img src="icon/person.svg" alt="profile" width="15%"> Profile</a>
                <a href="settings.php"><img src="icon/gear-wide.svg" alt="setting" width="15%"> Settings</a>
                <a href="logout.php"><img src="icon/arrow-right.svg" alt="setting" width="15%"> Logout</a>
            </div>
		</nav>
		
		<script>
        /* When the user clicks on the button, toggle between hiding and showing the dropdown content */
        function navFunction() {
        	document.getElementById("profileIconDropdown").classList.toggle("show");
        }
        
        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
        	if (!event.target.matches('.profileIcon img')) {
            	var dropdowns = document.getElementsByClassName("profile-content");
            	var i;
            	for (i = 0; i < dropdowns.length; i++) {
              		var openDropdown = dropdowns[i];
              		if (openDropdown.classList.contains('show')) {
                	openDropdown.classList.remove('show');
              		}
            	}
          	}	
        }
        </script>
		<br><br>
		
    	<div style= "margin-left:230px; margin-top:150px">
    	
        <?php
            $imagetitle = $_POST ['imgtitle'];
            $imagecomment = $_POST ['imgcomment'];
            $albumOption = $_POST ['albumOption'];
            $target_dir="uploads";
            $target_filename = basename($_FILES["fileToUpload"]["name"]);
            $file_tmp =$_FILES['fileToUpload']['tmp_name'];
            $file_name = $_FILES['fileToUpload']['name'];
            $location = 'uploads/'.$file_name;
            $target_file = $target_dir. $target_filename;

            $uploadOk = TRUE;
            
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            if($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "gif"){
                echo "Error: only <b>.png, .jpg, .jpeg and .gif</b> files format are allowed. ";
                $uploadOk = FALSE;
            }
            
            if ($uploadOk) {
                $mysqli = new mysqli("localhost", "root", "", "5114asst1");
                if ($mysqli->connect_errno) {
                    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                }
                
                $q = "INSERT INTO photo (title, imageurl, comment, idcreator, idalbum ) VALUES ('" . $imagetitle . "','" . $target_filename. "','" . $imagecomment . "','" . $idcreator . "','" . $albumOption . "')";
                       
                if ($mysqli->query($q)) {
                    echo "<p>The image <b>$target_filename</b> has been uploaded.</p>";
                    echo "<p>Successfully added to database.</p>";
                    move_uploaded_file($file_tmp,$location);
                }
                else {
                    echo "<p>Something went wrong. Please contact your system adminstrator.</p>";
                }
            }
        ?>
        
        <br><br><br>
        
        <!-- Back Button -->
        <div style= "cursor:pointer" onclick="window.location='http://localhost/Coursework/upload.html'" class="back-btn">&#x0003C; &ensp; Back </div><br>
        
        <!-- Animated Button -->
        <form action="view-post.php">
        	<button class="button">
               	<span>View Post</span>
            </button>
        </form>
        </div>
  	</body>
	
    <footer>
    	<div class="footer" style="margin-left: -440px; margin-top: 240px">
        	<p>
        		<b>Copyright &copy; 2021 Instagraham Inc.</b><br>
            	Best viewed on Chrome browsers.
            </p>
        </div>
    </footer>
</html>