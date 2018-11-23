<?php
class Watchman_controller extends CI_Controller {
      public function __construct(){
      parent::__construct();
      $active_group = 'watchman';
      $this->load->library('session');
      $this->load->helper('html');
      $this->load->helper('url');
      $this->load->model('C2p_model');
      $this->load->model('Member_model');
      $this->load->model('Sponsor_model');
      $this->load->model('Gatekeeper_model');
      $this->load->model('Returnee_model');
      $this->load->model('Contact_model');
      $this->load->model('Location_model');
      $this->load->model('Referral_model');
  //    $this->load->model('District_model');
      $this->load->model('Clicklink_model');
   }
   public function getdata(){
		$this->load->model('sponsor_model');    
      $data = array('Email'=>'', 'FirstName'=>'', 'LastName'=>'', 
         'Password'=>'', 'Confirm'=>'', 'Reminder'=>'', 
         'C2P_Mobile'=>'', 'Account'=>'', 'Chk'=>'', 'NextPage'=>'',  
         'LoginMessage'=>'', 'EmailError'=>'', 'style'=>'c2p',
         'MemberID'=>'', 'Message'=>'', 'Status'=>'');
      $data['Email'] = $this->session->userdata('Email');
      $data['Status'] = $this->session->userdata('Status');
      $data['FirstName'] = $this->session->userdata('FirstName');
      $data['LastName'] = $this->session->userdata('LastName');
      $data['Account'] = $this->session->userdata('Account');
      $data['MemberID'] = $this->session->userdata('MemberID');
      foreach($_GET as $key=>$value){$data[$key] = $value;}
      foreach($_POST as $key=>$value){$data[$key] = $value;}
      foreach($_REQUEST as $key=>$value){$data[$key] = $value;}
      return($data);
   }
   
   public function Page($page){
      $data = $this->getdata();
      $data['Menu'] = 'watchman';
      $data['NextPage'] = 'watchman/'.$page;
        
      //Check Security
       if(isset($data['Status']) 
            and ($data['Status']=='Member' // Only to allow initial New Returnee 
               or $data['Status']=='Gatekeeper' 
               or $data['Status']=='SysAdmin' 
               or $data['Status']=='Admin')){
         // Access permitted, otherwise redirect to login page   $data['NextPage'] = 'sponsor/'.$page;
         //echo var_dump($data);   
         switch(strtolower($page)):
         // Returnee
         case 'newreturnee': $data = $this->Returnee_model->NewReturnee($data); break;
         case 'newreturneesave': $data = $this->Returnee_model->NewReturneeSave($data); break;
         case 'myreturnees': $data = $this->Returnee_model->MyReturnees($data); break;
  //       case 'returneelist':    
  //          $data = $this->Returnee_model->ReturneeList($data); 
  //          break;
  //       case 'newreturnee':     
  //          $data = $this->Location_model->SelectLocations($data);
  //          $data = $this->Returnee_model->ReturneeNew($data); 
  //          break;
  //       case 'returneeadd':     
  //          $data = $this->Returnee_model->ReturneeAdd($data); 
  //          break;
         case 'returneedel':     
            $data = $this->Returnee_model->ReturneeDel($data); 
            break;
         endswitch;
         $this->load->view('/c2p/header');
         $this->load->view('/c2p/topmenu',$data);
         $this->load->view($data['NextPage'],$data);
         $this->load->view('/c2p/footer');
      }else{
         $this->load->view('/c2p/header');
        $this->load->view('/c2p/topmenu',$data);
         $this->load->view('/c2p/login',$data);
         $this->load->view('/c2p/footer');
      }
   }
}?>