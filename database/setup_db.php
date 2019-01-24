<?php
  include_once "../core/db_connection.php";
  include_once "db_function.php";
  
?>
<?php 
	$db_link = db_connection::db_connector(); //Get the db connection.
	$db_func = new database_function($db_link); //Create a object of database_function class.
	
?>
<?php
  
  $db_name = db_connection::$dbname;
  //Drop Database...
  $sql = "DROP DATABASE IF EXISTS $db_name";
  $result = $db_link->query($sql)
    or die("ERROR: ".$db_link->error);
  //Create Database...
  $sql = "CREATE DATABASE IF NOT EXISTS $db_name";
  $result = $db_link->query($sql);
  if(!$result){
    die("Database can not create".$db_link->error);
  }else {
    $db_create = "$db_name Database created.</br>";
  }
  //Select Database...
  $sql = "USE $db_name";
  $result = $db_link->query($sql);
  if(!$result){
    echo "Database not selected </br>".$db_link->error;
  }else {
    $db_select_msg = "$db_name Database selected </br>";
  }
  //Create Category table...
  $sql = "CREATE TABLE tbl_category(
    cat_id INT(20) NOT NULL AUTO_INCREMENT,
    cat_name VARCHAR(255) NOT NULL,
    PRIMARY KEY (cat_id)
    )ENGINE = InnoDB; ";
  $result = $db_link->query($sql);
  if(!$result){
    echo "Table tbl_category not Created</br>".$db_link->error;
  }else {
    $tbl_cat_create = "Table tbl_category Created</br>";
  }

  //Create user table...
  $sql = "CREATE TABLE tbl_user(
    user_id INT(100) NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    user_name VARCHAR(100) NOT NULL,
    user_email VARCHAR(100) NOT NULL,
    user_pass VARCHAR(255) NOT NULL,
    user_role VARCHAR(100) NOT NULL,
	date TIMESTAMP NOT NULL,
    PRIMARY KEY (user_id)

    )ENGINE = InnoDB; ";
  $result = $db_link->query($sql);
  if(!$result){
    echo "Table tbl_user not Created</br>".$db_link->error;
  }else {
    $tbl_user_create = "Table tbl_user Created</br>";
  }

  //Create post table...
  $sql = "CREATE TABLE tbl_recipe(
    recipe_id INT(100) NOT NULL AUTO_INCREMENT,
    cat_id INT(50) NOT NULL,
	user_id INT(100) NOT NULL,
    recipe_title VARCHAR(255) NOT NULL,
    recipe_author VARCHAR(100) NOT NULL,
    recipe_tags VARCHAR(255) NOT NULL,
    recipe_level VARCHAR(255) NOT NULL,
    recipe_image VARCHAR(255) NOT NULL,
    recipe_video VARCHAR(255) NOT NULL,
    recipe_pre_time VARCHAR(100) NOT NULL,
    recipe_c_time VARCHAR(100) NOT NULL,
    recipe_serving INT(100) NOT NULL,
    recipe_desc TEXT NOT NULL,
    recipe_ingre TEXT NOT NULL,
    recipe_direc TEXT NOT NULL,
	views INT NOT NULL,
    status VARCHAR(50) NOT NULL,
    `Date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (recipe_id),
	FOREIGN KEY (user_id) REFERENCES tbl_user(user_id),
    FOREIGN KEY (cat_id) REFERENCES tbl_category(cat_id))";
  $result = $db_link->query($sql);
  if(!$result){
    echo "Table tbl_recipe not Created</br>".$db_link->error."</br>";
  }else {
    $tbl_recipe_create = "Table tbl_recipe Created </br>";
  }
//insert user table
  $pass = md5('admin@123');
  $sql = "INSERT INTO `tbl_user`(first_name,last_name,user_name,user_email,user_pass,user_role) VALUES('Mosharrf','Hossain','admin','mohon.diit33@gmail.com','$pass','admin')";
				$insert_result = $db_func->insert($sql);
				if($insert_result){
					$user_create = "<span><h3 style='color:#00A65A'>Congratulations! You have successfully create an account.<br>
					User Name: <span style='text-transform: lowercase; color:#C34C21'>admin </span><br>
					Password: <span style='text-transform: lowercase; color:#C34C21'>admin@123</span><br>
					Email: <span style='text-transform: lowercase; color:#C34C21'>mohon.diit33@gmail.com</span><br>
					Now You can now login from <a href='../login.php'>Here!!!</a>
					</h3></span><br>";
				}else {
					echo "<span><p style='color:red'>Sorry! There is an error</p></span>".$db_link->error."</br>";
				}

?>


<!DOCTYPE html>
<html>
<head>
<title>SetUp::DB</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- //for-mobile-apps -->
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/main_custom.css" rel="stylesheet" type="text/css" media="all" />

<!-- js -->
<script src="../js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="../js/move-top.js"></script>
<script type="text/javascript" src="../js/easing.js"></script>
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
	<div class="banner-body regstr">
		<div class="container">

<!-- SetUp DB -->
			<div class="sign-up-form">
				<h3>Configure Database</h3>
				
				<div class="sign-up">
					<h3><?php echo $db_create;?></h3>
					<h3><?php echo $db_select_msg;?></h3>
					<h3><?php echo $tbl_cat_create;?></h3>
					<h3><?php echo $tbl_user_create;?></h3>
					<h3><?php echo $tbl_recipe_create;?></h3>
					<h3><?php echo $user_create;?></h3>
					
					
					
				</div>
			</div>
<!-- //register -->
		</div>
	</div>
<!-- for bootstrap working -->
		<script src="../js/bootstrap.js"> </script>
<!-- //for bootstrap working -->
</body>
</html>