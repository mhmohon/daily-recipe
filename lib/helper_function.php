<?php
	class helperFuction{
		//For redirect to other page.
		public function redirect($url){
			if (!headers_sent()){
			  header('Location: '.$url);
			  exit;
			} else {
			  echo '<script type="text/javascript">';
			  echo 'window.location.href="'.$url.'";';
			  echo '</script>';
			  echo '<noscript>';
			  echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
			  echo '</noscript>';
			  exit;
		   }
		}
		public function highlightPage($Page){
			$path = $_SERVER['SCRIPT_FILENAME'];
			$currentPage = basename($path, '.php');
			if($currentPage == $Page){
				echo "active";
			} else {
				return false;
			}
		}
	}
?>
