<?php
  include_once "db_config.php";
  class db_connection {

    public static $dbname = "RecipeBlog"; //Database name declear.

    public static function db_connector(){

      $db_link = db_config::getConnection(); //Call the instance of db_config class.     
      return $db_link;
    }
	public static function db_select(){
		db_config::selectDB(db_connection::$dbname); //Select the database.
	}
  }
?>
