<?php
class Reports_controller extends CI_Controller {
      public function __construct(){
      parent::__construct();
      $active_group = 'reports';
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
      $this->load->model('Report_model');    
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
      $data['Menu'] = 'reports';
      $data['NextPage'] = 'reports/'.$page;
        
      //Check Security
       if(isset($data['Status']) 
            and ($data['Status']=='Member' // Only to allow initial New Returnee 
               or $data['Status']=='Sponsor' 
               or $data['Status']=='Gatekeeper' 
               or $data['Status']=='SysAdmin' 
               or $data['Status']=='Admin')){
         // Access permitted, otherwise redirect to login page   $data['NextPage'] = 'sponsor/'.$page;
         //echo var_dump($data);   
         switch(strtolower($page)):
         // Returnee
         case 'progbylocs': $data = $this->Report_model->ProgressByLocation($data); break;
         case 'progbyspon': $data = $this->Report_model->ProgressBySponsor($data); break;
         case 'progbygate': $data = $this->Report_model->ProgressByGateKeeper($data); break;
         
         endswitch;
         //echo var_dump($data);
           $this->load->view('/c2p/header');
           $this->load->view('/c2p/menubar',$data);
           $this->load->view($data['NextPage'],$data);
           $this->load->view('/c2p/footer');
       }else{
          $this->load->view('/c2p/header');
          $this->load->view('/c2p/menubar',$data);
          $this->load->view('/c2p/login',$data);
          $this->load->view('/c2p/footer');
      }
   }
}?>