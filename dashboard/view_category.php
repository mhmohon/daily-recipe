<?php include "inc/dashboardHeader.php"; ?>
<!-- Dashboard Sidebar -->
<?php include "inc/dashboardSidebar.php"; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>View Category List</h1>
    </section>
<?php
	
?>
<?php
  if(isset($_GET['catid'])){
    $get_id = $_GET['catid'];
	if(session::get_s('user_role') !== 'admin'){		
		$help_func->redirect("index.php");
	}else {
	// checking if there are any post from this Category id.
	$sql = "SELECT cat_id FROM `tbl_recipe` WHERE cat_id = '$get_id'";
	$check_result = $db_func->read($sql);
	if($check_result){ ?>
		<div class="alert alert-warning">
			<h4><i class="icon fa fa-warning"></i>Category Can't Delete!!! It has one or more Recipe post, First delete those post.</h4>
		</div>
<?php }else {
	// checking if there are any Category from this Category id.
	$sql = "SELECT cat_id FROM `tbl_category` WHERE `cat_id` = '$get_id'";
	$cat_exist = $db_func->read($sql);
	if($cat_exist){
		$sql = "DELETE FROM `tbl_category` WHERE `cat_id` = '$get_id'";
		$delete_result = $db_func->delete($sql);
		if($delete_result){ ?>
		  <div class="alert alert-success">
			<h4><i class="icon fa fa-check"></i>Category delete sucessfully.</h4>
		  </div>
<?php } else {
      echo "Some error occur.";
    }
	}else {
	echo "<div class='alert alert-danger'>
			<h4><i class='icon fa fa-ban'></i> Sorry, There is no category in this ID!</h4>
		</div>";  
	  }
	 }
   }
  }else {
	  
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
                  <th>Category Name</th>
                  <th>Action</th>
                </tr>
<!--php code for view category -->
<?php
  $sql = "SELECT * FROM `tbl_category` ORDER BY `cat_id` ASC";
  $cat_result = $db_func->read($sql);
  if($cat_result){
    $serial = 0;
    while($cat_row = $cat_result->fetch_assoc()){
      $serial++;
?>
                <tr>
                  <td><?php echo $serial;?></td>
                  <td><?php echo $cat_row['cat_name'];?></td>
                  <td>
				<?php if(session::get_s('user_role') == 'staff' || session::get_s('user_role') == 'admin'){?>
                    <a class="btn btn-success" href="edit_category.php?catid=<?php echo $cat_row['cat_id']?>">
					            <span class="fa fa-edit"> </span>Edit</a>
				<?php	} ?>
				<?php if(session::get_s('user_role') == 'admin'){?>
                    <a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger" href="?catid=<?php echo $cat_row['cat_id']?>"><span class="fa fa-trash-o"> </span></a>
				<?php	} ?>
                  </td>
                </tr>

<?php  } ?> <!-- Stop While loop -->
<?php  }else {
		echo "<td>No Category Found!!!</td>";
} ?>
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
