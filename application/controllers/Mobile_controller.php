<?php
class Mobile_controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $active_group = 'C2P_Mobile';
        $this->load->library('session');
        $this->load->helper('html');
        $this->load->helper('url');
        date_default_timezone_set('Europe/London');
    }
   
    public function getdata(){
        $this->load->model('C2p_model');     
        $this->load->model('Member_model');   
        $this->load->model('Email_model');  
        $this->load->model('Location_model'); 
        $this->load->model('District_model'); 
        $this->load->model('Returnee_model'); 
        $this->load->model('Place_model'); 
        
        $data = array('Email'=>null, 'FirstName'=>null, 'LastName'=>null, 
            'Password'=>null, 'Confirm'=>null, 'Reminder'=>null, 
            'C2P_Mobile'=>null, 'Account'=>null, 'Chk'=>null, 'NextPage'=>null,  
            'LoginMessage'=>null, 'EmailError'=>null, 'Style'=>'C2P_Mobile',
            'MemberID'=>null, 'Message'=>null, 'Status'=>null);
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
    
    private function mobilepage($data){
        // Mobile enabled pages are in a different directory 
        // and preceeded with 'm_' to prevent them being overwritten. 
        $data['NextPage'] = "mobile/m_".substr($data['NextPage'], strpos($data['NextPage'],'/',1)+1);
        return($data);
    }
   
    public function Page($page){
        $data = $this->getdata();
        $data['Menu'] = 'C2P_Mobile';
        //$data['Message'] = $page;
        // Set default value incase no permission for NextPage 
        $data['NextPage'] = 'mobile/'.$page;
//        if(substr($page,0,2) === 'm_'){ 
//            $data['NextPage'] = 'mobile/'.substr($page,2);
//        }else {
//            $data['NextPage'] = 'mobile/'.$page;
//          }
//        if(isset($data['Status'])){
//            if ($data['Status']=='Registered' // Only to allow initial New Reference
//               or $data['Status']=='Verified'  // Only to allow initial New Reference
//               or $data['Status']=='Member' 
//               or $data['Status']=='Sponsor' 
//               or $data['Status']=='Gatekeeper' 
//               or $data['Status']=='SysAdmin' 
//               or $data['Status']=='Admin'){

            //echo var_dump($data);
            switch(strtolower($page)):
            // Login
            case 'login':           $data = $this->C2p_model->Login($data); break;   
            case 'logout':          $data = $this->C2p_model->Logout($data); break;
            // New Member  
            case 'newmember':       $data = $this->Member_model->NewMember($data); break;
            case 'newmembersave':   $data = $this->Member_model->NewMemberSave($data); break;
            // New Reference
            case 'newreference': 
                $data = $this->Member_model->MemberAccess($data,'Verified');
                if($data['AccessGranted']){
                    $data = $this->Member_model->NewReference($data);
                } break;
            case 'newreferencesave':  
                $data = $this->Member_model->MemberAccess($data,'Verified');
                if($data['AccessGranted']){
                    $data = $this->Member_model->NewReferenceSave($data);  
                } break;
 //           // New Returnee
 //           case 'newreturnee':     
 //               if($this->Member_model->MemberAccess($data,'Member')){
 //                   $data = $this->District_model->SelectDistricts($data);
 //               } break;
                //$data = $this->Location_model->SelectLocations($data); break;
            // Feedback
            case 'feedback':        break;
            case 'feedbacksave':    $data = $this->Email_model->FeedbackSave($data); break;
            // Edit Member
            case 'editmember':      
                $data = $this->Member_model->MemberAccess($data,'Verified');
                if($data['AccessGranted']){
                    $data['PageMode'] = 'EditMember'; 
                } break;
            case 'editmembersave':  
                $data = $this->Member_model->MemberAccess($data,'Verified');
                if($data['AccessGranted']){
                    $data = $this->Member_model->EditMemberSave($data); 
                } break;
            // New Password
            //case 'newpassword':     $data = $this->Member_model->NewPassword($data); break;
            case 'newpasswordsave': 
                $data = $this->Member_model->MemberAccess($data,'Verified');
                if($data['AccessGranted']){
                    $data = $this->Member_model->NewPasswordSave($data); 
                } break;
            // New Returnee
            case 'newreturnee':     
                $data = $this->Member_model->MemberAccess($data,'Member');
                if($data['AccessGranted']){
                    $data = $this->Returnee_model->NewReturnee($data); 
                } break;
            case 'newreturneesave': 
                $data = $this->Member_model->MemberAccess($data,'Member');
                if($data['AccessGranted']){
                    $data = $this->Returnee_model->NewReturneeSave($data);
                    // This is now set in the above function. 
                    //$data = $this->Returnee_model->MyReturnees($data);
                } break;
            case 'myreturnees': 
                $data = $this->Member_model->MemberAccess($data,'Member');
                if($data['AccessGranted']){
                    $data = $this->Returnee_model->MyReturnees($data);  
                } break;
            // MyPlaces
            case 'ajaxplaces': 
                $data = $this->Member_model->MemberAccess($data,'Gatekeeper');
                if($data['AccessGranted']){
                    //$data = $this->Place_model->MyPlaces($data);
                    $data['NextPage'] = "mobile/ajaxplaces";
                } break;
            case 'myplaces':         
                $data = $this->Member_model->MemberAccess($data,'Gatekeeper');
                if($data['AccessGranted']){
                    $data = $this->Place_model->MyPlaces($data); 
                } break;
            case 'myplacessave':         
                $data = $this->Member_model->MemberAccess($data,'Gatekeeper');
                if($data['AccessGranted']){
                    $data = $this->Place_model->MyPlacesSave($data); 
                } break;

            default:
                $data['NextPage'] = 'mobile/'.$page;
        endswitch;
//        }
//        $data['NextPage'] = 'mobile/'.$page;
        $data['NextPage'] = "mobile/m_".substr($data['NextPage'], strpos($data['NextPage'],'/',2)+1);
        echo $data['NextPage'];
  	$this->load->view('mobile/m_header',$data);
        $this->load->view('mobile/m_menu',$data);
        $this->load->view($data['NextPage'],$data);
   	$this->load->view('mobile/m_footer',$data);
    }
}
        