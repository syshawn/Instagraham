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
    		/*Scroll Bar*/
    		/* width */
    		::-webkit-scrollbar {
    			width: 8px;
    		}
    		
    		/* Track */
    		::-webkit-scrollbar-track {
    		  	background: #ffffff; 
    		}
    		 
    		/* Handle */
    		::-webkit-scrollbar-thumb {
    		  	background: #8E9AA8; 
    		  	border-radius: 10px;
    		}
    		
    		/* Handle on hover */
    		::-webkit-scrollbar-thumb:hover {
    		  	background: #4A586A; 
    		}
    		
    		/*Image adjustment*/	
            .photos img {
              display: block;
              margin-left: auto;
              margin-right: auto;
            }
            
            /* Profile picture (navbar) */
            .profileIcon img {
                border-radius: 50%;
                width:30px; 
                height:30px;
                object-fit: cover;
                margin-left: -290px;
            }
            .profileIcon2 img {
                border-radius: 50%;
                width:30px; 
                height:30px;
                object-fit: cover;
    
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
            	<a href="profile.php"><img src="icon/person.svg" alt="profile" width="15%"> Profile</a>
            	<a href="view-album.php"><img src="icon/asterisk.svg" alt="profile" width="15%"> Album</a>
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
		<br><br><br><br>
		
	<?php 
        // create new MySQL interface object
        $mysqli = new mysqli("localhost", "root", "", "5114asst1");
        if ($mysqli->connect_errno) {   // if there is an error, output the details
            echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        $q = "SELECT idphoto, title, imageurl, comment, idcreator  FROM photo ORDER BY idphoto DESC;";
        // execute SQL query. If there is an error, print an eror message. 
        if ($res = $mysqli->query($q)) {
            // set the pointer to the first result. If there are no results, tell the user.
            if ($res->data_seek(0)) {     
                    while ($row = $res->fetch_assoc()) {    // fetch the associative array for the next row
                        // output the creator, title, image and comment stored in that row
                       
                        //Print the title and included the edit & delete function
                        
                        echo '<div class="column top" style="font-size:9pt; padding-top:15px;height: 50px;">';
                        ?>
                   		<?php 
                            $q2 = "SELECT name, profilePhoto FROM creator WHERE idcreator =".$row['idcreator'];
                            if ($result2 = $db->query($q2)) {
                   		        // set the pointer to the first result. If there are no results, tell the user.
                   		        if ($result2->data_seek(0)) {
                   		           while ($row2 = $result2->fetch_assoc()) {    // fetch the associative array for the next row
                   		               echo "<p class='profileIcon2'><img  src=\"uploads/" . $row2['profilePhoto'] . "\" type=\"image/png/jpeg/jpg/gif\" >"; 
                                          echo "<p><b>" . $row2['name'] . "</b></p>";
                   		               }
                   		        }
               		        }
                        ?>
                   	
                       <?php
                            
                            echo '<span style="float:right; margin-left:250px">';
                            echo '<div class="dropdown">';
                                echo '<img src="icon/three-dots.svg" alt="Add" width="20px" height="20px" onclick="myFunction()" class="imgdots">';
                                echo '<div id="DropdownMenu" class="dropdown-content">';
                                    echo "<a href=\"edit-message.php?id=" . $row['idphoto'] . "\">Edit</a>";
                                    echo "<a href=\"delete-photo.php?id=" . $row['idphoto'] . "\">Delete</a>";
                                echo '</div>';
                            echo '</div>';
                            echo '</span>';
                        echo '</div>';
                        
                        echo '<script>';
                            /* When the user clicks on the button, toggle between hiding and showing the dropdown content */
                            echo 'function myFunction() {';
                            echo '    document.getElementById("DropdownMenu").classList.toggle("show");';
                            echo '}';
                            
                            // Close the dropdown if the user clicks outside of it
                            echo 'window.onclick = function(event) {';
                            echo "    if (!event.target.matches('.imgdots')) {";
                            echo '        var dropdowns = document.getElementsByClassName("dropdown-content");';
                            echo '        var i;';
                            echo '        for (i = 0; i < dropdowns.length; i++) {';
                            echo '            var openDropdown = dropdowns[i];';
                            echo "            if (openDropdown.classList.contains('show')) {";
                            echo "               openDropdown.classList.remove('show');";
                            echo '            }';
                            echo '        }';
                            echo '    }';
                            echo '}';
                        echo '</script>';
                        
                        //Show the uploaded image
                        echo '<div class="column middle">';
                        echo '<span style="margin=left:100px">';
                            echo '<dic class="photos">';
                            echo "<p><img src=\"uploads/" . $row['imageurl'] . "\" type=\"image/png/jpeg/jpg/gif\" height='280px' width='auto'>";
                            echo '</img></p>';
                            echo '</div>'; 
                        echo '</span>';
                        echo '</div>';    
                        
                        // Print the comment 
                        echo '<div class="column bottom">';
                        echo "<h3><b>" . $row['title'] . "</b></h3><br>";
                            echo "<b>Comment : &ensp; </b>" . $row['comment'] . "<br>\n";
                        echo '</div>';
                        echo "<br><br><br><br>";
                }
            }
            else {
                echo '<div style="text-align:center;">';
                    echo "No Images found.";   // no results
                echo '</div>';
            }
        }
        else {
            echo "Query error: Please contact your system adminstrator.";   
        }
        echo "</div>";
    ?>
    
        <!-- Back to Top function -->
    	<button onclick="topFunction()" id="topBtn" title="Go to top">
    	<i class="icon-chevron-up"></i></button>
			
		<script>
			//Get the button
			var mybutton = document.getElementById("topBtn");

			// When the user scrolls down 20px from the top of the document, show the button
			window.onscroll = function() {scrollFunction()};

			function scrollFunction() {
				if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				mybutton.style.display = "block";
				} else {
				mybutton.style.display = "none";
				}
			}

			// When the user clicks on the button, scroll to the top of the document
			function topFunction() {
				document.body.scrollTop = 0;
				document.documentElement.scrollTop = 0;
			}
		</script>
    
    </body>
    
    <footer>
    	<div class="footer">
        	<p>
        		<b>Copyright &copy; 2021 Instagraham Inc.</b><br>
            	Best viewed on Chrome browsers.
            </p>
        </div>
    </footer>
</html>