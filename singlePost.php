<?php include "inc/header.php"; ?>
<?php
	//Get The recipe id
	if(!isset($_GET['id']) || $_GET['id']==null){
		header("Location:index.php");
	}else {
		$id = $_GET['id'];
		$sql = "UPDATE tbl_recipe SET views = views + 1 WHERE recipe_id = '$id'";
		$views = $db_conn->update($sql);
	}
?>


<!-- single -->
	<div class="single-page-artical">
<?php
	$sql = "select * from `tbl_recipe` where `recipe_id`=$id";
	$post = $db_conn->read($sql);
	if($post){
	while($row = $post->fetch_assoc()){ //Start first while loop
?>
		<div class="artical-content">
			<h3><?php echo $row['recipe_title'];?></h3>
			<section class="artical_first">
				<div class="recipeImage col-md-6">
					<img class="img-responsive" src="images/<?php echo $row['recipe_image'];?>" alt=" " />
				</div>
				<div class="recipeDesc overflow col-md-6">
					<h2 class="description_h2">Description</h2>
					<p>
						<?php echo $row['recipe_desc'];?>
					</p>
					<span class="ingredient__header__toggles">
						<span>
							<span class="fa fa-clock-o"></span>
							<small class="no"> </small>
							<span><?php echo $row['recipe_pre_time'];?></span>					
						</span>
						<span>
							<span class="icon--stats-clock"></span><small class="no">Cook Time: </small><span><?php echo $row['recipe_c_time'];?></span>
							
						</span>
						<span>
							<span class="fa fa-cutlery"> </span>
							<small class="no"> </small>
							<span class="ng-binding"><?php echo $row['recipe_serving'];?></span>
							<span class="servings_count__desc"> servings</span>
						</span>
						
					</span>
				</div>
			</section>
			<?php if($row['recipe_video']){?>
				<div class="recipe_video col-md-12">			
					<iframe width="750" height="380" src="https://www.youtube.com/embed/<?php echo stripslashes($row['recipe_video']);?>" frameborder="0" allowfullscreen></iframe><br>
				</div>
			<?php } ?>
			<section class="ingredient col-md-4">
				<div class="ingredient_head">
					<h2 class="ingredient_h2">Ingredients</h2>
				
				</div>
				<div class="ingredient_body">
					<?php
						$lines = explode("\n", $row['recipe_ingre']); // or use PHP PHP_EOL constant
						if ( !empty($lines) ) {
						  echo '<ol class="list_desc">';
						  foreach ( $lines as $line ) {
							echo '<li>'. trim( $line ) .'</li>';
						  }
						  echo '</ol>';
						}
					?>
				</div>
			</section>

			<section class="directions col-md-8">
				<div class="directions_head">
					<h2 class="directions_h2">Directions</h2>
				</div>
				<div class="directions_body">
					<?php
						$lines = explode("\n", $row['recipe_direc']); // or use PHP PHP_EOL constant
						if (!empty($lines)) {
						  echo '<ol class="list_desc">';
						  foreach ( $lines as $line ) {
							echo '<li>'. trim( $line ) .'</li>';
						  }
						  echo '</ol>';
						}
					?>
				</div>
			</section>
		</div>
		
		<div class="artical-links col-md-12">
			<ul>
				<li><small class="admin"> </small><span><?php echo $row['recipe_author'];?></span></li>
				<li><small> </small><span>Total Views <?php echo $row['views'];?></span></li>
				<li><small> </small><span><?php echo $l_method->formatDate($row['Date']);?></span></li>			
			</ul>
		</div>
		
	<?php } ?> <!--End first While loop-->
	<?php }else {
		echo "<h2 class='description_h2'>No Post for this id</h2>";
	} ?> <!--End IF ELSE-->
	</div>
<!-- single -->
		</div>
	</div>
<?php include "inc/footer.php"; ?>
