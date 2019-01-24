<?php include "inc/header.php"; ?>
<?php
	if(session::get_s("login", true)){
		header("Location:dashboard/index.php");
	}
?>
<!-- register -->
<!-- Php code fot register -->
			<div class="sign-up-form">
				<h3>Register Here</h3>
				<p>Having hands on experience in creating innovative designs,I do offer design solutions which harness</p>
<?php
	// define variables and set to empty values
	$FnameErr = $LnameErr = $emailErr = $UnameErr = $passErr = $CpassErr = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
		// insert data and check if First name is valid
		if (empty($_POST["first_name"])) { 		
			$FnameErr = "First Name is required";
		} elseif (!preg_match("/^[a-zA-Z ]*$/",$_POST["first_name"])) {
			// check if name only contains letters and whitespace
			$FnameErr = "* Only letters and white space allowed"; 
		}	else {
				$firstname = $l_method->inputValidation($_POST['first_name']);
				$firstname = mysqli_real_escape_string($get_conn, $firstname);
			}
		
		// insert data and check if Last name is valid
		if (empty($_POST["last_name"])) { 		
			$LnameErr = "Last Name is required";
		} elseif (!preg_match("/^[a-zA-Z ]*$/",$_POST["last_name"])){
			// check if name only contains letters and whitespace		
			$LnameErr = "* Only letters and white space allowed"; 		
		}	else {
				$lastname = $l_method->inputValidation($_POST['last_name']);
				$lastname = mysqli_real_escape_string($get_conn, $lastname);
		}
		// insert data and check if User name is valid
		if (empty($_POST["user_name"])) { 		
			$UnameErr = "User Name is required";
		} elseif(strlen($_POST["user_name"])<5){
			$UnameErr = "* User Name is too short";
		} elseif(!preg_match("/[A-Za-z]{3,}/",$_POST["user_name"])){
			$UnameErr = "* User Name must contain at least three alphabetic word";
		} else {
				$username = $l_method->inputValidation($_POST['user_name']);
				$username = mysqli_real_escape_string($get_conn, $username);
		}
		// insert data and check if Email is valid
		if (empty($_POST["email"])) { 		
			$emailErr = "Email is required";
		} elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
			// check if name only contains letters and whitespace
			$emailErr = "* Invalid email format";
		}	else {
				$email = $l_method->inputValidation($_POST['email']);
				$email = mysqli_real_escape_string($get_conn, $email);								
		}
		//  insert data and check if password is valid
		if (empty($_POST["password"])) { 		
			$passErr = "Password is required";
		}elseif(strlen($_POST["password"])<5){
			$passErr = "* Password is too short";
		} elseif(!preg_match("@[A-Z]@",$_POST["password"])||!preg_match("@[a-z]@",$_POST["password"])
		|| !preg_match("@[0-9]@",$_POST["password"])){
			$passErr = "* Passwords require one each of a-z, A-Z and 0-9";
		}else {
			$password = $l_method->inputValidation(md5($_POST['password']));
			$password = mysqli_real_escape_string($get_conn, $password);
		}
		//  insert data and check if confirm password is valid
		if (empty($_POST["con_password"])) { 		
			$CpassErr = "Confirm Password is required";
		}elseif($_POST["con_password"] !== $_POST["password"]){
			$CpassErr = "* Password does not match";
		}
		
		if(!$FnameErr && !$LnameErr && !$emailErr && !$UnameErr && !$passErr && !$CpassErr){
			
			$sql = "SELECT * FROM `tbl_user` WHERE user_name = '$username' OR user_email = '$email'";
			$check = $db_conn->read($sql);
			if($check){
				echo "<div class='msg'><h3 style='color:red'>Email or user name already exist!</h3></div>";
			}else {
				$sql = "INSERT INTO `tbl_user`(first_name,last_name,user_name,user_email,user_pass,user_role) VALUES('$firstname','$lastname','$username','$email','$password','user')";
				$insert_result = $db_conn->insert($sql);
				if($insert_result){
					echo "<div class='msg'><h3 style='color:#00A65A'>Congratulations! You have successfully registered.</h3></div>";
				}else {
					echo "<div class='msg'><h3 style='color:red'>Sorry! There is an error</h3></div>";
				}			
			}
		}
	}
	
?>
				<div class="sign-up">
					<h5>Personal Information</h5>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					<div class="sign-u">
						<div class="sign-up1">
							<h4 class="a">First Name* :</h4>
						</div>
						<div class="sign-up2">	
							<span class="error"><?php echo $FnameErr;?></span>
							<input type="text" name="first_name" placeholder=" " />
							
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4 class="b">Last Name* :</h4>
						</div>
						<div class="sign-up2">
							<span class="error"><?php echo $LnameErr;?></span>						
							<input type="text" name="last_name" placeholder=" " />
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4 class="c">User Name* :</h4>
						</div>
						<div class="sign-up2">
							<span class="error"><?php echo $UnameErr;?></span>
							<input type="text" name="user_name" placeholder=" " />
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4 class="c">Email Address* :</h4>
						</div>
						<div class="sign-up2">
							<span class="error"><?php echo $emailErr;?></span>
							<input type="text" name="email" placeholder=" " />
						</div>
						<div class="clearfix"> </div>
					</div>
					<h6>Login Information</h6>
					<div class="sign-u">
						<div class="sign-up1">							
							<h4 class="d">Password* :</h4>
						</div>
						<div class="sign-up2">
							<span class="error"><?php echo $passErr;?></span>
							<input type="password" name="password" placeholder=" " />
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="sign-u">
						<div class="sign-up1">
							<h4>Confirm Password* :</h4>
						</div>
						<div class="sign-up2">
							<span class="error"><?php echo $CpassErr;?></span>
							<input type="password" name="con_password" placeholder=" " />
						</div>
						<div class="clearfix"> </div>
					</div>
						<input type="submit" name="register" value="Submit">
					
				</form>
				</div>
			</div>
<!-- //register -->
		</div>
	</div>
<?php include "inc/footer.php"; ?>