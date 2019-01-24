<?php
	include "inc/header.php";
?>

<!-- pagination-->
<?php
	$total_page = 2;
	if(isset($_GET["page"])){
		$page = $_GET["page"];
	}else {
		$page = 1;
	}
	$start_form = ($page-1) * $total_page;
?>
<!-- pagination-->
<!-- header-bottom -->
	<div class="header-bottom">
<?php include "inc/social.php"; ?>
<?php include "inc/slider.php"; ?>
	<div class="clearfix"> </div>
<!-- blog -->

			<div class="blog">
				<div class="blog-left">
<?php
	$sql = "SELECT * FROM `tbl_recipe` WHERE status = 'Approve' order by `recipe_id` DESC limit $start_form, $total_page";
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
							<a href="#" class="hvr-bounce-to-bottom non">TotalView: <?php echo $row['views'];?></a>
						</div>
						<div class="clearfix"> </div>
						<!--Image-->
						
						<div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
							<div class="hovereffect">
								<img class="img-responsive" src="images/<?php echo $row['recipe_image'];?>" alt="Recipe Image">
								<div class="overlay">
								
								<a class="info" href="singlePost.php?id=<?php echo $row['recipe_id'];?>">View Recipe</a>
								</div>
							</div>
						</div>
						<div class="clearfix"> </div>
						<!--Post body-->
						<p class="para"><?php echo $l_method->textShorten($row['recipe_desc']);?></p>

						<div class="rd-mre">
							<a href="singlePost.php?id=<?php echo $row['recipe_id'];?>" class="hvr-bounce-to-bottom quod">Read More</a>
						</div>
					</div>
<?php }?><!--End While loop-->
<?php }else {?>
	<div class="blog-left-grid-left">
		<h3>Nothing to Show!!!</h3>
	</div>
<?php }?><!--End IF ELSE-->

<!--Start pagination-->
<?php
	$sql = "select * from tbl_recipe";
	$result = $db_conn->read($sql);
	if($result){
	$total_rows = mysqli_num_rows($result);
	$total_pages = ceil($total_rows/$total_page);
	echo "<span class='pagination'><a class='hvr-bounce-to-bottom non' href='index.php?page=1'>First Page</a>";
		for($i=1; $i<=$total_pages; $i++){
			echo "<a class='hvr-bounce-to-bottom non' href='index.php?page=".$i."'>".$i."</a>";
		}
	echo "<a class='hvr-bounce-to-bottom non' href='index.php?page=$total_pages'>Last Page</a></span>";
	}
?>

<!--End pagination-->
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
