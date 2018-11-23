<?php
class Clicklink_model extends CI_Model {
    private $websiteURL  = 'https://www.connecting2people.net/';
    private $websiteRoot = 'c2p/';
    private $websiteName = 'Connecting2People - helping to connect Christians returning home';
    private $websiteAdmin = 'Connecting2People Admin';
    private $websiteEmail = 'admin@connecting2people.net';
    public function __construct(){
        parent::__construct();
        $this->load->database();
        //$this->load->library('session');
        //$this->load->model('Referral_model');
        $this->load->model('Returneeform_model');
    }   
    public function Create($data){
        // Check required variables have been declared and initiate if necessary
        $data['ClickLinkEmail'] = (isset($data['ClickLinkEmail'])?$data['ClickLinkEmail']:'');
        $data['ClickLinkModel'] = (isset($data['ClickLinkModel'])?$data['ClickLinkModel']:'');
        $data['ClickLinkModelID'] = (isset($data['ClickLinkModelID'])?$data['ClickLinkModelID']:'');
        $data['ClickLinkModelFn'] = (isset($data['ClickLinkModelFn'])?$data['ClickLinkModelFn']:'');
        $data['ClickLinkCLValue'] = (isset($data['ClickLinkCLValue'])?$data['ClickLinkCLValue']:'');
        $data['ClickLinkCLSQL'] = (isset($data['ClickLinkCLSQL'])?str_replace('\'','$',$data['ClickLinkCLSQL']):'');
        $data['ClicklinkCLCode'] = MD5($data['ClickLinkEmail'].$data['ClickLinkModel']
            .$data['ClickLinkModelID'].$data['ClickLinkModelFn'].$data['ClickLinkCLValue'].time());        
        // Create a clicklink code and store for furure execution 
        $sql = "INSERT INTO clicklinks (Email, Model, ModelID, ModelFn, CLValue, CLSQL, CLCode) "
            ."VALUES ('".$data['ClickLinkEmail']."', "
            ."'".$data['ClickLinkModel']."', ".$data['ClickLinkModelID'].", "
            ."'".$data['ClickLinkModelFn']."', '".$data['ClickLinkCLValue']."', " 
            ."'".$data['ClickLinkCLSQL']."', '".$data['ClicklinkCLCode']."') ";
        $this->db->query($sql);
        $sql = "SELECT * FROM clicklinks WHERE CLCode = ? ";
        $query = $this->db->query($sql, array($data['ClicklinkCLCode']));
        $row = $query->row_array();
        if($row){
            if($row['CLCode'] = $data['ClicklinkCLCode']){
                $data['ClickLinkCheck'] = True;
            } else {
                $data['ClickLinkCheck'] = 'Error: '.$data['ClicklinkCLCode'];
            }
        } else {
            $data['ClicklinkCLCode'] = 'XXXXXXXXXXXX';
            $data['ClickLinkCreated'] = False;
        }          
        return($data);
    }
    public function Process($data){
        // Process a clinklick code executed from an email message
        //$data['Message'] = $data['ClickLinkCheck'];
        $sql = "SELECT * FROM clicklinks WHERE CLCode = ? ";
        $query = $this->db->query($sql, array($data['ClicklinkCLCode']));
        $row = $query->row_array();
        if($row){
            // Execute SQL element of the ClickLink record
            $sql = str_replace('$','\'',$row['CLSQL']);
            $this->db->query($sql);
            // Record that this Clicklink has been executed
            $sql = "UPDATE clicklinks SET Executed = NOW() WHERE CLCode = ? ";
            $this->db->query($sql, array($data['ClicklinkCLCode']));
            /***********
            * Some Clicklinks can trigger additional actions based purely on their type
            ************/
            if($row['CLValue']=='Declined' OR $row['CLValue']=='New Referral'){
                // If Gatekeeper Declines or Sponsor requests New Referral - What about Contact Fails?
                // Check if another referral is possible
                $data['ReturneeID'] = $row['ModelID'];
            //    $data = $this->Referral_model->ReferralCheck($data);
            }
            if($row['CLValue']=='Accepted'){
            
            }
            // Prepare a Message response to Screen
            $data['Message'] = $row['ModelFn']." ".$row['Model']." "
               .$row['ModelID']." ".$row['CLValue']." - Successful.";

            if($row['CLValue']=='Returnee Form' OR $row['ModelFn']=='ReturneeData'){
                // Forward Returnee Data from Sponsor directly to Gatekeeper for this referral
                $data['ReferralID'] = $row['ModelID'];
                // Check if form data has been passed as is complete else display the form
                $data['Message'] .= ' Referral:'.$data['ReferralID']
                        .' ChineseName:'.(isset($data['ChineseName'])?$data['ChineseName']:'')
                        .' WeChatID:'.(isset($data['WeChatID'])?$data['WeChatID']:'');
                if(isset($data['ReferralID']) AND $data['ReferralID'] !='' 
                        AND isset($data['ChineseName']) AND $data['ChineseName']!=''
                        AND isset($data['WeChatID']) AND $data['WeChatID']!=''){
                    $data = $this->Returneeform_model->Send2Gatekeeper($data);
                } else {
                   $data['Message'] = 'Data incomplete or on-line form option selected.';
                   $data = $this->Returneeform_model->ReturneeForm($data);
                   $data['NextPage'] = 'china/returneeform';
                }           
            }
                        
        }
        return($data);  
    }
    public function Test($data){
        $data['ClickLinkEmail'] = 'admin@connecting2people.net';
        $data['ClickLinkModel'] = 'member';
        $data['ClickLinkModelID'] = 92;
        $data['ClickLinkModelFn'] = 'Update';
        $data['ClickLinkCLValue'] = 'Verified';
        $data['ClickLinkCLSQL'] = "UPDATE members SET Status = 'Verified' WHERE MemberID = 92 ";
        $data = $this->Create($data);
        return($data);
    }  
 }
