
<?php
  class db_config {
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private static $db_conn;
    private static $instance;

    public function __Construct(){
      //Create a connection to localhost server.
      self::$db_conn = mysqli_connect($this->db_host, $this->db_user, $this->db_pass)
        or die("Error: ".self::$db_conn->error."<br>Error line number: ".__LINE__);
    }

    public static function getConnection(){
      //Create a class instance.
      if(self::$instance==null){
        self::$instance = new db_config();
      }
      return self::$db_conn;
    }
    public static function selectDB($dbname){
      //Select the database.
      $result = mysqli_select_db(self::$db_conn, $dbname);
	  if(!$result){
		  header('Location:database/setup_db.php');
	  }
    }


  }
?>
