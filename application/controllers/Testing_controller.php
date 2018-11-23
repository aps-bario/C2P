<?php
class testing_controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }
    
    public function ClickLink($code){
        $this->load->model('Clicklink_model');
        $data = $this->Clicklink_model->Process($code);
        $this->load->view('c2p/clicklink',$data);
    }
    
    public function Page($page){
    //    $data = $this->getdata();
    //    $data['Menu'] = 'c2p';
    //    $data['NextPage'] = 'c2p/'.$page;
        //echo var_dump($data);
   /*     
        switch(strtolower($page)):
        // Login
        case 'login':           $data = $this->C2p_model->Login($data); break;
        case 'logout':          $data = $this->C2p_model->Logout($data); break;
        // New Member  
        case 'newmember':       
        //    $data['PageMode'] = 'newmember'; 
        //    $data['Status'] = 'Registered';
        //    $this->session->set_userdata('FirstName',$data['FirstName']);
        //    $this->session->set_userdata('LastName',$data['LastName']);
        //    $this->session->set_userdata('Status',$data['Status']);
            $data = $this->Member_model->NewMember($data);
            break;
        case 'newmembersave':   $data = $this->Member_model->NewMemberSave($data); break;
        // New Reference
        case 'newreference':      $data['PageMode'] = 'newreference'; break;
        case 'newreferencesave':  $data = $this->Member_model->NewReferenceSave($data); break;
        // New Returnee
        case 'newreturnee':     $data = $this->Location_model->SelectLocations($data);
            $data['NextPage'] = $this->websiteRoot.'newreturnee'; break;
        case 'feedback':        break;
        case 'feedbacksave':    $data = $this->Email_model->FeedbackSave($data); break;

        endswitch;  */
   	//$this->load->view('c2p/header');
//        $this->load->view('c2p/mainmenu',$data);
//        $this->load->view('c2p/c2pnav',$data);
     //   $this->load->view('c2p/topmenu',$data);
     //   $this->load->view('c2p/leftmenu',$data);
   	$this->load->view('testing/'.$page);
   	//$this->load->view('c2p/footer');
    }

    
}?>