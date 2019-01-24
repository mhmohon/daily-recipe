<?php
  class layoutMethod{
    //Format the date.
    public function formatDate($date){
      $format = ('F j, Y, h:i a');
      $f_date = date($format,strtotime($date));
      return $f_date;
    }

    //TextShorten formet.
    public function textShorten($text, $limit = 400){
      $text = $text. " ";
      $text = substr($text, 0 , $limit); //trim the text to given limit.
      $trimmed_text = substr($text, 0 , strrpos($text, ' ')); //trim the text till find a space.
      $trimmed_text.=".....";
      return $trimmed_text;
    }
	
    public function inputValidation($string){
      $string = trim($string);
      $string = stripcslashes($string);
      $string = htmlspecialchars($string);
      return $string;
    }
  }

?>
