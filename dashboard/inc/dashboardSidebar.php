<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/seo.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo ucwords(session::get_s('user_name'));?></p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header"><a href="../index.php">VISIT THE SITE</a></li>
        <li class="treeview <?php $help_func->highlightPage('index') ?>">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>  
        </li>
        <li class="treeview <?php $help_func->highlightPage('add_category')|| $help_func->highlightPage('view_category')?>">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Category Option</span>
			<span class="pull-right-container">
			  <i class="fa fa-angle-left pull-right"></i>
			</span>
          </a>
          <ul class="treeview-menu">
		<?php if(session::get_s('user_role') == 'admin'){?>
            <li><a href="add_category.php"><i class="fa fa-circle-o"></i> Add New Category</a></li>
		<?php	} ?>
            <li><a href="view_category.php"><i class="fa fa-circle-o"></i> Category List</a></li>
          </ul>
        </li>
        <li class="treeview <?php $help_func->highlightPage('add_recipe')|| $help_func->highlightPage('view_recipe')?>">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Recipe Option</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="add_recipe.php"><i class="fa fa-circle-o"></i> Add New Recipe</a></li>
            <li><a href="view_recipe.php"><i class="fa fa-circle-o"></i> Recipe List</a></li>
          </ul>
        </li>
        
	<?php	if((session::get_s('user_role') == 'admin') || session::get_s('user_role') == 'staff'){?>
        <li class="treeview <?php $help_func->highlightPage('view_user') ?>">
          <a href="view_user.php">
            <i class="fa fa-users"></i> <span>User List</span>
          </a>  
        </li>
	<?php	} ?>
		<li class="treeview <?php $help_func->highlightPage('user_profile') ?>">
          <a href="user_profile.php">
            <i class="fa fa-user"></i> <span>My Profile</span>
          </a>  
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
