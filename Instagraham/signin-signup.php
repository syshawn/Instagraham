<?php
// Create new MySQL interface objcet
$mysqli = new mysqli("localhost", "root", "", "5114asst1");
if ($mysqli->connect_errno) { // If there is an error, output the details
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_errno;
}

// Sign-Up
// Define varaibles and empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$signup = FALSE;

// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to uploadPage.php
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ".(isset($_SERVER['PATH_INFO'])?"..":"")."uploadPage.php");
    exit;
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Sign In Page Function
    if($_SERVER['PATH_INFO']==="/signin"){ // Sign In Page Directory
        // Check if username is empty
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter your username.";
        } else{
            $username = trim($_POST["username"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = $_POST["password"];
        }
        
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Select statement
            $sql = "SELECT idcreator, username, password FROM creator WHERE username = ?";
            
            if($stmt = mysqli_prepare($mysqli, $sql)){
                // Bind variables
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameters
                $param_username = $username;
                
                // Attempt to execute prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    
                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $idcreator, $username, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){
                                // If password valid, start a new session
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["idcreator"] = $idcreator;
                                $_SESSION["username"] = $username;
                                
                                // Redirect user to upload page
                                header("location: ../uploadPage.php");
                                die();
                            }else{
                                // Display error message if invalid password
                                $login_err = "Invalid password. Please try again.";
                            }
                        }
                    } else{
                        // Display error if username invalid
                        $login_err = "Invalid username. Please try again.";
                    }
                } else{
                    echo "Oops! Something went. Please try again later.";
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
    }
    // Sign Up Page Function
    else if($_SERVER['PATH_INFO']==="/signup"){ // Sign Up Page Directory
        $signup=TRUE;
        // Validate username
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a preferred username.";
        } else{
            // Prepare a select statement
            $sql = "SELECT idcreator FROM creator WHERE username = ?";
            
            if($stmt = mysqli_prepare($mysqli, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameters
                $param_username = trim($_POST["username"]);
                
                // Attempt tp execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $username_err = "The username is already taken.";
                    } else{
                        $username = trim($_POST["username"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        
        // Validate password
        if(empty(trim($_POST["password"]))){
            $password_err = "";
        } elseif(strlen(trim($_POST["password"]))<8){
            $password_err = "Passwords must be at least 8 characters long and use only upper case, lower case, and numbers.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm your password.";
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password does not match.";
            }
        }
        
        // Check input errors before inserting in database
        if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
            // Insert statement
            $sql = "INSERT INTO creator (username, password, profilePhoto) VALUES (?, ?, ?)";
            
            if($stmt = mysqli_prepare($mysqli, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password,$user_img);
                
                // Set parameters
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Create password hash
                $user_img = "person.svg";
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    die("<script>alert(\"You have created an account.\");location.replace('/Coursework/signin-signup.php/signin');</script>");
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                
                // Close Statement
                mysqli_stmt_close($stmt);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Sign In | Sign Up</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Link for the Cascading Style Sheets -->
		<link rel="stylesheet" href="<?=isset($_SERVER['PATH_INFO'])?"../":""?>Instagraham.css">

		<!-- Link for the logo font style -->
		<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet'>

		<!-- Link for the body font style -->
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>

		<!-- Script for the icon -->
		<script src="https://kit.fontawesome.com/64d58efce2.js"></script>

		<style>
		@font-face {
          font-family: 'Product Sans';
          font-style: normal;
          font-weight: 400;
          src: local('Open Sans'), local('OpenSans'), url(https://fonts.gstatic.com/s/productsans/v5/HYvgU2fE2nRJvZ5JFAumwegdm0LZdjqr5-oayXSOefg.woff2) format('woff2');
        }
        
		  .container {
				position: relative;
				width: 100%;
				min-height: 100vh;
				background-color: #ffffff;
				overflow: hidden;
			}

			.container:before {
				content: '';
				position: absolute;
				width: 2000px;
				height: 2000px;
				border-radius: 50%;
                background: linear-gradient(-45deg, #10e0d2, #e010d6);
				top: -10%;
				right: 48%;
				transform: translateY(-50%);
				z-index: 6;
				transition: 1.8s ease-in-out;
			}

			.form-container {
				position: absolute;
				width: 100%;
				height: 100%;
				top: 0;
				left: 0;
			}

			.signup-signin {
				position: absolute;
				top: 50%;
				left: 75%;
				transform: translate(-50%,-50%);
				width: 50%;
				display: grid;
				grid-template-columns: 1fr;
				z-index: 5;
				transition: 1s 0.7s ease-in-out;
			}

			form {
				display: flex;
				align-items: center;
				justify-content: center;
				flex-direction: column;
				padding: 0 80px;
				overflow: hidden;
				grid-column: 1 / 2;
				grid-row: 1 / 2;
				transition: 0.2s 0.7s ease-in-out;
			}

			form.sign-up-form {
				z-index: 1;
				opacity: 0;
			}

			form.sign-in-form {
				z-index: 2;
			}

			.title {
				font-family: Product Sans;
				font-size: 38px;
				color: #444444;
				margin-bottom: 10px;
			}

			.input-field {
				max-width: 340px;
				width: 100%;
				height: 55px;
				background-color: #f1f1f1;
				margin: 24px 0;
				border-radius: 55px;
				display: grid;
				grid-template-columns: 20% 80%;

			}

			.input-field i {
				font-size: 16px;
				text-align: center;
				line-height: 55px;
				color: #acacac;
			}

			.input-field input {
				background: none;
				outline: none;
				border: none;
				line-height: 1;
				font-weight: 600;
				font-size: 16px;
				color: #222;
			}

			.input-field input::placeholder {
				color: #aaa;
				font-weight: 580;
			}
			
			.hint {
			    white-space: nowrap ;
                margin: 10px 0;
                max-width: 340px;	
			}
			
			.invalid-feedback {
			    white-space: nowrap ;
                margin: 10px 0;
			}
			
            
            .form-group {
               margin: 10px 0;
            }
            
			.btn {
				width: 150px;
				height: 48px;
				border: none;
				outline: none;
				border-radius: 49px;
				cursor: pointer;
				background-color: #6c8dff;
				color: #fff;
				text-transform: uppercase;
				font-weight: 700;
				margin: 10px 6px;
				transition: .5s;
			}

			.btn:hover {
				background-color: #174cff;
			}

			.panels-container {
				position: absolute;
				width: 100%;
				height: 100%;
				top: 0;
				left: 0;
				display: grid;
				grid-template-columns: repeat(2, 1fr);
			}

			.panel {
				display: flex;
				flex-direction:	column;
				align-items: flex-end;
				justify-content: space-around;
				text-align: center;
				z-index: 7;

			}

			.left-panel {
                pointer-events: all;
				padding: 48px 17% 32px 12%;
			}

			.right-panel {
                pointer-events: none;
				padding: 48px 12% 32px 17%;
			}

			.panel .content {
				color: #fff;
				transition: .9s	.6s ease-in-out;
			}

			.panel h3 {
                font-weight: 600;
                line-height: 1;
                font-size: 24px;
                font-family: Product Sans;
			}

			.panel p {
				font-size: 16px;
				padding: 10px 0;
			}

			.btn.transparent {
                margin: 0;
                background: none;
                border: 2px solid #fff;
                width: 130px;
                height: 41px;
                font-weight: 600;
                font-size: 12px;
			}

			.image {
				width: 100%;
				transition: 1.2s .4s ease-in-out;
			}

			.right-panel .content, .right-panel .image{
                transform: translateX(800px);
			}

			/* ANIMATION */
			.container.sign-up-mode:before {
                transform: translate(100%, -50%);
                right: 52%;
			}

			.container.sign-up-mode .left-panel .image,
			.container.sign-up-mode .left-panel .content {
                transform: translateX(-800px);
			}

			.container.sign-up-mode .right-panel .image,
			.container.sign-up-mode .right-panel .content{
                transform: translateX(0px);
			}

			.container.sign-up-mode .left-panel {
                pointer-events: none;

			}

			.container.sign-up-mode .right-panel {
                pointer-events: all;
			}

			.container.sign-up-mode .signup-signin {
                left: 25%;
			}

			.container.sign-up-mode form.sign-up-form {
				z-index: 2;
				opacity: 1;
			}

			.container.sign-up-mode form.sign-in-form {
				z-index: 1;
				opacity: 0;
			}
		</style>
	</head>

	<body>
		<div class="container <?=$signup?"sign-up-mode":""?>">
			<div class="form-container">
				<div class="signup-signin">
					<form action="<?=htmlspecialchars($_SERVER["SCRIPT_NAME"])?>/signup" method="post" class="sign-up-form" onsubmit="return (this.password.value!==this.confirm_password.value&&(alert('The password you have enter does not match.'),true))?false:true">
						<h2 class="title">Sign Up</h2>
						<div class="input-field">
							<i class="fas fa-user"></i>
							<input type="text" name="username" placeholder="Username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $signup?$username:""; ?>">
							<span class="invalid-feedback"><?php echo $signup?$username_err:""; ?></span>
						</div>
						<div class="input-field">
							<i class="fas fa-lock"></i>
							<input type="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" >
							<p class="hint"><b>*Remark: Passwords must be at least 8 characters long and <br>use only upper case, lower case, and numbers.</b></p>
							<span class="invalid-feedback"><?php echo $signup?$password_err:""; ?></span>
						</div>
						<div class="input-field">
							<i class="fas fa-lock"></i>
							<input type="password" name="confirm_password" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" >
							<span class="invalid-feedback"><?php echo $signup?$confirm_password_err:""; ?></span>
						</div>
			            <div class="form-group">
			                <input type="submit" class="btn btn-primary" value="Submit">
			                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
			            </div>
					</form>

					<!-- Sign-In Form -->
                    <?php
                    if(!empty($login_err)){
                        echo '<div class="alert alert-danger">' . $login_err . '</div>';
                    }
                    ?>

                    <form action="<?=htmlspecialchars($_SERVER["SCRIPT_NAME"])?>/signin" method="post" class="sign-in-form">
                    	<h2 class="title">Sign In</h2>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" name="username" placeholder="Username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo !$signup?$username:""; ?>">
                            <span class="invalid-feedback"><?php echo !$signup?$username_err:""; ?></span>
                        </div>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?php echo !$signup?$password_err:""; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Login">
                        </div>
                    </form>
				</div>
			</div>
			<div class="panels-container">
				<div class="panel left-panel">
					<div class="content">
						<h3>Don't have an account?</h3>
						<p>Sign up now.</p>
						<button class="btn transparent" id="sign-in-btn">Sign Up</button>
					</div>
					<img src="images/new-year.svg" class="image" alt="">
				</div>

				<div class="panel right-panel">
					<div class="content">
						<h3>Already have an account?</h3>
						<p>Sign in here.</p>
						<button class="btn transparent" id="sign-up-btn">Sign In</button>
					</div>
					<img src="images/landscape.svg" class="image" alt="">
				</div>
			</div>
		</div>

		<script>
        	const sign_in_btn = document.querySelector("#sign-in-btn");
        	const sign_up_btn = document.querySelector("#sign-up-btn");
        	const container = document.querySelector(".container");

        	sign_in_btn.addEventListener('click', () => {
            	container.classList.add("sign-up-mode");
              document.title="Sign Up";
        	});

        	sign_up_btn.addEventListener('click', () => {
            	container.classList.remove("sign-up-mode");
              document.title="Sign In";
        	});
    	</script>
	</body>
</html>