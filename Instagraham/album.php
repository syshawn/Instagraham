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
			/*Split container*/
			.split {
				height: 100%;
			  	width: 50%;
			  	position: fixed;
			  	z-index: 1;
			  	top: 0;
			  	overflow-x: hidden;
			  	padding-top: 20px;
			}
			
			.left {
			  	left: 0;
			}
			
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
    			margin-top: 25px;
    			height: 55px;
    			width: 250px;
    			border-radius: 30px;
    			padding: 0 40px;
    			cursor: pointer;
    			transition: all ease-out 200ms;
    		}
    		
    		.back-btn:hover {
    		    background-color: #E74C3C;
    		    border: none;
    		}
						
			/*Vertical Line*/
			.vl {
				display: flex;
				justify-content: space-around;
				border-left: 6px solid #F0F0F0;
			  	border-radius: 2px;
			  	height: 225px;
			  	margin-left: 725px;
			  	margin-top: 150px;
			}
			
			.right {
			  	right: 0;
			}
			
			/*Upload Image*/
			input[type="file"]{
				position: absolute;
				top: -9999px;
				left: -9999px;
			}
			
			.label{
				background: #8E9AA8;
				color: #000000;
				font-size: 10pt;
				font-weight: bold;
				display: flex;
				align-items: center;
				height: 50px;
				width: 255px;
				border-radius: 30px;
				padding: 0 25px;
				cursor: pointer;
				transition: all ease-out 200ms;
			}
			
			.label:not(.chosen):hover{
				background: #4A586A;
			}
			
			.label img{
				width: 20px;
				margin-right: 15px;
			}
			
			.label.chosen{
				background: #B53737;
			}
			
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
			
			/*Submit button*/
			.submit-btn {
				border: solid 2px;
				background: none;
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
			
			.submit-btn:hover {
				border-style: dotted;
			}

            .flex-container {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
				justify-content: space-around;
                padding: 100px;
            }
            
            .flex-items {
				display: flex;
				flex-direction: column;
				position: relative;
                width: 200px;
                height: 150px;
				z-index: 4;
				margin: 30px;
				

            }

			.thumbnails:hover .layer1{
				top: -80px; 
				left: -100px; 
				transform: rotate(-20deg);
				
			}

			.thumbnails:hover .layer2 {
				top: -110px; 
				
			}

			.thumbnails:hover .layer3 {
				top: -80px;
				left: 100px;
				transform:rotate(20deg);
				
			}

			.thumbnails {
				display: flex;
				position: relative;
				width: 200px;
				height: 100px;
				justify-content: center;
				margin-bottom: 10px;
				
			}

			.title {
				position: relative;
				
				width: auto;
				height: 30px;
				background-color: #787878;
			}

            .layer1 {
				position: absolute;
				
                z-index: 3;
                background-color: #FFFF00 ;
				border-radius: 25px;
                border: 2px solid #000000;
                width: 150px;
                height: 100px;
				transition:transform 2s top 2s left 2s width height ease ;
				
				
            }

            .layer2 {
				position: absolute;
                z-index: 2;
                background-color: #787878;
				border-radius: 25px;
                border: 2px solid #000000;
				width: 150px;
                height: 100px;
				transition: top 2s left 2s transform 2s ease ;
            }

            .layer3 {
				position: absolute;
                z-index: 1;
                background-color: #232323;
				border-radius: 25px;
                border: 2px solid #000000;
				width: 150px;
                height: 100px;
				transition: top 2s left 2s transform 2s ease ;
            }

            @media (max-width: 800px) {
                .flex-container {
                    flex-direction: column;
                    flex-wrap: wrap;
                    justify-content: space-around;
                }
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
		
		<form action="add-album.php" method="post" enctype="multipart/form-data">
			<!-- Album name -->
			<div class="split left" style= "margin-left:230px; margin-top:150px">
  				<div class="centered">
  					<p style="font-size:11pt; margin-left:20px"><b>Step 1</b> Write your album name below: </p>
						<div class="text-group" style="margin-top: 30px;">
							<input class="form-control" type="text" name="albumTitle" placeholder="albumTitle">
					  		<label>Album Title</label>
						</div>
				</div>
				
			</div>
			
			<!-- Vertical Line -->
			<div class="vl"></div>
			
			<!--Add album -->
			<div class="split right" style= "margin-left:100px; margin-top:150px">
     			<div class="centered">
        			<p style="font-size:11pt; margin-left:3px"><b>Step 2</b> Add album </p><br><br>
        			<input type="submit" class="submit-btn" value="Add Album" name="Submit">
            	</div>
            	
            	<!-- Back Button -->
        		<div style= "cursor:pointer" onclick="window.location='http://localhost/Coursework/uploadPage.php'" class="back-btn">&#x0003C; &ensp; Back </div><br>
        
			</div>
		</form>
		<br><br>	

	</body>
	
    <footer>
    	<div class="footer" style="margin-left: -400px; margin-top: 50px">
        	<p>
        		<b>Copyright &copy; 2021 Instagraham Inc.</b><br>
            	Best viewed on Chrome browsers.
            </p>
        </div>
    </footer>
	
</html>