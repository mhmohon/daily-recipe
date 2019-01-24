<!-- Dashboard Header -->
<?php include "inc/dashboardHeader.php"; ?>
<!-- Dashboard Sidebar -->
<?php include "inc/dashboardSidebar.php"; ?>
<!-- Content Wrapper. Contains page content -->
<?php
	if(session::get_s('user_role') !== 'admin'){	
		$help_func->redirect("view_category.php");
	}
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Here you can add new categories for your post...</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-xs-12">

      <!-- general form elements -->
          <div class="box box-primary box_center">
            <div class="box-header with-border">
              <h3 class="box-title">Add new category</h3>
            </div>
<!-- PHP code for add category -->
<?php
  //get the post data
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $cat_name = mysqli_real_escape_string($get_conn, $_POST['cat_name']);
    if($cat_name == null){ ?>
		<div class="alert alert-danger">
          <h4><i class="icon fa fa-ban"></i>Category Name Can't Empty!</h4>
        </div>

<?php }elseif(is_numeric($cat_name)){ ?>
		<div class="alert alert-danger">
          <h4><i class="icon fa fa-ban"></i> Insert valid Category Name!</h4>
		  <p>Name can't contain any number.</p>
        </div>
<?php }else {
      $sql = "SELECT * FROM tbl_category WHERE cat_name = '$cat_name'";
      $cat_result = $db_func->read($sql);
		  if($cat_result){ ?>
			<div class="alert alert-warning">
			  <h4><i class="icon fa fa-warning"></i> Can't create because <?php echo $cat_name;?> already exists in system!</h4>
			</div>
	<?php }else {
			$sql = "INSERT INTO tbl_category(cat_name) VALUES('$cat_name')";
			$cat_insert = $db_func->insert($sql);
			if($cat_insert){ ?>

			  <div class="alert alert-success">
				<h4><i class="icon fa fa-check"></i> <?php echo $cat_name;?> Category created successfully.</h4>
			  </div>

	<?php     }
			}
      }
  }
?>
<!-- /PHP code for add category -->

            <!-- /.box-header -->
            <!-- form start -->
            <form action="add_category.php" method="post" role="form" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Category Name</label>

                  <div class="col-sm-6">
                    <input type="text" name="cat_name" placeholder="Type category name" class="form-control">
                  </div>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->

        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Dashboard footer -->
  <?php include "inc/dashboardFooter.php"; ?>
