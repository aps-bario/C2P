<?php
class clicklink_controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->model('Clicklink_model');
            
    }
   
    public function getdata($data){
        //$data = array('Email'=>'', 'FirstName'=>'', 'LastName'=>'', 
        //    'Password'=>'', 'Confirm'=>'', 'Reminder'=>'', 
        //    'C2P_Mobile'=>'', 'Account'=>'', 'Chk'=>'', 'NextPage'=>'',  
        //    'LoginMessage'=>'', 'EmailError'=>'', 'Style'=>'c2p',
        //    'MemberID'=>'', 'Message'=>'', 'Status'=>'');
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
    public function ClickLink($code){
        $data = $this->Clicklink_model->Process($code);
        $data = $this->getdata($data);
        $data['Menu'] = 'c2p';
        $data['NextPage'] = '';
        $this->load->view('/china/header');
        //$this->load->view('/c2p/menubar',$data);
        //$this->load->view('c2p/topmenu',$data);
   	$this->load->view('/china/clicklink',$data);
   	$this->load->view('/china/footer');   
    }
}?>