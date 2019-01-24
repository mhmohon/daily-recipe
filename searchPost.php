<?php
	include "inc/header.php";
?>
<?php
	if(!isset($_GET['searchkey']) || $_GET['searchkey']==null){
		header("Location:index.php");
	}else {
		$searchkey = $_GET['searchkey'];
	}
?>
<!-- header-bottom -->
	<div class="header-bottom">
<?php include "inc/social.php"; ?>

	<div class="clearfix"> </div>
<!-- blog -->
			<div class="blog">
				<div class="blog-left">
<?php
	$sql = "SELECT tbl_recipe.*, tbl_category.cat_name FROM `tbl_recipe`
		  INNER JOIN tbl_category
		  ON tbl_recipe.cat_id = tbl_category.cat_id
		  WHERE tbl_recipe.recipe_title LIKE '%$searchkey%'
		  OR tbl_recipe.recipe_author LIKE '%$searchkey%'
		  OR tbl_recipe.recipe_tags LIKE '%$searchkey%'
		  OR tbl_category.cat_name LIKE '%$searchkey%'
		  ORDER BY tbl_recipe.recipe_title DESC";
	$post = $db_conn->read($sql);
	if($post){
	while($row = $post->fetch_assoc()){	//Start while loop
?>
					<div class="blog-left-grid">
						<div class="blog-left-grid-left">
							<h3><a href="singlePost.php?id=<?php echo $row['recipe_id'];?>"><?php echo $row['recipe_title'];?></a></h3>
							<p>by <span><?php echo $row['recipe_author'];?></span> | <?php echo $l_method->formatDate($row['Date']);?> | <span><?php echo $row['recipe_tags'];?></span></p>
						</div>
						<div class="blog-left-grid-right">
							<a href="#" class="hvr-bounce-to-bottom non">20 Comments</a>
						</div>
						<div class="clearfix"> </div>
						<a href="singlePost.php?id=<?php echo $row['recipe_id'];?>">
						<img src="images/<?php echo $row['recipe_image'];?>" alt="Recipe Image" class="" height="200px" width="350px"/></a>
						<!--Post body-->
						<p class="para"><?php echo $l_method->textShorten($row['recipe_desc']);?></p>

						<div class="rd-mre">
							<a href="singlePost.php?id=<?php echo $row['recipe_id'];?>" class="hvr-bounce-to-bottom quod">Read More</a>
						</div>
					</div>
<?php }?><!--End While loop-->
<?php }else {?>
	<div class="blog-left-grid-left">
		<h3>your search query not found !!!</h3>
	</div>
<?php }?><!--End IF ELSE-->

				</div>
				<?php include "inc/sidebar.php"; ?>
				<div class="clearfix"> </div>
			</div>

<!-- //blog -->
	</div>
<!-- //header-bottom -->
	</div>
	</div>
<!-- //banner-body -->

<?php include "inc/footer.php"; ?>
