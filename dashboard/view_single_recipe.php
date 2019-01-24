<!-- Dashboard Header -->
<?php include "inc/dashboardHeader.php"; ?>
<!-- Dashboard Sidebar -->
<?php include "inc/dashboardSidebar.php"; ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<!-- PHP code for get the id -->
<?php
  if(!isset($_GET['viewid']) || $_GET['viewid'] == null){
    $help_func->redirect("view_recipe.php");
  } else {
    $get_id = $_GET['viewid'];

  }
?>
    <section class="content-header">
      <h1>Here you can edit Recipes!!!</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-xs-12">

<!-- PHP code for view recipe -->
<?php
//PHP code for view recipe
  $sql = "SELECT * FROM `tbl_recipe` WHERE recipe_id = '$get_id' ORDER BY `recipe_id`";
  $recipe_result = $db_func->read($sql);
  if(!$recipe_result){
	  
	$help_func->redirect("view_recipe.php");  
  }else {
	$recipe_row = $recipe_result->fetch_assoc();
  }
?>
<!-- general form elements -->
          <div class="box box-primary">
              <!-- box-header -->
            <div class="box-header with-border">
              <h3 class="box-title">View Recipe</h3><br>
			  <div class="recipeImage">
				<img class="images" src="../images/<?php echo $recipe_row['recipe_image'];?>"/>
				
			  </div>
            </div>
            <!-- form start -->
            <form action="" method="post" role="form" class="form-vertical" enctype="multipart/form-data">
              <div class="box-body">
                <div class="col-sm-12 form-group">
                  <label>Recipe Title</label>
                    <input type="text" readonly name="recipeTitle" value="<?php echo $recipe_row['recipe_title'];?>" class="form-control">
                </div>
				

				<div class="col-sm-6 form-group">
					<label>Author</label>
					<input type="text" readonly name="recipeAuthor" value="<?php echo $recipe_row['recipe_author'];?>" class="form-control">
                </div>
				<div class="col-sm-6 form-group">
				   <label class="control-label">Tags</label>
					<div>
						<input type="text" readonly name="recipeTags" value="<?php echo $recipe_row['recipe_tags'];?>" class="form-control">
					</div>
                </div>

        		<div class="col-sm-12 form-group">
                  <label>Recipe Video</label>
                  <input type="text"  readonly name="recipeVideo"
				  <?php					
					if($recipe_row['recipe_video']){ 
				  ?>
					value="<?php echo "https://www.youtube.com/embed/".$recipe_row['recipe_video'];?>" 
					<?php } ?>
				  class="form-control">
        					<small>Optional: If you have your recipe video on Youtube or any of the other supported Embed sites, then you can use the field above. Just past the URL.</small>
                </div>

        				<div class="col-sm-6 form-group">
                  <label>Recipe Category</label>
                  <div>
					
<?php
  $sql = "SELECT * FROM tbl_category";
  $cat_result = $db_func->read($sql);
  if($cat_result){
	while($result_row = $cat_result->fetch_assoc()){
?>									
					<?php if($recipe_row['cat_id'] == $result_row['cat_id']){ ?>
						<input type="text" readonly value="<?php echo $result_row['cat_name'];?>" class="form-control"/>
					<?php } ?>						  
<?php
	}
    }				
?>
					
                  </div>
                </div>
        		<div class="col-sm-6 form-group">
                  <label>Difficulty Level</label>
                  <div>
					  <input type="text" readonly value="<?php echo $recipe_row['recipe_level'];?>" class="form-control">
                  </div>
                </div>

        				<div class="col-sm-12 form-group">
                  <label class="control-label">Short Description</label>
        					<textarea rows="3" readonly class="form-control"><?php echo $recipe_row['recipe_desc'];?></textarea>
                </div>

        				<div>
        					<div class="col-sm-4 form-group">
        						<label>Prep Time</label>
        						<input type="text" readonly value="<?php echo $recipe_row['recipe_pre_time'];?>" class="form-control">
        					</div>
        					<div class="col-sm-4 form-group">
        						<label>Cook Time</label>
        						<input type="text" readonly  value="<?php echo $recipe_row['recipe_c_time'];?>" class="form-control">
        					</div>
        					<div class="col-sm-4 form-group">
        						<label>Number of serving</label>
        						<input type="text" readonly  value="<?php echo $recipe_row['recipe_serving'];?>" class="form-control">
        					</div>
        				</div>

        				<div>
        					<div class="col-sm-5 form-group">
        					  <label class="control-label">Ingredients</label>
        						<textarea rows="10" readonly class="form-control" ><?php echo $recipe_row['recipe_ingre'];?></textarea>
        						<small>Put each ingredients on its own line.</small>
        					</div>
        					<div class="col-sm-7 form-group">
        					  <label class="control-label">Directions</label>
        						<textarea rows="10" readonly class="form-control"><?php echo $recipe_row['recipe_direc'];?></textarea>
        						<small>Put each directions on its own line.</small>
        					</div>
        				</div>
					<input type="hidden" value="<?php echo session::get_s('user_id')?>" name="userId" class="form-control">
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <a href="view_recipe.php" type="submit" class="btn btn-info pull-left">Done</a>
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
