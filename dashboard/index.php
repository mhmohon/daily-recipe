<!-- Dashboard Header -->
<?php include "inc/dashboardHeader.php"; ?>
<!-- Dashboard Sidebar -->
<?php include "inc/dashboardSidebar.php"; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
	<?php if(session::get_s('user_role')=='user'){ ?>
		<div class="col-lg-6 col-xs-8">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>Welcome</h3>

              <p>Recipe Contributor</p>
            </div>
            
          </div>
        </div>
	<?php }else { ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
			<?php 
				$sql = "SELECT * FROM `tbl_recipe`";
				$recipe_result = $db_func->read($sql);
				if(!$recipe_result){
					$recipe_row = 0;
				}else {
					$recipe_row = mysqli_num_rows($recipe_result);
				}
			?>
              <h3><?php echo $recipe_row; ?></h3>

              <p>Total Recipe</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="view_recipe.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            <?php 
				$sql = "SELECT * FROM `tbl_category`";
				$category_result = $db_func->read($sql);
				if(!$category_result){
					$category_row = 0;
				}else {
					$category_row = mysqli_num_rows($category_result);
				}
			?>
              <h3><?php echo $category_row; ?></h3>

              <p>Total Category</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="view_category.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
		<?php 
			$sql = "SELECT * FROM `tbl_user`";
			$user_result = $db_func->read($sql);
			if(!$user_result){
				$user_row = 0;
			}else {
				$user_row = mysqli_num_rows($user_result);
			}
		?>
              <h3><?php echo $user_row; ?></h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people"></i>
            </div>
            <a href="view_user.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
        
              <h3><?php echo ucwords(session::get_s('user_role')); ?></h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-person"></i>
            </div>
            <a href="user_profile.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
	<?php } ?>
      </div>
      <!-- /.row -->
	  
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Dashboard footer -->
  <?php include "inc/dashboardFooter.php"; ?>
