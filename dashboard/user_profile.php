<!-- Dashboard Header -->
<?php include "inc/dashboardHeader.php"; ?>
<!-- Dashboard Sidebar -->
<?php include "inc/dashboardSidebar.php"; ?>

<?php
  if(session::get_s('user_id') == null){	
    $help_func->redirect("index.php");
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
		  <h1>Here you can view your Profile.<h1>
		</section>
		<!-- Main content -->
		<section class="content">
		  <div class="row">
        <!-- left column -->
        <div class="col-xs-12">
		  <!-- general form elements -->
          <div class="box box-info box_center">
            <div class="box-header with-border">
              <h3 class="box-title">Your Profile</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->

<?php
//PHP code for view category
  $sql = "SELECT * FROM tbl_user WHERE user_id = '$get_id' ORDER BY user_id";
  $user_row = $db_func->read($sql)->fetch_assoc();
?>
            <form action="" method="post" role="form" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">First Name</label>

                  <div class="col-sm-6">
                    <input type="text" name="first_name" readonly value="<?php echo $user_row['first_name'];?>" class="form-control">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Last Name</label>

                  <div class="col-sm-6">
                    <input type="text" name="last_name" readonly value="<?php echo $user_row['last_name'];?>" class="form-control">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">User Name</label>

                  <div class="col-sm-6">
                    <input type="text" name="user_name" readonly value="<?php echo $user_row['user_name'];?>" class="form-control">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-6">
                    <input type="email" name="user_email" readonly value="<?php echo $user_row['user_email'];?>" class="form-control">
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
				<a class="btn btn-success" href="user_edit_profile.php?userid=<?php echo $user_row['user_id']?>">
				<span class="fa fa-edit"> </span>Edit</a>
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
