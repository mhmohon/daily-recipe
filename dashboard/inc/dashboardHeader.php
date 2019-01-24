<?php
include "lib/session.php";
session::sessionChecker();
$session_user_id = session::get_s('user_id');
?>
<?php
include_once "../core/db_connection.php";
include_once "../database/db_function.php";
include_once "../lib/helper_function.php";
include_once "../lib/layout.php";
?>
<?php
	$get_conn = db_connection::db_connector(); //Get the db connection.
	$checkDB = db_connection::db_select();
	$db_func = new database_function($get_conn); //Create a object of database_function class.
	$help_func = new helperFuction();
	$l_method = new layoutMethod(); //Create a object of layoutMethod class.
	//Checking users exist in database.
	$sql = "SELECT user_id FROM `tbl_user` WHERE user_id = '$session_user_id'";
	$result = $db_func->read($sql);
	if(!$result){
		session::destroy();	
	}
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
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DailyRecipe::Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/css/font-awesome.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="dist/css/ionicons.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
 
  <!-- My style -->
  <link rel="stylesheet" href="dist/css/custom.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>R</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Daily</b>Recipe</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
		<a role="button" data-toggle="offcanvas" class="sidebar-toggle" href="#">
			<span class="sr-only">Toggle navigation</span>
		</a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/seo.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo ucwords(session::get_s('user_name'));?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
			  
                <img src="dist/img/man.png" class="img-circle" alt="User Image">
	<?php
		$userID = session::get_s('user_id');
		$sql = "SELECT * FROM `tbl_user` WHERE user_id = '$userID'";
		$user_result = $db_func->read($sql);
		if($user_result){
			while($user_row = $user_result->fetch_assoc()){
	?>
                <p>
                  <?php echo $user_row['first_name']." ".$user_row['last_name']." - ".strtoupper($user_row['user_role']);?>
                  <small>Member since <?php echo $l_method->formatDate($user_row['date']);?></small>
                </p>
              </li>
	<?php  } ?> <!-- Stop While loop -->
	<?php  } ?>
                <!-- /.row -->
              <!-- Menu Footer-->

              <li class="user-footer">
                <div class="pull-left">
                  <a href="user_profile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
	<?php
		if(isset($_GET['action']) && $_GET['action']=="logout"){
			session::destroy();
		}
	?>
                <div class="pull-right">
                  <a href="?action=logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </nav>
  </header>