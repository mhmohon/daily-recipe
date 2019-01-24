<?php
	include "inc/header.php";
?>
<?php
	if(!isset($_GET['categoryid']) || $_GET['categoryid']==null){
		header("Location:index.php");
	}else {
		$categoryid = $_GET['categoryid'];
	}
?>
<!-- header-bottom -->
	<div class="header-bottom">


	<div class="clearfix"> </div>
<!-- blog -->
			<div class="blog">
				<div class="blog-left">
<?php
	$sql = "SELECT * FROM `tbl_recipe` WHERE cat_id = '$categoryid'";
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
		<h3>No post in this category!!!</h3>
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
