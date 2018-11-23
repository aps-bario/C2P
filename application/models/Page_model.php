<?php
class Page_model extends CI_Model {

    public function __construct(){
        parent::__construct();
	$this->load->database();
        $this->load->library('session');
    }
   
   public function LoadData(){
      $data = array();
      $data['UserStatus'] = $this->session->userdata('UserStatus');
      $data['UserEmail'] = $this->session->userdata('UserEmail');
      $data['FirstName'] = $this->session->userdata('FirstName');
      $data['Style'] = (isset($_POST['Style'])?$_POST['Style']:'cwisw');
      $data['ListOrder'] = (isset($_POST['ListOrder'])?$_POST['ListOrder']:'UserID');
      $data['PageMode'] = (isset($_POST['PageMode'])?$_POST['PageMode']:'List');
      $data['NextPage'] = (isset($_POST['NextPage'])?$_POST['NextPage']:'');
      $data['Status'] = (isset($_POST['Status'])?$_POST['Status']:'');
      $data['UserID'] = (isset($_POST['UserID'])?$_POST['UserID']:'');
      $data['UserPhone'] = '';
      $data['Account'] = '';
      $data['LoginMessage'] = '';
      $data['Reminder'] = '';
      $data['NextPage'] = '';
      return($data);
   }
   
   public function CheckAccess($data,$StatusArray){
      $Status = '';
      $return = FALSE;
      //echo var_dump($data['UserStatus']);
      if(isset($data['UserStatus'])){
         foreach($StatusArray as $Status){
            //echo var_dump($Status);
            if($data['UserStatus'] == $Status){
               $return = TRUE;
               
            }
         }
      }
      return $return;   
   }
   
}
?>