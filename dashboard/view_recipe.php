<?php include "inc/dashboardHeader.php"; ?>
<!-- Dashboard Sidebar -->
<?php include "inc/dashboardSidebar.php"; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<!-- pagination-->
<?php
	$get_role = session::get_s('user_role');// For set user role.
	$get_user_id = session::get_s('user_id');
	$total_page = 4;
	if(isset($_GET["page"])){
		$page = $_GET["page"];
	}else {
		$page = 1;
	}
	$start_form = ($page-1) * $total_page;
?>
<!-- /pagination-->
    <section class="content-header">
      <h1>View Recipe List</h1>
	  <div class="page_info">
		<h4><span>Edit: <span/><span class="btn btn-info fa fa-edit"></span>
		<span>Delete: <span/><span class="btn btn-danger fa fa-trash-o"></span>
		<span>Approve: <span/><span class="btn btn-success fa fa-check-square-o"></span></h4><br>
		<h4 style="color:#F04709">Click on recipe title to view specific recipe.</h4>
	  </div>
    </section>
<!-- Php code for delete and aprrove recipe -->
<?php
	//Delete any recipe post.
  if(isset($_GET['deleteid'])){
	  
		$get_id = $_GET['deleteid'];
		$sql = "SELECT * FROM tbl_recipe WHERE recipe_id = '$get_id'";
		$result = $db_func->read($sql);
		if($result){
			$result_row = $result->fetch_assoc();
			//Check user role and user id.
			if($get_role == 'user' && $get_user_id !== $result_row['user_id']){		
				$help_func->redirect("view_recipe.php");
			}else {			
				$dellink = $result_row['recipe_image'];
				unlink('../images/'.$dellink);
				$delquery = "DELETE FROM tbl_recipe WHERE tbl_recipe.recipe_id = '$get_id'";
				$delresult = $db_func->delete($delquery);
				if($delresult){ ?>
				  <div class="alert alert-success">
					<h4><i class="icon fa fa-check"></i>Recipe delete sucessfully.</h4>
				  </div>
<?php 			} 
			}
		}else {	   
			 echo "<div class='alert alert-danger'>
					<h4><i class='icon fa fa-ban'></i> Sorry, There is no recipe in this ID!</h4>
				</div>";  	  
		}     
	}
  
  //Approve any recipe post.
  if(isset($_GET['approveid'])){
	if(session::get_s('user_role') == 'user'){		
		$help_func->redirect("view_recipe.php");
	}else {
    $get_id = $_GET['approveid'];
	$sql = "SELECT * FROM tbl_recipe WHERE tbl_recipe.recipe_id = '$get_id' AND status = 'Pending'";
	$result = $db_func->read($sql);
	if($result){
		$updatequery = "UPDATE `tbl_recipe`
                SET
                status = 'Approve'
                WHERE recipe_id = '$get_id'";
		$updateresult = $db_func->update($updatequery);
		if($updateresult){ ?>
		  <div class="alert alert-success">
			<h4><i class="icon fa fa-check"></i>Recipe approve sucessfully</h4>
		  </div>
 <?php }else {
		echo "Some error occur.";
		}
	}else { ?>
		<div class="alert alert-warning">
			<h4><i class="icon fa fa-warning"></i>Recipe already approve!!!</h4>
		</div>
<?php }
	}
}
 ?>
 <!-- /Php code for delete and aprrove recipe -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
			
            <div class="box-header">
              <h3 class="box-title">List of Recipe</h3>
			  

              <div class="box-tools">

				<form action="search_recipe.php" method="get">
					<div class="input-group input-group-sm" style="width: 200px;">
					  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

					  <div class="input-group-btn">
						<button type="submit" class="btn btn-info pull-right"><i class="fa fa-search"></i></button>
						
					  </div>
					</div>
				</form>
              </div>
            </div>
            <!-- /.box-header -->
            <!--box-body -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-striped" role="grid">
                <thead>
                  <th>Number</th>
                  <th>Recipe Title</th>
				  <th>Category</th>
				  <th>Author</th>
				  <th>Level</th>
				  <th>Prep+CookTime</th>
				  <th>serving</th>
				  <th>Description</th>
				  <th>Ingredients</th>
				  <th>Directions</th>
				  <th>Status</th>
                  <th>Action</th>
                </thead>
				<tbody>
<!--php code for view category -->
<?php
  $sql = "SELECT tbl_recipe.*, tbl_category.cat_name FROM `tbl_recipe`
		  INNER JOIN tbl_category
		  ON tbl_recipe.cat_id = tbl_category.cat_id
		  ORDER BY tbl_recipe.recipe_title DESC limit $start_form, $total_page";
  $recipe_result = $db_func->read($sql);
  if($recipe_result){
    $number = 0;
    while($recipe_row = $recipe_result->fetch_assoc()){
      $number++;
?>              
				<tr>
                  <td><?php echo $number;?></td>
                  <td><a href="view_single_recipe.php?viewid=<?php echo $recipe_row['recipe_id']?>"><?php echo $recipe_row['recipe_title'];?></a></td>
				  <td><?php echo $recipe_row['cat_name'];?></td>
				  <td><?php echo $recipe_row['recipe_author'];?></td>
				  <td><?php echo $recipe_row['recipe_level'];?></td>
				  <td><?php echo $recipe_row['recipe_pre_time'].", ".$recipe_row['recipe_c_time'];?></td>
				  <td><?php echo $recipe_row['recipe_serving'];?></td>
				  <td><?php echo $l_method->textShorten($recipe_row['recipe_desc'],50);?></td>
				  <td><?php echo $l_method->textShorten($recipe_row['recipe_ingre'],50);?></td>
				  <td><?php echo $l_method->textShorten($recipe_row['recipe_direc'],50);?></td>
				  <td>
				<?php 
					if($recipe_row['status']== 'Approve'){
						echo "<span class='label label-success'>".$recipe_row['status']."</span>";
					}elseif($recipe_row['status']== 'Pending') {
						echo "<span class='label label-warning'>".$recipe_row['status']."</span>";
					}
				 ?>
				  </td>
                  <td style="width:13%">
			<?php if($get_role == 'admin' || $get_role == 'staff' || $get_user_id == $recipe_row['user_id']){ ?>
                    <a class="btn btn-info" href="edit_recipe.php?editid=<?php echo $recipe_row['recipe_id']?>">
					            <span class="fa fa-edit"></span></a>
                    <a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger" href="?deleteid=<?php echo $recipe_row['recipe_id']?>"><span class="fa fa-trash-o"></span></a>
			<?php }?>		
			<?php if($get_role == 'admin' || $get_role == 'staff'){ ?>
					<a onclick="return confirm('Are you sure you want to approve?')" class="btn btn-success" href="?approveid=<?php echo $recipe_row['recipe_id']?>"><span class="fa fa-check-square-o"></span></a>
			<?php }?>	
                  </td>
				</tr>               
<?php  } ?> <!-- Stop While loop -->
<?php  } else {
			echo "<tr><td>No Recipe Found!!!</td></tr>";
		} ?>
<!--/php code for view category -->
				</tbody>
				<tfoot>
				<tr>
<!--Start pagination-->
<?php
	$sql = "select * from tbl_recipe";
	$result = $db_func->read($sql);
	if($result){
	$total_rows = mysqli_num_rows($result);
	$total_pages = ceil($total_rows/$total_page);
	echo "<th colspan='12'><div class='paging_simple_numbers'>
			<a class='paginate_button' href='view_recipe.php?page=1'>First Page</a>";
			for($i=1; $i<=$total_pages; $i++){
				echo "<a class='paginate_button' href='view_recipe.php?page=".$i."'>".$i."</a>";
			}
	echo "<a class='paginate_button' href='view_recipe.php?page=$total_pages'>Last Page</a></div></th>";
	}
?>
<!--End pagination-->
				</tr>
				</tfoot>
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
