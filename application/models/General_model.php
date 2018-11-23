<?php
class General_model extends CI_Model {

    public function __construct(){
        parent::__construct();
	$this->load->database();
 //     $this->load->library('email');
 //     $data = array();
    }
   
   public function CleanInput($field,$default){
      $string = (isset($_POST[$field])?$_POST[$field]:$default);
      $string = str_replace("'","`",$string);
      $string = stripcslashes(strip_tags(trim($string)));
      $string = str_replace("$", '', $string);
      $string = str_replace(";", '', $string);
      $string = str_replace(":", '', $string);
      $string = str_replace("/", '', $string);
      return $string;
   }    

}
?>
