<?php
class oneway_controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
      $active_group = 'hospitality';
      $this->load->library('session');
      $this->load->helper('html');
      $this->load->helper('url');
	}
   
   public function logindata(){
		$this->load->model('oneway_model');
      $data = array();
      $data['UserStatus'] = $this->session->userdata('UserStatus');
      $data['UserEmail'] = $this->session->userdata('UserEmail');
      $data['UserEmail'] = (isset($_REQUEST['UserEmail'])?$_REQUEST['UserEmail']:$data['UserEmail']);
      $data['FirstName'] = $this->session->userdata('FirstName');
      $data['FirstName'] = (isset($_REQUEST['FirstName'])?$_REQUEST['FirstName']:$data['FirstName']);
      $data['LastName'] = (isset($_REQUEST['LastName'])?$_REQUEST['LastName']:'');
      $data['Password'] = (isset($_REQUEST['Password'])?$_REQUEST['Password']:'');
      $data['Confirm'] = (isset($_REQUEST['Confirm'])?$_REQUEST['Confirm']:'');
      $data['UserPhone'] = (isset($_REQUEST['UserPhone'])?$_REQUEST['UserPhone']:'');
      $data['Account'] = (isset($_REQUEST['Account'])?$_REQUEST['Account']:'');
      $data['Reminder'] = (isset($_REQUEST['Reminder'])?$_REQUEST['Reminder']:'');
      $data['ActivationCode'] = (isset($_REQUEST['AC'])?$_REQUEST['AC']:'');
      $data['NextPage'] = (isset($_REQUEST['NextPage'])?$_REQUEST['NextPage']:'');
      $data['Style'] = (isset($_REQUEST['Style'])?$_REQUEST['Style']:'cwisw');
      $data['LoginMessage'] = '';
      $data['EmailError'] = '';
      return($data);
   }
   
   public function Login($page){
      $data = $this->logindata();
      $data['NextPage'] = 'oneway/'.$page;
//echo var_dump($data);
         switch(strtolower($page)):
         case 'logout':
            $data = $this->oneway_model->Logout($data);
            break;
         case 'login':
            $data = $this->oneway_model->Login($data);
            break;
         case 'newuser':
            $data = $this->oneway_model->NewUser($data);
            break;
         case 'register':
            $data = $this->oneway_model->Register($data);
            break;
         case 'verify':
            $data = $this->oneway_model->Verify($data);
            break;
          case 'activate':
            $data = $this->oneway_model->Activate($data);
            break;
          case 'update':
            $data = $this->oneway_model->Update($data);
            break;
      endswitch;
   	$this->load->view('oneway/header');
      $this->load->view('oneway/topmenu',$data);
      $this->load->view('oneway/leftmenu',$data);
   	$this->load->view($data['NextPage'],$data);
   	$this->load->view('oneway/footer');
   }
    
   public function Page($Page){
      $data = $this->logindata();
   	$this->load->view('oneway/header');
      $this->load->view('oneway/topmenu',$data);
      $this->load->view('oneway/leftmenu',$data);
   	$this->load->view("oneway/$Page",$data);
   	$this->load->view('oneway/footer');
   }
   
}?>
