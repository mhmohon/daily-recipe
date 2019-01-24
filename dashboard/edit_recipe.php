<!-- Dashboard Header -->
<?php include "inc/dashboardHeader.php"; ?>
<!-- Dashboard Sidebar -->
<?php include "inc/dashboardSidebar.php"; ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<!-- PHP code for get the id -->

<?php
	
  if(!isset($_GET['editid']) || $_GET['editid'] == null){
    $help_func->redirect("view_recipe.php");
  } else {
    $get_id = $_GET['editid'];
	$sql = "SELECT * FROM tbl_recipe WHERE recipe_id = '$get_id'";
	$result = $db_func->read($sql);
	if($result){
		$result_row = $result->fetch_assoc();
		//Check user role and user id.
		if(session::get_s('user_role') == 'user' && session::get_s('user_id') !== $result_row['user_id']){		
			$help_func->redirect("view_recipe.php");
		}
	}
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
<!-- PHP code for add new recipe -->
<?php
  //get the post data
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $recipe_title = mysqli_real_escape_string($get_conn, $_POST['recipeTitle']);
    $recipe_author = mysqli_real_escape_string($get_conn, $_POST['recipeAuthor']);
    $recipe_tags = mysqli_real_escape_string($get_conn, $_POST['recipeTags']);
    $recipe_category = mysqli_real_escape_string($get_conn, $_POST['recipeCategory']);
    $recipe_level = mysqli_real_escape_string($get_conn, $_POST['recipeLevel']);
    $recipe_desc = mysqli_real_escape_string($get_conn, $_POST['recipeDescr']);
    $recipe_pre_time = mysqli_real_escape_string($get_conn, $_POST['recipePTime']);
    $recipe_c_time = mysqli_real_escape_string($get_conn, $_POST['recipeCTime']);
    $recipe_serving = mysqli_real_escape_string($get_conn, $_POST['recipeServing']);
    $recipe_ingre = mysqli_real_escape_string($get_conn, $_POST['recipeIngre']);
    $recipe_direc = mysqli_real_escape_string($get_conn, $_POST['recipeDirec']);
    $recipe_video = substr($_POST['recipeVideo'],-11);


    //Uploded image
    $validextension = array('jpeg', 'jpg', 'png', 'gif',);
    $file_name = $_FILES['recipeImage']['name'];
    $file_size = $_FILES['recipeImage']['size'];
    $file_temp = $_FILES['recipeImage']['tmp_name'];
    $find_ext = explode('.', $file_name);
    $file_ext = strtolower(end($find_ext));
    $uploaded_image_name = substr(md5(time()),0,10).'.'.$file_ext;

    if(empty($recipe_title) || empty($recipe_author) || empty($recipe_tags) || empty($recipe_category) || empty($recipe_level) || empty($recipe_desc) || empty($recipe_pre_time) || empty($recipe_c_time) || empty($recipe_serving) || empty($recipe_ingre) || empty($recipe_direc) || !is_numeric($recipe_serving)){ ?>
      <div class="alert alert-danger">
        <h4><i class="icon fa fa-ban"></i> Fill all the field accurately!</h4>
		<p>Number of serving must be integer.</p>
      </div>

<?php } else {
		if(!empty($file_name)){
			if ($file_size>2045254) {
				  echo "<div class='alert alert-warning'>
							<h4><i class='icon fa fa-warning'></i> Image size too large. Image must be less than 3 megabytes!</h4>
						</div>";

			  } elseif (in_array($file_ext, $validextension)===false){
				  echo "<div class='alert alert-warning'>
							<h4><i class='icon fa fa-warning'></i> You can upload only ".implode(', ',$validextension).".</h4>
						</div>";

			  } else {
				move_uploaded_file($file_temp, "../images/".$uploaded_image_name);
				$sql = "UPDATE `tbl_recipe`
                SET
                cat_id = '$recipe_category',
                recipe_title = '$recipe_title',
                recipe_author = '$recipe_author',
                recipe_tags = '$recipe_tags',
                recipe_level = '$recipe_level',
                recipe_image = '$uploaded_image_name',
                recipe_video = '$recipe_video',
                recipe_pre_time = '$recipe_pre_time',
                recipe_c_time = '$recipe_c_time',
                recipe_serving = '$recipe_serving',
                recipe_desc = '$recipe_desc',
                recipe_ingre = '$recipe_ingre',
                recipe_direc = '$recipe_direc'
                WHERE recipe_id = $get_id";
				$recipe_update = $db_func->update($sql);
				if($recipe_update){ ?>
				  <div class="alert alert-success">
					<h4><i class="icon fa fa-check"></i> Recipe update sucessfully !</h4>
				  </div>

		<?php 	} else {
					echo "Data not updated";
				}
			}
		} else {
      $sql = "UPDATE `tbl_recipe`
              SET
              cat_id = '$recipe_category',
              recipe_title = '$recipe_title',
              recipe_author = '$recipe_author',
              recipe_tags = '$recipe_tags',
              recipe_level = '$recipe_level',
              recipe_video = '$recipe_video',
              recipe_pre_time = '$recipe_pre_time',
              recipe_c_time = '$recipe_c_time',
              recipe_serving = '$recipe_serving',
              recipe_desc = '$recipe_desc',
              recipe_ingre = '$recipe_ingre',
              recipe_direc = '$recipe_direc'
              WHERE recipe_id = $get_id";
      $recipe_update = $db_func->update($sql);
      if($recipe_update){ ?>
        <div class="alert alert-success">
        <h4><i class="icon fa fa-check"></i> Recipe update sucessfully !</h4>
        </div>

  <?php 	} else {
        echo "Data not updated";
      }
		}
  }
}

?>
<!-- PHP code for view recipe -->
<?php
//PHP code for view recipe
  $sql = "SELECT * FROM `tbl_recipe` WHERE recipe_id = '$get_id' ORDER BY `recipe_id` ASC";
  $exist_recipe = $db_func->read($sql);
	if($exist_recipe){
		$recipe_row = $exist_recipe->fetch_assoc();
	}else {
		  $help_func->redirect("view_recipe.php");
	}
?>
<!-- general form elements -->
          <div class="box box-primary">
              <!-- box-header -->
            <div class="box-header with-border">
              <h3 class="box-title">Update Recipe</h3><br>
			  <div class="recipeImage">
				<img class="images" src="../images/<?php echo $recipe_row['recipe_image'];?>"/>
				
			  </div>
            </div>
            <!-- form start -->
            <form action="" method="post" role="form" class="form-vertical" enctype="multipart/form-data">
              <div class="box-body">
                <div class="col-sm-6 form-group">
                  <label>Recipe Title</label>
                    <input type="text" name="recipeTitle" value="<?php echo $recipe_row['recipe_title'];?>" class="form-control">
                </div>
				<div class="col-sm-6 form-group">
				   <label class="control-label">Recipe Photo</label>
					<div>
						<input type="file" class="form-control" value="<?php echo $recipe_row['recipe_image'];?>" name="recipeImage"/>
					</div>
                </div>

				<div class="col-sm-6 form-group">
					<label>Author</label>
					<input type="text" name="recipeAuthor" value="<?php echo $recipe_row['recipe_author'];?>" class="form-control">
                </div>
				<div class="col-sm-6 form-group">
				   <label class="control-label">Tags</label>
					<div>
						<input type="text" name="recipeTags" value="<?php echo $recipe_row['recipe_tags'];?>" class="form-control">
					</div>
                </div>

        				<div class="col-sm-12 form-group">
                  <label>Recipe Video</label>
				  
                  <input type="text" name="recipeVideo"
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
						<select class="form-control" name="recipeCategory">

<?php
  $sql = "SELECT * FROM tbl_category";
  $cat_result = $db_func->read($sql);
  if($cat_result){
    while($result_row = $cat_result->fetch_assoc()){ ?>

						  <option
						<?php if($recipe_row['cat_id'] == $result_row['cat_id']){ ?>
							selected="selected"
						<?php } ?> value="<?php echo $result_row['cat_id'];?>">
							<?php echo $result_row['cat_name'];?>
						  </option> 
<?php  }
    }else {
      echo "<option>No Category found</option>";
    }
?>
          				</select>
                  </div>
                </div>
        		<div class="col-sm-6 form-group">
                  <label>Difficulty Level</label>
                  <div>
					  <select class="form-control" name="recipeLevel">
					<?php if($recipe_row['recipe_level'] == 'Easy'){ ?>
						<option selected>Easy</option>
						<option>Medium</option>
						<option>Hard</option>
					<?php }?>
					<?php if($recipe_row['recipe_level'] == 'Medium'){ ?>
						<option>Easy</option>
						<option selected>Medium</option>
						<option>Hard</option>
					<?php }?>
					<?php if($recipe_row['recipe_level'] == 'Hard'){ ?>
						<option>Easy</option>
						<option selected>Medium</option>
						<option>Hard</option>
					<?php }?>
					  </select>
                  </div>
                </div>

        				<div class="col-sm-12 form-group">
                  <label class="control-label">Short Description</label>
        					<textarea rows="3" class="form-control" name="recipeDescr"><?php echo $recipe_row['recipe_desc'];?></textarea>
                </div>

        				<div>
        					<div class="col-sm-4 form-group">
        						<label>Prep Time</label>
        						<input type="text" name="recipePTime" value="<?php echo $recipe_row['recipe_pre_time'];?>" class="form-control">
        					</div>
        					<div class="col-sm-4 form-group">
        						<label>Cook Time</label>
        						<input type="text" name="recipeCTime" value="<?php echo $recipe_row['recipe_c_time'];?>" class="form-control">
        					</div>
        					<div class="col-sm-4 form-group">
        						<label>Number of serving</label>
        						<input type="text" name="recipeServing" value="<?php echo $recipe_row['recipe_serving'];?>" class="form-control">
        					</div>
        				</div>

        				<div>
        					<div class="col-sm-5 form-group">
        					  <label class="control-label">Ingredients</label>
        						<textarea rows="10" class="form-control" name="recipeIngre"><?php echo $recipe_row['recipe_ingre'];?></textarea>
        						<small>Put each ingredients on its own line.</small>
        					</div>
        					<div class="col-sm-7 form-group">
        					  <label class="control-label">Directions</label>
        						<textarea rows="10" class="form-control" name="recipeDirec"><?php echo $recipe_row['recipe_direc'];?></textarea>
        						<small>Put each directions on its own line.</small>
        					</div>
        				</div>
					<input type="hidden" value="<?php echo session::get_s('user_id')?>" name="userId" class="form-control">
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-danger pull-left">Update Recipe</button>
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
