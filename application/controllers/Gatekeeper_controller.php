<?php
class gatekeeper_controller extends CI_Controller {
   public function __construct(){
      parent::__construct();
      $active_group = 'c2p';
      $this->load->library('session');
      $this->load->helper('html');
      $this->load->helper('url');
      $this->load->model('C2p_model');
      $this->load->model('Member_model');
      $this->load->model('Sponsor_model');
      $this->load->model('Gatekeeper_model');
      $this->load->model('Returnee_model');
      $this->load->model('Contact_model');
      $this->load->model('Group_model');
      $this->load->model('Location_model');
      $this->load->model('Place_model');
      $this->load->model('District_model');
      $this->load->model('Amity_model');
      $this->load->model('Referral_model');
   }
   
    public function getdata(){    		
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
      $data['Menu'] = 'gatekeeper';
      //Check Security
        if(isset($data['Status']) 
            and ($data['Status']=='Gatekeeper' 
               or $data['Status']=='SysAdmin' 
               or $data['Status']=='Admin')){
         // Access permitted, otherwise redirect to login page
         $data['NextPage'] = 'gatekeeper/'.$page;
         //echo var_dump($data);
         switch(strtolower($page)):
         case 'gatekeeperhome':	break;
         case 'allchurches':	
            $data = $this->Location_model->SelectLocations($data);
            $data = $this->Amity_model->AllChurches($data); 
            $data['NextPage'] = 'gatekeeper/allchurches';
            break;
//         case 'mycontacts':	
//            $data = $this->Location_model->SelectLocations($data);
//           $data = $this->Contact_model->MyContacts($data); 
//            break;
         case 'myplaces':	
            $data = $this->District_model->SelectDistricts($data);
            $data = $this->Place_model->MyPlaces($data); 
            $data['NextPage'] = 'gatekeeper/myplaces';
            break;
        case 'addplaces':	
            $data = $this->District_model->SelectDistricts($data);
            $data = $this->Place_model->MyPlaces($data); 
            $data['NextPage'] = 'gatekeeper/addplaces';
            break;
        case 'oldplaces':	
            $data = $this->District_model->SelectDistricts($data);
            $data = $this->Place_model->MyPlaces($data); 
            $data['NextPage'] = 'gatekeeper/oldplaces';
            break;
//         case 'newcontacts':	
//            $data = $this->Location_model->SelectLocations($data);
//            $data = $this->Contact_model->NewContacts($data);
//            break;
//         case 'mygroups':	
//            $data = $this->Location_model->SelectLocations($data);
//            $data = $this->Group_model->MyGroups($data); 
//            break;
         case 'myreferrals':	
            $data = $this->Location_model->SelectLocations($data);
            $data = $this->Referral_model->MyReferrals($data); 
            break;
         endswitch;
         $this->load->view('/c2p/header');
         $this->load->view('/c2p/menubar',$data);
         //$this->load->view('/c2p/topmenu',$data);
         $this->load->view($data['NextPage'],$data);
         $this->load->view('/c2p/footer');
      }else{
         $this->load->view('/c2p/header');
         $this->load->view('/c2p/menubar',$data);
         //$this->load->view('c2p/topmenu',$data);
         $this->load->view('/c2p/login',$data);
         $this->load->view('/c2p/footer');
      }
   }
}?>