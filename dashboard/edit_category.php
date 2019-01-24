<!-- Dashboard Header -->
<?php include "inc/dashboardHeader.php"; ?>
<!-- Dashboard Sidebar -->
<?php include "inc/dashboardSidebar.php"; ?>
<!-- PHP code for get the id -->

<?php
  if(!isset($_GET['catid']) || $_GET['catid'] == null){
    $help_func->redirect("view_category.php");
  } else {
    $get_id = $_GET['catid'];

  }
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Here you can update your category.<h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-xs-12">
		  <!-- general form elements -->
          <div class="box box-primary box_center">
            <div class="box-header with-border">
              <h3 class="box-title">Update category</h3>
            </div>

            <!-- /.box-header -->
            <!-- form start -->
<!-- PHP code for update category -->
<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $new_cat_name = mysqli_real_escape_string($get_conn, $_POST['cat_name']);
    if($new_cat_name==null){ ?>
      <div class="alert alert-danger">
        <h4><i class="icon fa fa-ban"></i> Insert Category Name!</h4>
      </div>
<?php } else {
        $sql = "SELECT * FROM tbl_category WHERE cat_name = '$new_cat_name'";
        $cat_result = $db_func->read($sql);
        if($cat_result){ ?>
          <div class="alert alert-warning">
            <h4><i class="icon fa fa-warning"></i> Can't add because <?php echo $new_cat_name;?> already exists in system!</h4>
          </div>
<?php } else {
        $sql = "UPDATE `tbl_category`
                SET
                cat_name = '$new_cat_name'
                WHERE cat_id = '$get_id'";
        $update_cat = $db_func->update($sql);
        if($update_cat){ ?>
          <div class="alert alert-success">
            <h4><i class="icon fa fa-check"></i>Category update sucessfully.<a href="view_category.php" class="btn btn-primary pull-right">Category List</a></h4>
          </div>
<?php } else {
        echo "Not updated";
      }
    }
  }
}
?>
<!-- /PHP code for update category -->
<?php
//PHP code for view category
  $sql = "SELECT * FROM tbl_category WHERE cat_id = '$get_id' ORDER BY cat_id";
  $cat_list = $db_func->read($sql);
  if(!$cat_list){
	  $help_func->redirect("view_category.php");
  }else {
	$list_row = $cat_list->fetch_assoc()
?>
            <form action="" method="post" role="form" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Category Name</label>

                  <div class="col-sm-6">
                    <input type="text" name="cat_name" value="<?php echo $list_row['cat_name'];?>" class="form-control">
                  </div>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-info pull-right">Submit</button>
              </div>
            </form>
  <?php } ?>
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
  <?php include "inc/dashboardFooter.php"; ?>
