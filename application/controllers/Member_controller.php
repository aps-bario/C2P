<?php
class Member_controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $active_group = 'c2p';
        $this->load->library('session');
        //$this->load->helper('html');
        //$this->load->helper('url');
      	//$this->load->model('C2p_model');
	$this->load->model('Member_model');
	//$this->load->model('Sponsor_model');
	//$this->load->model('Gatekeeper_model');
	//$this->load->model('Returnee_model');
	//$this->load->model('Contact_model');
	$this->load->model('Location_model');
	//$this->load->model('Reference_model');
        //$this->load->model('Referral_model');
        //$this->load->model('Email_model');
        //$this->load->model('Clicklink_model');
    }
 
    public function getdata(){
        $this->load->model('Member_model');    
        $data = array('Email'=>'', 'FirstName'=>'', 'LastName'=>'', 
            'Password'=>'', 'Confirm'=>'', 'Reminder'=>'', 
            'C2P_Mobile'=>'', 'Account'=>'', 'Chk'=>'', 'NextPage'=>'',  
            'LoginMessage'=>'', 'EmailError'=>'', 'style'=>'c2p',
            'MemberID'=>'', 'Message'=>'', 'Status'=>'');
        $data['Email'] = $this->session->userdata('Email');
        $data['C2P_Mobile'] = $this->session->userdata('C2P_Mobile');
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
        $data['Menu'] = 'member';
        //Check Security
        if(isset($data['Status']) 
            and ($data['Status']=='Registered' // Only to allow initial New Reference
               or $data['Status']=='Verified'  // Only to allow initial New Reference
               or $data['Status']=='Member' 
               or $data['Status']=='Sponsor' 
               or $data['Status']=='Gatekeeper' 
               or $data['Status']=='SysAdmin' 
               or $data['Status']=='Admin')){
           // Access permitted, otherwise redirect to login page
        
           $data['NextPage'] = 'member/'.$page;
           //echo var_dump($data);       
           switch(strtolower($page)):
           // New Member
           case 'newmember':       $data = $this->Member_model->NewMember($data); break;
           case 'newmembersave':   $data = $this->Member_model->NewMemberSave($data); break;
           case 'editmember':      $data = $this->Member_model->EditMember($data); break;
           case 'editmembersave':  $data = $this->Member_model->EditMemberSave($data); break;
           case 'forgetmember':    $data = $this->Member_model->ForgetMember($data); break;
           case 'newpasswordsave': $data = $this->Member_model->NewPasswordSave($data); break;
           // New Reference
           case 'newreference':     $data = $this->Member_model->NewReference($data); break;
           case 'newreferencesave': $data = $this->Member_model->NewReferenceSave($data); break;
           // New Returnee
           //case 'newreturnee':    $data = $this->Location_model->SelectLocations($data);
           //     $data['NextPage'] = $this->websiteRoot.'newreturnee'; break;
           // New Returnee
           case 'newreturnee':     
           case 'returneenew':     
               $data = $this->Location_model->SelectLocations($data);
               //$data = $this->Member_model->ReturneeNew($data); 
               $data['NextPage'] = $this->websiteRoot.'returneenew'; break;
           case 'returneelist':    $data = $this->Member_model->ReturneeList($data); break;
           case 'returneeadd':     $data = $this->Member_model->ReturneeAdd($data); break;
           case 'returneedel':     $data = $this->Member_model->ReturneeDel($data); break;
           endswitch;
           $this->load->view('/c2p/header');
           $this->load->view('/c2p/menubar',$data);
         //$this->load->view('/c2p/topmenu',$data);
           $this->load->view($data['NextPage'],$data);
           $this->load->view('/c2p/footer');
       }else{
          $this->load->view('/c2p/header');
          $this->load->view('/c2p/menubar',$data);
         //$this->load->view('/c2p/topmenu',$data);
          $this->load->view('/c2p/login',$data);
          $this->load->view('/c2p/footer');
       }
    }
}