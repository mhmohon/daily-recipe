<!-- Dashboard Header -->
<?php include "inc/dashboardHeader.php"; ?>
<!-- Dashboard Sidebar -->
<?php include "inc/dashboardSidebar.php"; ?>

<?php
	if(session::get_s('user_role') !== 'admin'){
		if($session_user_id != $_GET['userid']){
			$help_func->redirect("index.php");
		}
	}
	if($session_user_id == null || $_GET['userid'] == null){	  
		$help_func->redirect("view_user.php");
		
	}elseif(isset($_GET['userid'])) {  
		$get_id = $_GET['userid'];	

	}else {
		
		$get_id = session::get_s('user_id');
	}
	$get_email = session::get_s('user_email');
	$get_name = session::get_s('user_name');
	$get_role = session::get_s('user_role');
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- form start -->
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>You can update User Profile.<h1>
		</section>
		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<!-- left column -->
			<div class="col-xs-12">
			  <!-- general form elements -->
			  <div class="box box-info box_center">
				<div class="box-header with-border">
				  <h3 class="box-title">User Profile</h3>
				</div>

<!-- PHP code for update user -->
<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $firstname = mysqli_real_escape_string($get_conn, $_POST['first_name']);
  	$lastname = mysqli_real_escape_string($get_conn, $_POST['last_name']);
  	$username = mysqli_real_escape_string($get_conn, $_POST['user_name']);
  	$email = mysqli_real_escape_string($get_conn, $_POST['user_email']);
	
	if($get_role == 'admin'){
		$userrole = mysqli_real_escape_string($get_conn, strtolower($_POST['user_role']));
	}
//Validation PHP Code
    if(empty($firstname) || empty($lastname) || empty($username) || empty($email)){ ?>
      <div class="alert alert-danger">
        <h4><i class="icon fa fa-ban"></i> Insert All Field!</h4>
      </div>
<?php }elseif(!preg_match("/^[a-zA-Z ]*$/",$firstname)){ ?>
		<div class="alert alert-danger">
			<h4><i class="icon fa fa-ban"></i> Only letters and white space allowed in First Name!</h4>
		</div>

<?php }elseif(!preg_match("/^[a-zA-Z ]*$/",$lastname)){ ?>
		<div class="alert alert-danger">
			<h4><i class="icon fa fa-ban"></i> Only letters and white space allowed in Last Name!</h4>
		</div>

<?php }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){ ?>
		<div class="alert alert-danger">
			<h4><i class="icon fa fa-ban"></i> Invalid Email Format!</h4>
		</div>
<?php	}elseif(!preg_match("/[A-Za-z]{3,}/",$username)){ ?>
		<div class="alert alert-danger">
			<h4><i class="icon fa fa-ban"></i> User Name must contain at least three alphabetic word!</h4>
		</div>
<?php	} else {
        $sql = "SELECT * FROM `tbl_user` WHERE user_name = '$username' OR user_email = '$email'";
        $checkExist = $db_func->read($sql)->num_rows;
        if($checkExist > 1 && $get_name!= $username || $checkExist > 1 && $get_email != $email){ ?>
          <div class="alert alert-warning">
            <h4><i class="icon fa fa-warning"></i> Can't update because <?php echo $username." Or ".$email;?> already exists!</h4>
          </div>
<?php } elseif($get_role == 'admin'){
        $sql = "UPDATE `tbl_user`
                SET
                first_name = '$firstname',
				last_name = '$lastname',
				user_name = '$username',
				user_email = '$email',
				user_role = '$userrole'
                WHERE user_id = '$get_id'";
        $update_user = $db_func->update($sql);
        if($update_user){ ?>
          <div class="alert alert-success">
            <h4><i class="icon fa fa-check"></i>Profile update sucessfully.</h4>
          </div>
<?php } else {
        echo "<div class='alert alert-danger'>
				<h4><i class='icon fa fa-ban'></i>Profile not updated.</h4>
			  </div>";
      }
    } else {
		$sql = "UPDATE `tbl_user`
                SET
                first_name = '$firstname',
				last_name = '$lastname',
				user_name = '$username',
				user_email = '$email'
                WHERE user_id = '$get_id'";
        $update_user = $db_func->update($sql);
        if($update_user){ ?>
          <div class="alert alert-success">
            <h4><i class="icon fa fa-check"></i>Profile update sucessfully.</h4>
          </div>
<?php } else {
        echo "<div class='alert alert-danger'>
				<h4><i class='icon fa fa-ban'></i>Profile not updated.</h4>
			  </div>";
      }
	}
  }
}
?>
<!-- /PHP code for update user -->
            <!-- /.box-header -->
            <!-- form start -->

<?php
//PHP code for view user
  $sql = "SELECT * FROM tbl_user WHERE user_id = '$get_id' ORDER BY user_id";
  $user_exist = $db_func->read($sql);
  if($user_exist){
	$user_row = $user_exist->fetch_assoc();
  }else {
	  $help_func->redirect("view_user.php");
  }
?>
            <form action="" method="post" role="form" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">First Name</label>

                  <div class="col-sm-6">
                    <input type="text" name="first_name" value="<?php echo $user_row['first_name'];?>" class="form-control">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Last Name</label>

                  <div class="col-sm-6">
                    <input type="text" name="last_name" value="<?php echo $user_row['last_name'];?>" class="form-control">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">User Name</label>

                  <div class="col-sm-6">
                    <input type="text" name="user_name" value="<?php echo $user_row['user_name'];?>" class="form-control">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-6">
                    <input type="email" name="user_email" value="<?php echo $user_row['user_email'];?>" class="form-control">
                  </div>
                </div>
		<?php if($get_role == "admin" && $get_id == $user_row['user_id']){?>
				<div class="form-group">
                  <label class="col-sm-3 control-label">User Role</label>

                  <div class="col-sm-6">
                    <select class="form-control" name="user_role">
						<?php if($user_row['user_role'] == 'admin'){ ?>
						<option selected>Admin</option>
					<?php }?>
					<?php if($user_row['user_role'] == 'staff'){ ?>
						<option selected>Staff</option>
						<option>User</option>
					<?php }?>
					<?php if($user_row['user_role'] == 'user'){ ?>
						<option>Staff</option>
						<option selected>User</option>
					<?php }?>
					
					</select>
                  </div>
                </div>
		<?php }?>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-info pull-left">Update</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Dashboard footer -->
  <!-- Dashboard footer -->
  <?php include "inc/dashboardFooter.php"; ?>
