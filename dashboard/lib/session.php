<?php
  class session {
	
	public static $sessionStarted = false;
    public static function start(){
		if(self::$sessionStarted == false){
			session_start();
			self::$sessionStarted == true;
		}      
      }
    public static function set_s($key, $value){

      $_SESSION[$key] = $value;
    }
    public static function get_s($key){
      if(isset($_SESSION[$key])){
        return $_SESSION[$key];
      } else {
        return false;
      }
    }
    public static function sessionChecker(){
      self::start();
      if(self::get_s("login") == false){
        self::destroy();
        echo "<script>location.href='../login.php'</script>";
      }
    }
    public static function destroy(){
		if($sessionStarted = true){
			session_unset();
			session_destroy();
			echo ("<script>location.href='../login.php'</script>");
		}
	}
  }
?>
