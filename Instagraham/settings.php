<!DOCTYPE html>
<?php 
include 'includes/authcheck.php';

$idcreator = $_SESSION["idcreator"];
?>

<?php
    // connect to the database
    $db = mysqli_connect('localhost', 'root', '') or
    die ('Unable to connect. Check your connection parameters.');
    mysqli_select_db($db, '5114asst1' ) or die(mysqli_error($db));
?>

<html lang="en">

	<head>
		<title>Instagraham</title>
	
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Cascading Style Sheets -->
		<link rel="stylesheet" href="Instagraham.css">
		
		<!-- Logo font style -->
		<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet'>
		
		<!-- Body font style -->
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
		
		<!-- Symbols -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
		
		<!-- Back To Top -->
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
		
		<!-- Sweet Alert -->
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
		
		<!-- Jquery -->
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <script src="./includes/js/acc_setting.js"></script>
	
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
    	
    	/* Setting */
        .settingContainer {
            width: 65%;
            height: 700px;
            margin: 0 auto;
            position: relative;
	        background-color: #ffffff;
	        box-shadow: 0 5px 10px 0 #F7F7F7, 0 2px 2px 0 rgba(0, 0, 0, 0.19);
        }
    
        /* Navigation tabs for setting */
        .navSetting {
            position: absolute;
    	    width: 20%;
    	    height: 700px;
	        background-color: #ffffff;
	        box-shadow: 0 5px 10px 0 #F7F7F7, 0 2px 2px 0 rgba(0, 0, 0, 0.19);
        }
        
        .navSetting a {
            list-style: none;
            padding: 25px 25px 25px;
            color: #000000;
            font-size: 1.1em;
            display: block;
            transition: all ease-in-out;
        }
                
        .navSetting a:hover {
            color: #000000;
            cursor: pointer;
            background-color: #FBFBFB;
            border-left: 3px solid #DEDEDE;
        }
        
        .navSetting a:first-child {
            margin-top: 7px;
        }
        
        .navSetting a.active {
            font-weight: bold;
            border-left: 3px solid #000000;
        }
        
        /* Settingcontent */
        .Settingcontent {
    	    margin-left: 30%;
    	    width: 65%;
    	    display: block;
    	    margin-top: 50px;
    	    padding: 35px 0px 35px;
    	    position: relative;
            z-index: 1;

        }
        
        /* Change styles for Setting Content on extra small screens */
        @media screen and (max-width: 300px) {
          .Settingcontent {
             width: 100%;
          }
        }
        
        .tabShow {
            transition: all .5s ease-in;
            width: 100%; 
        }
        
        /* Profile picture */
        .profile img {
            border-radius: 50%;
            width:50px; 
            height:50px;
            object-fit: cover;
        }
        
        /* Profile picture (navbar) */
        .profileIcon img {
            border-radius: 50%;
            width:30px; 
            height:30px;
            object-fit: cover;
            margin-left: -290px;
        }
        
        .input, select {
            border: 0;
            border-bottom: 2px solid #D9D9D9;
            width: 80%;
            font-family: "Raleway";
            font-size: 10pt;
            padding: 7px 0;
            color: #070707;
            outline: none;
            margin-top: -8px;
        }
        
        span {
            color: #707070;
        }
        
        ::-webkit-input-placeholder {
            color: #D5D5D5;
        }
        
        ::-moz-placeholder {
            color: #D5D5D5;
        }
        
        ::-ms-placeholder {
            color: #D5D5D5;
        }
        
        ::placeholder {
            color: #D5D5D5;
        }
        
        .gender {
            margin-left:100px; 
            margin-top:-18px;
        }
        
        /* Submit / Change Password Button */
        .submitbtn, .changePasswbtn, .checkPasswbtn{
            font-size: 10pt;
            border-radius: 12px;
            color: #000000;
            font-weight: bold;
            border: 0;
            background: #8E9AA8;
            padding: 7px 15px;
            cursor: pointer;
            width: 25%;
    	    display: block;
            margin-top: 15px; 
            margin-left: 95px;
        }
        
        .submitbtn:hover, .changePasswbtn:hover,.checkPasswbtn:hover{
		    border: solid 2px;
			background: none;
			border-style: dotted;
		}
		
		/* Delete Account Button */
		.deleteAccountbtn {
            font-size: 10pt;
            border-radius: 12px;
            padding: 7px 15px;
            cursor: pointer;
            width: 25%;
            display: block;
            border: solid 2px;
            color: #000000;
			background: none;
			border-style: dotted;
        }
        
        .deleteAccountbtn:hover {
            font-weight: bold;
            border: 0;
            background: #E74C3C;
		}
        
        .tabShow {
            display: none;
        }
        
        .oldPassw, .newPassw, .confirmPassw {
            margin-left:100px; 
            margin-top:-18px;
        }
        
        .newPassw i {
            margin-left: -30px;
            cursor: pointer;
        }
        
        /* Float cancel and delete buttons and add an equal width */
        .cancelbtn, .deletebtn {
            float: left;
            width: 50%;
            padding: 10px 15px;
            cursor: pointer;
            border: none;
        }
        
        .cancelbtn:hover {
            background-color: #EEEEEE;
            border: none;
        }
        
        .deletebtn:hover {
            background-color: #FF5746;
            border: none;
        }
        
        /* Add a color to the cancel button */
        .cancelbtn {
            background-color: #DEDEDE;
            color: black;
        }
        
        /* Add a color to the delete button */
        .deletebtn {
            background-color: #E74C3C;
        }
        
        /* Add padding and center-align text to the container */
        .deletecontainer {
            padding: 16px;
            text-align: center;
        }
        
        /* The dialogbox (background) */
        .deleteAccount {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 50%; 
            height: 50%; 
            margin-top:225px;
            margin-left:430px;
            overflow: auto; /* Enable scroll if needed */
            padding-top: 50px;
        }
        
        /* Content/Box */
        .deleteAccount-content {
            background-color: #F8F8F8;
            margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
            border-radius: 25px;
            box-shadow: 0 5px 10px 0 #F7F7F7, 0 2px 2px 0 rgba(0, 0, 0, 0.19);
            width: 80%; /* Could be more or less, depending on screen size */
        }
        
        /* Style the horizontal ruler */
        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }
         
        /* Close Button (x) */
        .close {
            position: absolute;
            right: 35px;
            top: 15px;
            font-size: 40px;
            font-weight: bold;
            color: #000000;
        }
        
        .close:hover,
        .close:focus {
            color: #313847;
            cursor: pointer;
        }
        
        /* Clear floats */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        
        /* Change styles for cancel button and delete button on extra small screens */
        @media screen and (max-width: 300px) {
          .cancelbtn, .deletebtn {
             width: 100%;
          }
        }
    	
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
		
		<!-- Margin adjustment -->
		<div style="margin-left:-50px; margin-top:50px">
		
		<!-- Setting -->
		<div class="settingContainer">
		  
            <!-- Navigation tabs for setting -->
			<div class="navSetting" id="navSetting">
    			<a onclick="tabs(0)" class="tab active">
    		  		Edit Profile
    		  	</a>
    		  	
    		  	<a onclick="tabs(1)" class="tab">
    		  		Change Password
    		  	</a>
    		  	
    		  	<a onclick="tabs(2)" class="tab">
    		  		Manage Account
    			</a>
		  	</div>
			
	    <!-- Content -->
		<div class="Settingcontent">
    	       	   
    	   <!-- Edit Profile -->
    	   <form class="profileform" method="post" enctype="multipart/form-data">
    	   <div class="editprofile tabShow">
    	       
    	       <!-- Profile Picture -->
        	   <div class="profile">
               	
                       <img id="blah" src="http://placehold.it/180" alt="your image" />
                       
               </div>
               
               <!-- Username -->
    	   	   <p id="show_username" style="margin-left:100px; margin-top:-55px; font-size:18pt"></p>
    	   	   
    	   	   <!-- Change Profile Picture --> 	   	   
    	   	   <div style="margin-left:100px; margin-top:10px; font-size:10pt; color:#4A586A">
               	  	<label for="changeProfile" class="btn" style="cursor:pointer"><b>Change Profile Photo</b></label>
                  	<input type='file' onchange="readURL(this);"  name="file" id="changeProfile" style="visibility:hidden" accept="image/x-png,image/gif,image/jpeg"/>

                      <script>
                             function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function (e) {
        $("#blah").attr("src", e.target.result);
      };
  
      reader.readAsDataURL(input.files[0]);
    }
  }
                       </script>

                  	<br><br>
               </div>
    	 

               <!-- Name -->
               <label for="name"><b>Name</b></label> 
               <div style="margin-left:100px; margin-top:-18px">
               		<input type="text" class="input" id="name" name="name" placeholder="Name" required
               		value=""/><br><br>
                	<span>Help people discover your account by using the name you're know by either your <br>
                	full name, nickname or business name</span>
               </div>
               <br><br>
                        
               <!-- Username -->  	
               <label for="username"><b>Username</b></label> 
               <div style="margin-left:100px; margin-top:-18px">
               		<input type="text" class="input" id="username" name="username" placeholder="Username"
               		value="" disabled/><br><br>
        			<span>You can't change your username once you set it</span>
        	   </div>
        	   <br><br>
        				
        	   <!-- Website -->
        	   <label for="website"><b>Website</b></label> 
        	   <div style="margin-left:100px; margin-top:-18px">
                    <input type="text" class="input" id="website" name="website" placeholder="Website"
                    value=""/>
               </div>
               <br><br>
                      	
               <!-- Bio --> 
               <label for="bio"><b>Bio</b></label> 
               <div style="margin-left:100px; margin-top:-18px">
               		<textarea rows="4" cols="100" id="bio" name="bio" style="max-width:80%"></textarea>
               <br><br>
                      	
               <span><b>Personal Information</b><br>
                    Provide your personal information, even if the account is used for a business, a pet or <br>
                    something else. This won't be a part of your public profile
               </span>
               </div>
               <br><br>
                      	
               <!-- Email -->
               <label for="email"><b>Email</b></label> 
               <div style="margin-left:100px; margin-top:-18px">
                    <input type="text" class="input" id="email" name="email" placeholder="Email" required
                    value=""/>
               </div>
               <br>
                      	
               <!-- Phone Number -->
               <label for="phoneNo"><b>Phone Number</b></label> 
               <div style="margin-left:100px; margin-top:-18px">
                    <input type="text" class="input" id="phoneNo" name="phoneNo" placeholder="Phone number" pattern="[0-9]{3}-[0-9]{3|4}-[0-9]{4}" value=""/>
               </div>
               <br>
                      	
               <!-- Gender -->
               <label for="gender"><b>Gender</b></label> 
               <div class="gender">
               		<select name="gender" id="gender" style="width:80%; height:10%">
                    	<option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>
                    </select>
               </div>
               <br>

               <input type="hidden" id="hidden_idcreator" value="<?php echo $idcreator ?>">

               <!-- Submit Button -->       	
               <button class="submitbtn" name="submit">Submit</button>
           </div>
           </form>
           <br><br>
           
           <!-- Update/Edit Profile -->
    	   
           
           <!-- Change Password -->
           
    	   <div class="changePassword tabShow" style="margin-top:-27px">
    	   
         	   <!-- Profile Picture -->
    	       <div class="profile" style="margin-left:10px">
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
               </div><br><br><br>
               
    	   	   <p style="margin-left:100px; margin-top:-55px; font-size:18pt"><?php if(isset($_POST['username'])){echo htmlentities($_POST['username']);}?></p>
    	   	   <br><br><br>
    	   	   
               <!-- Old Password -->
               <form class="changepw" method="post" enctype="multipart/form-data">
               <label for="oldPassword"><b>Old Password</b></label> 
               <div class="oldPassw">
               		<input type="password" class="input" id="oldPassword" name="oldPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Old Password"required>
               		<br><br>
               </div><br>
              
               <!-- New Password -->
               <label for="newPassword"><b>New Password</b></label> 
               <div class="newPassw">
               		<input type="password" class="input" id="newPassword" name="newPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="New Password" required>
               		<i class="far fa-eye" id="newtogglePassword"></i>
               		<br><br>
               </div>

               <p style="margin-left:100px"><span><b>Password should contain</b><br>
               		A lowercase letter, a capital (uppercase) letter, a number and minimum 8 characters
               </span></p><br>
               
               <!-- Confirm New Password -->
               <label for="confirmnewPassword"><b>Confirm New<br>Password</b></label> 
               <div class="confirmPassw">
               		<input type="password" class="input" id="confirmnewPassword" name="confirmnewPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Confirm New Password" required>
               		<br><br>
               </div>
               
               <br>
               
               <!-- Change Password Button -->
               <button class="changePasswbtn" type="submit" name="change" onclick="return Validate()">Change</button>
               </form>
           </div>
          
           
           <!-- Show/Hide Password  -->
    	   <!-- New Password  -->
    	   <script>
        		const togglePassword = document.querySelector('#newtogglePassword');
                const password = document.querySelector('#newPassword');
                
                togglePassword.addEventListener('click', function (e) {
                    // toggle the type attribute
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    // toggle the eye slash icon
                    this.classList.toggle('fa-eye-slash');
                });
    	   </script>
    	   
    	   <!-- Matching Password -->
    	   <script type="text/javascript">
    	   		function Validate() {
    	        	var password = document.getElementById("newPassword").value;
    	        	var confirmPassword = document.getElementById("confirmnewPassword").value;
    	        	if (password != confirmPassword) {
    	            	alert('Passwords do not match!\nPlease re-enter your password');
    	            	return false;
    	        	}
    	        	return true;
    	    	}
           </script>
           <br><br>
           
           <!-- Change Password -->
		   <?php 
		   
		   ?>
		   
           <!-- Manage Account -->
    	   <div class="manageAccount tabShow" style="margin-top:20px;">
    	   		<!-- Delete Account Button -->
           		<button class="deleteAccountbtn" onclick="document.getElementById('id01').style.display='block'">Delete Account</button>
        	   	
        	   	<!-- Delete Account Dialogbox -->
                <div id="id01" class="deleteAccount">
                	<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close">x</span>
                    <form class="deleteAccount-content" method="post" enctype="multipart/form-data">
                    	<div class="deletecontainer">
                        	<h1>Delete Account</h1><br>
                          	<p>Are you sure you want to delete your account?</p>
                          	<br>
                        
                            <div class="clearfix">
                            	<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn" name="cancel">Cancel</button>
                                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="deletebtn" name="delete">Delete</button>
                            </div>
                       	</div>
                    </form>
                </div>

                <br>    
        	   	<span>
        	   		If you wish to delete your account on Instagraham <br>
        	   		Please click on the button, this account will be deleted and all posts and photos will be removed.
        	   	</span>
           </div>
           <input type="hidden" id="hidden_idcreator" value="<?php echo $idcreator ?>">
           <!-- Delete Account -->
           <?php 
           // connect to database
           $mysqli = new mysqli("localhost", "root", "", "5114asst1");
           if ($mysqli->connect_errno) {
               echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
           }
           
           // create SQL query to delete image with idphoto=id
           $q = 'DELETE FROM creator';' ';
           
           if(isset($_POST['delete'])) {
               // execute query and output a success/error message
               if ($mysqli->query($q)) {
                   echo'<script type="text/javascript"> alert ("Account Deleted") </script>'; //result 
               }
               else {
                   echo'<script type="text/javascript"> alert ("Something went wrong!\nPlease contact your system adminstrator") </script>';
               }
           }
           ?>
           
        </div>           
       	</div>
       	</div>
       	<br><br>
    	<!-- Tab Function -->
        <script>
        	const tabBtn = document.querySelectorAll(".tab");
            const tab = document.querySelectorAll(".tabShow");
            
            function tabs(panelIndex){
            	tab.forEach(function(node){
                	node.style.display = "none";
                });
                tab[panelIndex].style.display = "block";
            }
            tabs(0);
        </script>
        
        <script>
        	$(".tab").click(function(){
            	$(this).addClass("active").siblings().removeClass("active");
            })
        </script>
        
        <script>
        // Add active class to the current button (highlight it)
        var header = document.getElementById("navSetting");
        var btns = header.getElementsByClassName("tab");
        for (var i = 0; i < btns.length; i++) {
        	btns[i].addEventListener("click", function() {
          	var current = document.getElementsByClassName("active");
          	current[0].className = current[0].className.replace(" active", "");
          	this.className += " active";
        	});
        }
        </script>
        
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
    
    <!-- Footer -->
    <footer>
    	<div class="footer">
        	<p>
            	<b>Copyright &copy; 2021 Instagraham Inc.</b><br>
            	Best viewed on Chrome browsers.
            </p>
        </div>
    </footer>
</html>