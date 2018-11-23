<?php
class sysadmin_controller extends CI_Controller {

   public function __construct(){
      parent::__construct();
      $active_group = 'c2p';
      $this->load->library('session');
      $this->load->helper('html');
      $this->load->helper('url');
      $this->load->model('C2p_model');
      $this->load->model('Amity_model');
      $this->load->model('Group_model');
      $this->load->model('Member_model');
      $this->load->model('Contact_model');
      $this->load->model('Referral_model');
      $this->load->model('Returnee_model');
      $this->load->model('Place_model');
      $this->load->model('Sysadmin_model');
   }
   
    public function getdata(){
        $this->load->model('sysadmin_model');    
        $data = array('Email'=>'', 'FirstName'=>'', 'LastName'=>'', 
            'Password'=>'', 'Confirm'=>'', 'Reminder'=>'', 
            'C2P_Mobile'=>'', 'Account'=>'', 'Chk'=>'', 'NextPage'=>'',  
            'LoginMessage'=>'', 'EmailError'=>'', 'Style'=>'c2p',
            'MemberID'=>'', 'Message'=>'', 'Status'=>'');
        $data['Email'] = $this->session->userdata('Email');
        $data['Status'] = $this->session->userdata('Status');
        $data['FirstName'] = $this->session->userdata('FirstName');
        $data['LastName'] = $this->session->userdata('LastName');
        $data['C2P_Mobile'] = $this->session->userdata('C2P_Mobile');
        $data['Account'] = $this->session->userdata('Account');
        $data['MemberID'] = $this->session->userdata('MemberID');
        foreach($_GET as $key=>$value){$data[$key] = $value;}
        foreach($_POST as $key=>$value){$data[$key] = $value;}
        foreach($_REQUEST as $key=>$value){$data[$key] = $value;}
        return($data);
    }
   
   public function Page($page){
      $data = $this->getdata();
      $data['pagetitle'] = ucfirst($page); // Capitalize the first letter
      $data['Style'] = 'c2p';
      $data['Menu'] = 'sysadmin';
      $data['NextPage'] = 'sysadmin/'.$page;
      
       //Check Security
        if(isset($data['Status']) 
            and ( $data['Status']=='SysAdmin' 
               or $data['Status']=='Admin')){
        // Access permitted, otherwise redirect to login page    $data['NextPage'] = 'sysadmin/'.$page;
        //echo var_dump($data);
        switch(strtolower($page)):
        case 'login':        $data = $this->C2p_model->Login($data); break;
        case 'logout':       $data = $this->C2p_model->Logout($data); break;
        case 'allmembers':   $data = $this->Member_model->Allmembers($data); break;
        case 'allplaces':    $data = $this->Place_model->Allplaces($data); break;
        case 'allreturnees': $data = $this->Returnee_model->Allreturnees($data); break;
        case 'allreferrals': $data = $this->Referral_model->Allreferrals($data); break;
        case 'allchurches':  $data = $this->Amity_model->Allchurches($data); break;
        case 'memberlist':   $data = $this->Member_model->MemberList($data); break;
        case 'allgroups':    $data = $this->Group_model->Allgroups($data); break;
        case 'resetpassword':$data = $this->Member_model->resetpassword($data); break;
        case 'resetpasswordsave':$data = $this->Member_model->resetpasswordsave($data); break;
        case 'chasegatekeeper': $data = $this->Email_model->ChaseGatekeeper($data); break;  
        case 'mimicmember':  $data = $this->Member_model->MimicMember($data); break;
        case 'amityspider':  $data = $this->Amity_model->AmitySpider($data); break;
        
        case 'membertree';    
            $data = $this->Sysadmin_model->BuildMemberTree($data); 
            $data = $this->Sysadmin_model->GetMemberTree($data); 
            break;
        case 'refereetree';    
            $data = $this->Sysadmin_model->BuildRefereeTree($data); 
            $data = $this->Sysadmin_model->GetRefereeTree($data); 
            break;
        endswitch;
      // Check if $NextPage exists
  //    if(!file_exists('/application/views/'.$data['NextPage'].'.php')){
  //       show_404();
  //    }        
        $this->load->view('/c2p/header');
        //$this->load->view('/c2p/topmenu',$data);
        $this->load->view('/c2p/menubar',$data);
        $this->load->view($data['NextPage'],$data);
        $this->load->view('/c2p/footer');
    }else{
        $this->load->view('/c2p/header');
        //$this->load->view('/c2p/topmenu',$data);
        $this->load->view('/c2p/menubar',$data);
        $this->load->view('/c2p/login',$data);
        $this->load->view('/c2p/footer');
     }
   }
}