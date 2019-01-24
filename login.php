<?php include "inc/header.php"; ?>
<!-- login-page -->
	<div class="login">
		<div class="login-grids">
			<div class="col-md-6 log">
<?php
	if(session::get_s("login", true)){
		header("Location:dashboard/index.php");
	}
?>
<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$username = strtolower($l_method->inputValidation($_POST['username'])); //get and pass the user name value to layout class.
		$password = $l_method->inputValidation(md5($_POST['password'])); //get and pass the password value to layout class.

		$username = mysqli_real_escape_string($get_conn, $username);
		$password = mysqli_real_escape_string($get_conn, $password);

		$sql = "SELECT * FROM `tbl_user` WHERE user_name = '$username' AND user_pass = '$password'";
		$result = $db_conn->read($sql);
		if($result){
			$value = mysqli_fetch_array($result);
			$row = mysqli_num_rows($result);
			if($row > 0){
				session::set_s("login", true);
				session::set_s("user_id", $value['user_id']);
				session::set_s("user_name", $value['user_name']);
				session::set_s("user_email", $value['user_email']);
				session::set_s("user_role", $value['user_role']);
				
				header("Location:dashboard/index.php");
			}else {
				echo "<h3>No result found.</h3>";
			}
		}else {
			echo "<h3 style='color:red'>Username and password does not match!!!.</h3>";
		}
	}
?>
					 <h3>Login</h3>
					 <p>Welcome, please enter the following to continue.</p>
					 
					 <form action="login.php" method="post">
						 <h5>User Name:</h5>
						 <input type="text" name="username" placeholder="Enter your user name" required="">
						 <h5>Password:</h5>
						 <input type="password" name="password" placeholder="Enter your password" required="">
						 <input type="submit" value="Login">

					 </form>
					
			</div>
			<div class="col-md-6 login-right">
					<h3>New Registration</h3>
					<p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
					<a href="register.php" class="hvr-bounce-to-bottom button">Create An Account</a>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
<!-- //login-page -->
		</div>
	</div>
<?php include "inc/footer.php"; ?>
