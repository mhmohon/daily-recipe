<?php
	include "dashboard/lib/session.php";
	session::start();
	$session_user_id = session::get_s('user_id');
?>
<!-- Connection from other class -->
<?php
include_once "core/db_connection.php";
include "database/db_function.php";
include_once "lib/helper_function.php";
include_once "lib/layout.php";
?>
<?php
	$get_conn = db_connection::db_connector();
	$checkDB = db_connection::db_select();
	$db_conn = new database_function($get_conn); //Create a object of database_function class.
	$help_func = new helperFuction();
	$l_method = new layoutMethod(); //Create a object of layoutMethod class.
?>
<?php
  //set headers to NOT cache a page
  header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000"); 
?>

<!DOCTYPE html>
<html>
<head>
<title>DailyRecipe :: Home</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<!-- Font Awesome -->
<link rel="stylesheet" href="dashboard/dist/css/font-awesome.css">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/main_custom.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
</head>

<body>
<!-- banner-body -->
	<div class="banner-body">
		<div class="container">
<!-- header -->
			<div class="header">
				<div class="header-nav">
					<nav class="navbar navbar-default">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
						  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </button>
						   <a class="navbar-brand" href="index.php"><span>D</span>ailyRecipe</a>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
						 <ul class="nav navbar-nav">
							<li class="hvr-bounce-to-bottom active"><a href="index.php">Home</a></li>
							<li class="hvr-bounce-to-bottom"><a href="about.php">About</a></li>
							<li class="hvr-bounce-to-bottom"><a href="contact.php">Contact Us</a></li>
							
						  </ul>
		
						<?php 
							if(session::get_s("login") == false){ ?>
								<div class="sign-in">
									<ul>
										<li><a href="login.php">Sign In </a>/</li>
										<li><a href="register.php">Register</a></li>
									</ul>
								</div>
						<?php } else{ ?>
								<div class="sign-in">
									<ul>
										<li><a href="dashboard/index.php">Back To DashBoard</a></li>
										
									</ul>
								</div>
						<?php } ?>
						
						</div><!-- /.navbar-collapse -->
					</nav>
				</div>

			<!-- search-scripts -->
			<script src="js/classie.js"></script>
			<script src="js/uisearch.js"></script>
				<script>
					new UISearch( document.getElementById( 'sb-search' ) );
				</script>
			<!-- //search-scripts -->
			</div>
<!-- //header -->
