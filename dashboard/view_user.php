<?php include "inc/dashboardHeader.php"; ?>
<!-- Dashboard Sidebar -->
<?php include "inc/dashboardSidebar.php"; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>View User List</h1>
    </section>
<?php
	if(session::get_s('user_role') == 'user'){
		$help_func->redirect("index.php");
	}
	if(session::get_s('user_role') == 'admin' || session::get_s('user_role') == 'staff' || isset($_GET['delete_userid']) || !empty($_GET['delete_userid']) ){	
		$get_user_id = session::get_s('user_id'); //For access control.
	}else {
		$help_func->redirect("view_user.php");
		
	}
?>
<!-- PHP code for delete user profile -->
<?php
// Get id for delete user.
  if(isset($_GET['delete_userid']) && session::get_s('user_role') == 'admin'){
	$get_id = $_GET['delete_userid']; //Get the user data
	// checking if there are any user exist.
	$sql = "SELECT user_id FROM `tbl_user` WHERE user_id = '$get_id'"; 
	$check_user = $db_func->read($sql);
	if($check_user){
		// checking if there are any post from this userid.
		$sql = "SELECT user_id FROM `tbl_recipe` WHERE user_id = '$get_id'"; 
		$check_result = $db_func->read($sql);
		if($check_result){ ?>
			<div class="alert alert-warning">
				<h4><i class="icon fa fa-warning"></i>User Can't Delete!!! It has one or more Recipe post, First delete those post.</h4>
			</div>
<?php }else {
		$sql = "DELETE FROM `tbl_user` WHERE `user_id` = '$get_id'";
		$delete_result = $db_func->delete($sql);
		if($delete_result){ ?>
		  <div class="alert alert-success">
			<h4><i class="icon fa fa-check"></i>Profile delete sucessfully.</h4>
		  </div>
<?php } else {
		echo "<div class='alert alert-danger'>
				<h4><i class='icon fa fa-ban'></i>Profile not deleted.</h4>
			</div>";
    }
  } 
  }else {
	 $help_func->redirect("view_user.php");
  }
 }
?>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of Category</h3>

            </div>
            <!-- /.box-header -->
            <!--box-body -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped" role="grid">
                <tr>
                  <th>Serial No.</th>
                  <th>First Name</th>
				  <th>Last Name</th>
				  <th>User Name</th>
				  <th>Email</th>
				  <th>Role</th>
			<?php if($user_row['user_id'] !== $get_user_id && session::get_s('user_role') == 'admin'){ ?>
                  <th>Action</th>
			<?php }?>
                </tr>
<!--php code for view category -->
<?php
  $sql = "SELECT * FROM `tbl_user` ORDER BY `user_id` ASC";
  $user_result = $db_func->read($sql);
  if($user_result){
    $serial = 0;
    while($user_row = $user_result->fetch_assoc()){
      $serial++;
?>
                <tr>
                  <td><?php echo $serial;?></td>
                  <td><?php echo $user_row['first_name'];?></td>
				  <td><?php echo $user_row['last_name'];?></td>
				  <td><?php echo $user_row['user_name'];?></td>
				  <td><?php echo $user_row['user_email'];?></td>
				  <td><?php echo $user_row['user_role'];?></td>
                  <td>
			<?php if($user_row['user_id'] !== $get_user_id && session::get_s('user_role') == 'admin'){ ?>
                    <a class="btn btn-success" href="user_edit_profile.php?userid=<?php echo $user_row['user_id']?>">
					            <span class="fa fa-edit"> </span>Edit</a>
                    <a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger" href="?delete_userid=<?php echo $user_row['user_id']?>"><span class="fa fa-trash-o"> </span></a>
			<?php }?>
                  </td>
                </tr>

<?php  } ?> <!-- Stop While loop -->
<?php  } ?>
<!--/php code for view category -->
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Dashboard footer -->

  <?php include "inc/dashboardFooter.php"; ?>
