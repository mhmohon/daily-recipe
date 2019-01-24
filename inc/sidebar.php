<div class="blog-right">
					
					<div class="newsletter">
						<h3>Search</h3>
						<form action="searchPost.php" method="get">
							<input type="text" name="searchkey" placeholder="Search Item" required="">
							<input type="submit" value="Search">
						</form>
					</div>
					
					<div class="pgs">
						<h3>Category</h3>
						<ul>
<?php
	$sql = "select * from `tbl_category` order by `cat_id` ASC";
	$cat_list = $db_conn->read($sql);
	if($cat_list){
	while($cat_row = $cat_list->fetch_assoc()){	//Start while loop
?>
						<li><a href="categoryPost.php?categoryid=<?php echo $cat_row['cat_id'];?>"><?php echo $cat_row['cat_name'];?></a></li>
<?php 
	}
}else {
		echo "<li>No Category Found</li>";
} 
?>
						</ul>
					</div>
</div>