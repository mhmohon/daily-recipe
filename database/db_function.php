<?php
class database_function {
  public $query_result;
  public $db_conn;
  public function __Construct($get_conn){
    $this->db_conn = $get_conn;
  }

  //select or read any data table.
  public function read($query){
    $query_result = $this->db_conn->query($query)
      or die($this->db_conn->error." The error line number is ".__LINE__);
    $num_rows = $query_result->num_rows;
    if($num_rows > 0){
      return $query_result;
    }else {
      return false;
    }
  }

  public function insert($query){
    $query_result = $this->db_conn->query($query)
      or die($this->db_conn->error."Line is ".__LINE__);
    if($query_result){
        return $query_result;
    }else {
        return false;
    }
  }
  //Update data in any table.
  public function update($query){
    $query_result = $this->db_conn->query($query)
      or die($this->db_conn->error."Line is ".__LINE__);
    if($query_result){
        return $query_result;
    }else {
        return false;
    }
  }
  public function delete($query){
    $query_result = $this->db_conn->query($query)
      or die($this->db_conn->error."Line is ".__LINE__);
	
    if($query_result){
        return $query_result;
    }else {
        return false;
    }
  }
  
}
?>
