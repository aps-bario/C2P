<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C2p_controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        //$active_group = 'c2p';
        if(!$this->load->is_loaded('session')){
            $this->load->library('session');
        } 
        $this->load->helper('html');
        $this->load->helper('url');
        if (!isset($this->C2p_model)){
            $this->load->model('C2p_model');   
        }
        $this->load->model('Member_model');   
        $this->load->model('Email_model');  
        $this->load->model('ReturneeForm_model');  
        $this->load->model('Location_model'); 
    }
   
    public function getdata(){
        $data = array('Email'=>'', 'FirstName'=>'', 'LastName'=>'', 
            'Password'=>'', 'Confirm'=>'', 'Reminder'=>'', 
            'C2P_Mobile'=>'', 'Account'=>'', 'Chk'=>'', 'NextPage'=>'',  
            'LoginMessage'=>'', 'EmailError'=>'', 'Style'=>'c2p',
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
    
    public function index(){
        $data = $this->getdata();
        $data['Menu'] = 'c2p';
	$this->load->view('c2p/header');
        $this->load->view('c2p/menubar',$data);
        $this->load->view('c2p/home',$data);
   	$this->load->view('c2p/footer');
    }
   
    public function Page($page){
        $data = $this->getdata();
        $data['Menu'] = 'c2p';
        if(!isset($page)){$page = 'login';}
        $data['NextPage'] = 'c2p/'.$page;
        //echo var_dump($data);
        switch(strtolower($page)):
        // Login
        case 'login':           
            $data = $this->C2p_model->Login($data); 
            break;
        case 'logout':          
            $data = $this->C2p_model->Logout($data); 
            break;
        // New Member  
        case 'newmember':       $data = $this->Member_model->NewMember($data); break;
        case 'newmembersave':   $data = $this->Member_model->NewMemberSave($data); break;
        // New Reference
        case 'newreference':      $data = $this->Member_model->NewReference($data); break;
        case 'newreferencesave':  $data = $this->Member_model->NewReferenceSave($data); break;
        // New Returnee
        case 'newreturnee':     $data = $this->Location_model->SelectLocations($data);
                                $data['NextPage'] = $this->websiteRoot.'newreturnee'; break;
        case 'feedback':        break;
        case 'feedbacksave':    $data = $this->Email_model->FeedbackSave($data); break;
        case 'returneeform':
        case 'sendreturneeform':        $data = $this->ReturneeForm_model->Send2Sponsor($data); break;
        case 'forwardreturneedata':     $data = $this->ReturneeForm_model->Send2Gatekeeper($data); break;
        // Catch partial URLs and redirect accordingly
        case 'C2P_Mobile':      $data['NextPage'] = 'c2p/mobile'; break;
        case 'faith':           $data['NextPage'] = 'c2p/faith'; break;
        case 'gdpr':           $data['NextPage'] = 'c2p/gdpr'; break;
        case 'forreturnees':    $data['NextPage'] = 'c2p/forreturnees'; break;
        case 'forsponsors':     $data['NextPage'] = 'c2p/forsponsors'; break;
        case 'termsofuse':            $data['NextPage'] = 'c2p/termsofuse'; break;
        case 'faq':            $data['NextPage'] = 'c2p/faq'; break;
        case 'codeofconduct':            $data['NextPage'] = 'c2p/codeofconduct'; break;
        case 'supplyofservice':            $data['NextPage'] = 'c2p/supplyofservice'; break;
        case 'cookiepolicy':            $data['NextPage'] = 'c2p/cookiepolicy'; break;
        
    
        case 'linc':            $data['NextPage'] = 'c2p/linc'; break;
        
        case 'c2p':             $data['NextPage'] = 'c2p/home'; break;
        default:                $data['NextPage'] = 'c2p/home'; break;
        endswitch;
        $this->load->view('c2p/header');
        //$this->load->view('c2p/topmenu',$data);
        $this->load->view('c2p/menubar',$data);
        //echo $data['NextPage'];
   	$this->load->view($data['NextPage'],$data);
   	$this->load->view('c2p/footer');
    }
}
