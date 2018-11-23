<?php
class oneway_controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $active_group = 'oneway';
        $this->load->library('session');
        $this->load->helper('html');
        $this->load->helper('url');
    }
   
    public function getdata(){
        $this->load->model('oneway_model');     
        $this->load->model('Member_model');   
        $this->load->model('Email_model');  
        $this->load->model('Location_model'); 
        $data = array('Email'=>'', 'FirstName'=>'', 'LastName'=>'', 
            'Password'=>'', 'Confirm'=>'', 'Reminder'=>'', 
            'Mobile'=>'', 'Account'=>'', 'Chk'=>'', 'NextPage'=>'',  
            'LoginMessage'=>'', 'EmailError'=>'', 'Style'=>'oneway',
            'MemberID'=>'', 'Message'=>'', 'Status'=>'');
        $data['Email'] = $this->session->userdata('Email');
        $data['Mobile'] = $this->session->userdata('Mobile');
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
        $data['Menu'] = 'oneway';
        $data['NextPage'] = 'oneway/'.$page;
        //echo var_dump($data);
        switch(strtolower($page)):
        // Login
        case 'login':           $data = $this->oneway_model->Login($data); break;
        case 'logout':          $data = $this->oneway_model->Logout($data); break;
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
        // New Referee
        case 'newreferee':      $data['PageMode'] = 'newreferee'; break;
        case 'newrefereesave':  $data = $this->Member_model->NewRefereeSave($data); break;
        // New Returnee
        case 'newreturnee':     $data = $this->Location_model->SelectLocations($data);
            $data['NextPage'] = $this->websiteRoot.'newreturnee'; break;
        case 'feedback':        break;
        case 'feedbacksave':    $data = $this->Email_model->FeedbackSave($data); break;
/*         
        case 'refconfirm':      $data['NewStatus'] = 'Member'; $data = $this->oneway_model->UpdateMemberStatus($data); break;
        case 'refconcerns':     $data['NewStatus'] = 'Concerns'; $data = $this->oneway_model->UpdateMemberStatus($data); break;
        case 'contactlist':     $data = $this->member_model->ContactList($data); break;
        case 'contactnew':      $data = $this->member_model->ContactList($data); break;
        case 'contactadd':      $data = $this->member_model->ContactAdd($data); break;
        case 'contactdel':      $data = $this->member_model->ContactDel($data); break;
        case 'registered':      $data = $this->member_model->Registered($data); break;
        case 'activate':        $data = $this->member_model->Activate($data); break;
        case 'update':          $data = $this->member_model->Update($data); break;
 */
        endswitch;
	$this->load->view('oneway/header');
     //   $this->load->view('oneway/mainmenu',$data);
     //   $this->load->view('oneway/onewaynav',$data);
        $this->load->view('oneway/topmenu',$data);
     //   $this->load->view('oneway/leftmenu',$data);
   	$this->load->view($data['NextPage'],$data);
   	$this->load->view('oneway/footer');
    }
}
