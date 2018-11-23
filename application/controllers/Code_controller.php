<?php
class code_controller extends CI_Controller {
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
    public function Code($code){
        $data = array();
        $data['Clickcode'] = $code;
        $data['ClicklinkCLCode'] = $code;
        $data['NextPage'] = '/china/code';
        $data = $this->getdata($data);
        echo var_dump($data);
        $data = $this->Clicklink_model->Process($data);
        $this->load->view('/china/header');
   	$this->load->view($data['NextPage'],$data);
   	$this->load->view('/china/footer');   
    }
}?>