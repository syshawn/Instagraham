<?php 
include 'includes/authcheck.php';
?>

<?php 
    // connect to the database
    $db = mysqli_connect('localhost', 'root', '') or
    die ('Unable to connect. Check your connection parameters.');
    mysqli_select_db($db, '5114asst1' ) or die(mysqli_error($db));
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
    			height: 50px;
    			width: 255px;
    			border-radius: 30px;
    			padding: 0 35px;
    			cursor: pointer;
    			transition: all ease-out 200ms;
    		}
    		
    		.back-btn:hover {
    			background: #E74C3C;
    			border: none;
    		}
    		
    		/*Input form for title and comment*/
    		*:focus {
    			outline: none;
    		}
    
    		.text-group {
    		 	display: flex;
    			justify-content: space-around;
    		 	resize: both;
    		 	overflow: auto;
    		  	width: 445px;
    		  	max-width: 100%;
    		  	height: 99px;
    		  	border: 0;
    		  	background-color: #ffffff;
    		 	border-bottom-left-radius: 41px;
    		  	border-bottom-right-radius: 41px;
    		  	border-top-left-radius: 41px;
    		  	border-top-right-radius: 0;
    		  	box-shadow: 0 1px 7px 0 rgba(75, 128, 182, 0.07);
    		  	margin-bottom: 22px;
    		  	position: relative;
    		  	font-size: 14px;
    		  	color: #4A586A;
    		  	transition: opacity 0.2s ease-in-out, filter 0.2s ease-in-out, box-shadow 0.1s ease-in-out;
    		}
    		
    		.text-group:hover {
    			box-shadow: 4px 5px 20px 0 rgba(0, 0, 0, 0.077);
    		}
    		
    		.text-group input {
    			position: absolute;
    		  	border: 0;
    		  	box-shadow: none;
    		  	background-color: rgba(255, 255, 255, 0);
    		  	top: 0;
    		  	height: 65px;
    		  	width: 100%;
    		  	padding: 40px 53px;
    		  	box-sizing: border-box;
    		  	z-index: 3;
    		  	display: block;
    		  	color: #4A586A;
    		  	font-size: 12px;
    			font-family: "Raleway";
    		  	transition: top 0.1s ease-in-out;
    		}
    			
    		.text-group input::placeholder {
    			color: rgba(0, 0, 0, 0);
    		}
    		
    		.text-group input:focus,
    		.text-group input:not(:placeholder-shown) {
    			top: 17px;
    		}
    			
    		.text-group label {
    		 	position: absolute;
    		 	resize: both;
    		 	overflow: auto;
    		  	border: 0;
    		  	top: 0;
    		  	left: 0;
    		  	right: 0;
    		  	bottom: 0;
    		  	z-index: 2;
    		  	display: flex;
    		  	align-items: top;
    		  	padding: 35px 53px;
    		  	box-sizing: border-box;
    		  	transition: all 0.1s ease-in-out;
    		  	cursor: text;
    		}
    			
    		.text-group input:focus + label,
    		.text-group input:not(:placeholder-shown) + label {
    			bottom: 20px;
    		  	font-size: 12px;
    		  	opacity: 0.7;
    		}
    		
    		/*Upload button*/
      		.upload-btn {
    			border: solid 2px;
    			background: none;
    			font-family: "Raleway";
    			color: #000000;
    			font-size: 10pt;
    			font-weight: bold;
    			display: flex;
    			align-items: center;
    			height: 40px;
    			width: 200px;
    			border-radius: 30px;
    			padding: 0 70px;
    			cursor: pointer;
    			transition: all ease-out 200ms;
    		}
    		
    		.upload-btn:hover {
    			border-style: dotted;
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
                margin-top: 185px;
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
			<div class="logo" onclick="window.location='http://localhost/Coursework/view-post.php';">
				<div class="tooltip">Instagraham
					<span class="tooltiptext" style="font-family:Raleway; font-size: 10px">View Post</span>
				</div>
			</div>
			
			<ul class="navbar" style="cursor:pointer">
			   	<li><span style="margin-left:250px;"><a href="uploadPage.php">
			   	<img src="icon/house-door.svg" alt="home" width="30px" height="30px"></a></span>
			    </li>
			    <!-- Profile Picture -->
    	       	<li>
        	       	<div class="profileIcon" onclick="navFunction()">
                   		<?php 
                            $q = "SELECT profilePhoto FROM creator WHERE idcreator =".$idcreator;
                            if ($res = $db->query($q)) {
                   		        // set the pointer to the first result. If there are no results, tell the user.
                   		        if ($res->data_seek(0)) {
                   		           while ($row = $res->fetch_assoc()) {    // fetch the associative array for the next row
                   		               echo "<p><img src=\"uploads/" . $row['profilePhoto'] . "\" type=\"image/png/jpeg/jpg/gif\" >"; 
                   		               }
                   		        }
               		        }
                        ?>
                   	</div>
            	</li>
            </ul>
            
            <div id="profileIconDropdown" class="profile-content">
            	<a href="profile.php"><img src="icon/person.svg" alt="profile" width="15%">Profile</a>
            	<a href="view-album.php"><img src="icon/asterisk.svg" alt="profile" width="15%">Album</a>
				<a href="settings.php"><img src='icon/gear-wide.svg' alt='setting' width='15%'>Settings</a>
                <a href="logout.php"><img src="icon/arrow-right.svg" alt="setting" width="15%">Logout</a>
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
		
		<div style= "margin-left:260px; margin-top:150px">
   		<?php
    
        // connect to MySQL database
        $mysqli = new mysqli("localhost", "root", "", "5114asst1");
        if ($mysqli->connect_errno) { // if there is an error, output the details
            echo "Failed to connect to MySQL:(" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
        }
    
        // set-up query string
        $q = 'SELECT idalbum, title, imageurl, idcreator FROM album WHERE idalbum=' . $_GET['id'] . ';';
        
        // run query string
        if ($res = $mysqli->query($q)) {
            // if there are results, then output a form for each one (there should only be one though!), otherwise print error
            if ($res->data_seek(0)) {
                while ($row = $res->fetch_assoc()) {
                    //output a form with the photo's details
                    //edit the title
                    echo '<form action="edit-album2.php" method="post" enctype="multipart/form-data">';
                        echo '<div class="text-group" style="margin-left: 230px; margin-top: 30px;">';
                            echo '<input class="form-control" placeholder="albTitle" type="text" name="albumTitle" value="' . $row['title'] . '">';
                            echo '<label>Title</label>';
                        echo '</div>';
                        
                        //hidden idphoto & submit button
                        echo '<p><input type="hidden" name="albumId" value="' . $row['idalbum'] . '">';
                        echo '<p style="margin-top:45px; margin-left:470px"><input class="upload-btn" type="submit" value="Update" name="submit"></p>';
                    echo '</form>';
                }
            }
            else {
                echo "No message found";
				echo ($mysqli -> error);
            }
        }
        else {
            echo "Query error: Please contact your system administrator.";
			
        }
    ?></div>

	</body>
	
    <footer>
    	<div class="footer" style="margin-left:70px">
        	<p>
        		<b>Copyright &copy; 2021 Instagraham Inc.</b><br>
            	Best viewed on Chrome browsers.
            </p>
        </div>
    </footer>
	
</html>