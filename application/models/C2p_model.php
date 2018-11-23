<?php
class C2p_model extends CI_Model {
    private $websiteURL  = 'https://www.connecting2people.net/';
    private $websiteRoot = 'c2p/';
    private $websiteName = 'Connecting2People - helping to connect Christians returning home';
    private $websiteAdmin = 'Connecting2People Admin';
    private $websiteEmail = 'admin@Connecting2People.net';

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('email');
        //$data = array();
    }
   
   public function Login($data){
      $this->Logout($data);
      $data['PageMode'] = 'Login';      
      $data['Message'] = 'Please login';
      if(!  isset($data['Email']) or $data['Email'] ==''){
         $data['Message'] = 'Please enter your email address';
         return($data);
      }
      if(!isset($data['Password']) or $data['Password'] ==''){
         $data['Message'] = 'Please enter a password';
         return($data);
      }   
      $sql = "SELECT MemberID, FirstName, LastName, Mobile, Email, Status, Password, Reminder, Account, "
        ."MD5(?) AS Entered FROM members WHERE Email = ? ";
      $query = $this->db->query($sql, array($data['Password'], strtolower($data['Email'])));
      $row = $query->row_array();
      if($row){
         if($row['Entered'] == $row['Password']){
            $this->session->set_userdata('MemberID',$row['MemberID']);
            $this->session->set_userdata('FirstName',$row['FirstName']);
            $this->session->set_userdata('LastName',$row['LastName']);
            $this->session->set_userdata('Status',$row['Status']);
            $this->session->set_userdata('Account',$row['Account']);
            $this->session->set_userdata('Email',$row['Email']);
            $this->session->set_userdata('C2P_Mobile',$row['Mobile']);
            $data['MemberID'] = $row['MemberID'];
            $data['FirstName'] = $row['FirstName'];
            $data['LastName'] = $row['LastName'];
            $data['C2P_Mobile'] = $row['Mobile'];
            $data['Email'] = $row['Email'];
            $data['Account'] = $row['Account'];
            $data['Status'] = $row['Status'];
            $data['Menu'] = strtolower($row['Status']);
            if(isset($data['MemberID'])){ 
                $data['Menu']='member'; 
                if($row['Reminder'] == 'Refer to email sent you') {
                    $data['NextPage'] = "member/newpassword"; 
                } elseif($row['Status'] == 'Registered') {
                    $data['NextPage'] = "member/registered"; 
                } elseif($row['Status'] == 'Verified') {
                    $data['NextPage'] = "member/verified"; 
                } elseif($row['Status'] == 'Concerns') {
                    $data['NextPage'] = "member/concerns"; 
                } elseif($row['Status'] == 'Member') {
                    $data['NextPage'] = "member/member"; 
                } else {
                    $data['NextPage'] = strtolower($row['Status']."/".$row['Status']); 
                    $data['Menu'] = strtolower($row['Status']);
                }
                $sql = "UPDATE members "
                  ."SET LastVisited = '".date('Y-m-d H:i:s')."' " 
                  ."WHERE Email = '".strtolower($data['Email'])."'";
               $this->db->query($sql);
            }
         }else{
            $data['NextPage'] = 'c2p/login';
            $data['Message'] = 'Password Incorrect';
            $data['Reminder'] = $row["Reminder"];
         }
      }else{
         $data['NextPage'] = 'c2p/login'; 
         $data['Email'] = '';
         $data['Message'] = 'Member not registered';
      }
      return($data);
   }
   
    public function Logout($data){
        $this->session->set_userdata('MemberID',0);
        $this->session->set_userdata('FirstName','');
        $this->session->set_userdata('LastName','');
        $this->session->set_userdata('Status','');
        $this->session->set_userdata('Account','');
        $this->session->set_userdata('Email','');
        $this->session->set_userdata('C2P_Mobile','');
        unset($data['MemberID']);
        unset($data['FirstName']);
        unset($data['LastName']);
        unset($data['C2P_Mobile']);
        unset($data['Email']);  
        unset($data['Status']);
        unset($data['Account']);
        $data['NextPage'] = 'c2p/login';
        return($data);
    }
/*   
   public function Verify($data){
      $data['NextPage'] = $this->websiteRoot.'login';
      $data['MemberID'] = strval($data['Chk']) - 132;
      $data['Email'] = strtolower($data['Email']);
      $data['Message'] = "Sorry - Email verification has encountered a problem";
      if($data['MemberID']>0){
         $sql = "SELECT Account FROM members "
            ."WHERE MemberID = ? AND Email = ? ";
         $query = $this->db->query($sql, array($data['MemberID'],$data['Email']));
         $row = $query->row_array();
         if($row){         
            $sql = "UPDATE members SET Status = 'Verified' "  
               ."WHERE MemberID = ? AND Email = ? AND Status = 'Registered' ";         
            $this->db->query($sql,array($data['MemberID'],$data['Email']));  
            $data['PageMode'] = 'Login';
            $data['Message'] = "Your email address has been verified.";
            $data['NextPage'] = $this->websiteRoot.'login';
         }
      }    
      return($data);
   }
   
   public function NewMember($data){
      $data['PageMode'] = 'NewMember';
      return($data);
   }
*/   
   
   public function NewMemberSave($data){
      $data['NextPage'] = $this->websiteRoot.'newmember';
      //echo var_dump($data);
      if($data['FirstName']=='' or $data['LastName']=='' 
         or $data['Email']=='' or $data['C2P_Mobile']=='' or $data['Account']=='' 
         or $data['Password']=='' or $data['Confirm']=='' or $data['Reminder']==''){
         $data['Message'] = 'Please complete all fields to register.';  
      }elseif(strpos($data["Email"],"@") == 0 
         or strpos($data["Email"],".") == 0 
         or strlen(trim($data["Email"])) < 10){
         $data['Message'] = "Your email address does not appear to be valid";    
      }elseif(strlen(trim($data["Email"])) < 10){
         $data['Message'] = "Please enter full phone/mobile number including the STD Code";    
      }elseif($data["Password"] != $data["Confirm"]){ 
         $data['Message'] = "The passwords that you enter differ, please try again.";
      }else{
         $sql = "SELECT MemberID, Email, FirstName, LastName, Mobile, Password, Status, Reminder, Account "
            ."FROM members WHERE Email = ? ";
         $query = $this->db->query($sql, array(strtolower($data['Email'])));
         $row = $query->row_array();
         if($row){
            $data['PageMode'] = "Login";
            $data['Message'] = "Member already registered - Please Login";
            if(strtoupper($row["Password"]) == strtoupper($data['Password'])){ 
               $data['MemberID'] = $row["MemberID"];
               $data['GiveName'] = $row["FirstName"];
               $data['Status'] = $row["Status"];
            }else{
               $data['Email'] = $row["Email"];
               $data['Message'] = "Member already registered - Please Login";
            }
         }else{
            $sql = "INSERT INTO members "  
               ."(FirstName,LastName,Email,Mobile,Password,Reminder,Status,Account) "
               ."VALUES "
               ."   ('".$data['FirstName']."', "
               ."'".$data['LastName']."', "
               ."'".trim(strtolower($data['Email']))."', "
               ."'".$data['C2P_Mobile']."', "
               ."MD5('".$data['Password']."'), "
               ."'".$data['Reminder']."', "
               ."'Registered','".$data['Account']."') ";       
            $this->db->query($sql);
            $sql = "SELECT MemberID FROM members WHERE Email = ? "; 
            $query = $this->db->query($sql, array(strtolower($data['Email'])));
            $row = $query->row_array();
            if($row){
               $data['Check'] = ((string)($row["MemberID"]+132));
            }
            // Send Email
            $config['protocol'] = 'sendmail';
//            $config['protocol'] = 'smtp';
//            $config['smtp_host'] = 'auth.smtp.1and1.co.uk';
//            $config['smtp_member'] = 'smtp';
//            $config['smtp_pass'] = 'smtp';
            
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->to($data['Email']);
            $this->email->from($this->websiteEmail,$this->websiteAdmin);
            $this->email->reply_to($this->websiteEmail);
            $this->email->subject("Your registration at ".$this->websiteName); 
            $emailtext = "Dear ".$data['FirstName'].",<br/><br/>\n\n" 
               ."Thank you for registering on-line.<br/><br/>\n\n"
               ."The details you supplied were:<br/><br/>\n\n"
               ."Name:     ".$data['FirstName']." ".$data['LastName']."<br/>\n"
               ."Email:    ".$data['Email']."<br/>\n"
               ."Phone:    ".$data['C2P_Mobile']."<br/>\n"
               ."Password Reminder: ".$data['Reminder']."<br/>\n"
               ."Account Type:  ".$data['Account']."<br/><br/>\n\n"
               ."Please keep this email safe for your future record.<br/><br/>\n\n"
               ."In order to activate your registration please click on the link below and login.<br/><br/>\n\n"
               ."<b color='red'>PLEASE NOTE that will need to be connected to the "
               ."Internet for this links to work!</b><br/><br/>\n\n"
               ."<b><a href='"
               .$this->websiteURL.$this->websiteRoot."verify?Chk=".$data['Check']
               ."&Email=".trim($data['Email'])."'>[CLICK TO CONFIRM]</a> I confirm receipt of this email.</b> <br/><br/>\n\n"
               //."Once you have logged-in, please complete your GUEST/HOST profile.<br/><br/>\n\n" 
               ."If you have any difficulty with the login process please email "
               .$this->websiteEmail."<br/><br/>\n\n"
               ."New features are being added to the site all the time so please"
               ."keep checking on what has changed or been improved. "
               ."Your feedback back would be very much appreciated.<br/><br/>\n\n"
               ."Best regards,<br/><br/>\n\n" 
               .$this->websiteAdmin."<br/><br/>\n\n".$this->websiteName."\n";
            $this->email->message($emailtext);
            if($this->email->send()){;
//            echo $this->email->print_debugger();
               $data['NextPage'] = $this->websiteRoot.'newreference';
            }else{
               $data['EmailError'] = $this->email->print_debugger();
            }
         }
         //echo $data['Message'];
      }  
      return($data);
   }
/*   
   public function NewReference($data){
      $data['PageMode'] = 'NewReference';
      return($data);
   }
*/   
   public function NewReferenceSave($data){
      $data['NextPage'] = $this->websiteRoot.'newreference';
      if($data['FirstName']=='' or $data['Email']=='' or $data['Account']==''){
         $data['Message'] = 'Your are not logged in. Please login to progress further.';  
         $data['NextPage'] = $this->websiteRoot.'login';

      if(!isset($data['RefFirstName']) or $data['RefFirstName']==''
         or !isset($data['RefLastName']) or $data['RefLastName']=='' 
         or !isset($data['RefEmail']) or $data['RefEmail']=='' 
         or !isset($data['RefPhone']) or $data['RefPhone']=='' 
         or !isset($data['RefDetails']) or $data['RefDetails']==''){
         $data['Message'] = 'Please complete all fields.';  
      }elseif(strpos($data["RefEmail"],"@") == 0 
         or strpos($data["RefEmail"],".") == 0 
         or strlen(trim($data["RefEmail"])) < 10){
         $data['Message'] = "The email address does not appear to be valid";    
      }elseif(strlen(trim($data["RefPhone"])) < 10){
         $data['Message'] = "Please enter full phone/mobile number including the STD Code";    
      }else{
         $sql = "SELECT MemberID FROM members WHERE Email = ? ";
         $query = $this->db->query($sql, array(strtolower($data['Email'])));
         $row = $query->row_array();
         if($row){
            $data['MemberID'] = $row["MemberID"];
            $sql = "INSERT INTO referees ("  
               ."MemberID,FirstName,LastName,Email,Phone,Details,Status"
               .") VALUES ("
               .$data["MemberID"].","
               ."'".$data['RefFirstName']."', "
               ."'".$data['RefLastName']."', "
               ."'".trim(strtolower($data['RefEmail']))."', "
               ."'".$data['RefPhone']."', "
               ."'".$data['RefDetails']."', "
               ."'Unchecked') ";  
            $this->db->query($sql);
            $sql = "SELECT RefereeID FROM referees "
               ."WHERE MemberID = ? AND Updated = ("
               ."SELECT Max(Updated) "
               ."FROM referees WHERE MemberID = ?) "; 
            $query = $this->db->query($sql, array($data["MemberID"],$data["MemberID"]));
            $row = $query->row_array();
            if($row){
               $data['RefereeID'] = $row["RefereeID"];
               // Check is the Reference is already a member
               if(($ReferenceMemberID = $this->GetReferenceMemberID($data))>0){
                  $data['ReferenceMemberID'] = $ReferenceMemberID;
                  $this->SendReferenceEmail($data);
               } else {
                  $data['ReferenceMemberID'] = $ReferenceMemberID;
                  $this->SendAdminRefEmail($data);
                //   $this->SendReferenceEmail($data);
               }
               $data['NextPage'] = $this->websiteRoot.'emailsent';
            } else {
               $data['Message'] = "ERROR: Unable to recover Reference record";
            }
         } else {
            $data['Message'] = "ERROR: Unable to recover Member record";
         }
      } 
      //echo var_dump($data);
      return($data);
      }
   }  
/*   
   public function SendReferenceEmail($data){
      // Send Email
      $config['protocol'] = 'sendmail';
      $config['mailtype'] = 'html';
      $this->email->initialize($config);
      $this->email->clear();
      $this->email->to($data['RefEmail']);
      $this->email->bcc($this->websiteEmail,$this->websiteAdmin);
      $this->email->from($this->websiteEmail,$this->websiteAdmin);
      $this->email->reply_to($this->websiteEmail);
      $this->email->subject("Reference request from ".$this->websiteName); 
      $emailtext = "Dear ".$data['RefFirstName'].",<br/><br/>\n\n" 
         ."We have received a request from "
         .$data['FirstName']." ".$data['LastName']
         ."to use returnee referral services on our website "
         .$this->websiteName."<br/><br/>\n\n" 
         ."Your name and contact details were provided as someone who would be "
         ."willing to confirm ".$data['FirstName']."'s identity and suitability to "
         ."be allowed to make requests to other users of this service to help "
         ."refer students returning home.<br/><br/>\n\n"
         .$data['FirstName']." ".$data['LastName']
         ."has provided the following contact details for you and themselves, "
         ."together with a brief reminder, for your benefit, "
         ."of who they are or how they know you;<br/><br/>\n\n"
         ."Your Name:     ".$data['RefFirstName']." ".$data['RefLastName']."<br/>\n"
         ."Your Email:    ".$data['RefEmail']."<br/>\n"
         ."Your Phone:    ".$data['RefPhone']."<br/>\n<br/>\n"
         ."Their Name:    ".$data['FirstName']." ".$data['LastName']."<br/>\n"
         ."Their Email:   ".$data['Email']."<br/>\n"
         ."Their Phone:   ".$data['C2P_Mobile']."<br/>\n<br/>\n"
         ."Their Reminder: <br/>\n".$data['RefDetails']."<br/>\n<br/>\n"
         ."If you are happy to confirm that you know ".$data['FirstName']." and "
         ."you are confident that allowing them access to the referral system "
         ."will not compromise personal information about those in China or others "
         ."like yourself connecting returnees back home, then "
         ."please click the following link;<br/><br/>\n\n"
         ."<b color='red'>PLEASE NOTE that will not only need to be connected to the "
         ."Internet for this links to work, BUT ALSO you will need be logged-in - "
         ."so that the site can verify you have permission to update the status of "
         ."of potential members. You will need Member status for this!</b><br/><br/>\n\n "     
         ."<b><a href='".$this->websiteURL.$this->websiteRoot."refconfirm?MID=".$data['ReferenceMemberID']."'>"
         ."[ CLICK TO CONFIRM ]</a> I am happy to confirm suitability</b> <br/><br/>\n\n"
         ."If you have any concerns about the identity or suitability of this person "
         ."with regard to giving them access to the website, either reply to this email "
         ."or simply click the link below and we will get back in contact with you.<br/><br/>\n\n"
         ."<b><a href='".$this->websiteURL.$this->websiteRoot."refconcerns?MID=".$data['ReferenceMemberID']."'>"
         ."[ CLICK TO CONFIRM ]</a> I have concerns about confirming suitability</b> <br/><br/>\n\n"
         ."If you have any difficulty using the above links or this this the first time "
         ."that you have been asked to provide a reference for the website, "
         .$this->websiteName.", please reply to this email (".$this->websiteEmail.") "
         ."and someone will be in touch.<br/><br/>\n\n"
         ."Your feedback back on this process would be very much appreciated.<br/><br/>\n\n"
         ."Best regards,<br/><br/>\n\n" 
         .$this->websiteAdmin."<br/><br/>\n\n".$this->websiteName."\n";
      $this->email->message($emailtext);
      //echo $emailtext;
      if($this->email->send()){
         $data['Message'] = "Email has been Sent";
         $data['NextPage'] = $this->websiteRoot.'refemailsent';
      }else{
         $data['NextPage'] = $this->websiteRoot.'newreference';
         $data['Message'] = "ERROR: Email was not sent.";
         $data['EmailError'] = $this->email->print_debugger();
      }
      return($data);
   }
   
   private function SendAdminRefEmail($data){
      // Send Email
      $config['protocol'] = 'sendmail';
      $config['mailtype'] = 'html';
      $this->email->initialize($config);
      $this->email->clear();
      $this->email->to($this->websiteEmail,$this->websiteAdmin);
      $this->email->from($this->websiteEmail,$this->websiteAdmin);
      $this->email->reply_to($data['Email']);
      $this->email->subject("Reference request from ".$this->websiteName); 
      $emailtext = "Automated Email from the website ".$this->websiteName."<br/><br/>\n\n" 
         .$data['FirstName']." ".$data['LastName']
         ."has requested access to ".$this->websiteName." and provided the "
         ."following reference details for someone who is not yet a member.<br/><br/>\n\n" 
         .$data['FirstName']." has provided the following contact details themselves "
         ."and there reference, together brief summary of their connection and interest. "
         ."<br/><br/>\n\n"
         ."Name:     ".$data['RefFirstName']." ".$data['RefLastName']."<br/>\n"
         ."Email:    ".$data['RefEmail']."<br/>\n"
         ."Phone:    ".$data['RefPhone']."<br/>\n<br/>\n"
         ."Reference Name:    ".$data['FirstName']." ".$data['LastName']."<br/>\n"
         ."Reference Email:   ".$data['Email']."<br/>\n"
         ."Reference Phone:   ".$data['C2P_Mobile']."<br/>\n<br/>\n"
         ."Other information: <br/>\n".$data['RefDetails']."<br/>\n<br/>\n"
         ."Please contact the reference and if you are then happy to confirm that "
         .$data['FirstName']." should be allowed to access to the referral system "
         ."and it will not compromise personal information about those in China "
         ."or others like yourself connecting returnees back home, then "
         ."please click the following link;<br/><br/>\n\n"
         ."<b color='red'>PLEASE NOTE that will not only need to be connected to the "
         ."Internet for this links to work, BUT ALSO you will need be logged-in - "
         ."so that the site can verify you have permission to update the status of "
         ."of potential members. You will need Member status for this!</b><br/><br/>\n\n "     
         ."<b><a href='".$this->websiteURL.$this->websiteRoot."refconfirm?MID=".$data['ReferenceMemberID']."'>"
         ."[ CLICK TO CONFIRM ]</a> I am happy to confirm suitability</b> <br/><br/>\n\n"
         ."If you have any concerns about the identity or suitability of this person "
         ."with regard to giving them access to the website, either reply to this email "
         ."or simply click the link below and we will get back in contact with you.<br/><br/>\n\n"
         ."<b><a href='".$this->websiteURL.$this->websiteRoot."refconcerns?MID=".$data['ReferenceMemberID']."'>"
         ."[ CLICK TO CONFIRM ]</a> I have concerns about confirming suitability</b> <br/><br/>\n\n"
         ."If you have any difficulty using the above links or this this the first time "
         ."that you have been asked to provide a reference for the website, "
         .$this->websiteName.", please reply to this email (".$this->websiteEmail.") "
         ."and someone will be in touch.<br/><br/>\n\n"
         ."Your feedback back on this process would be very much appreciated.<br/><br/>\n\n"
         ."Best regards,<br/><br/>\n\n" 
         .$this->websiteAdmin."<br/><br/>\n\n".$this->websiteName."\n";
      $this->email->message($emailtext);
      //echo $emailtext;
      if($this->email->send()){
         $data['Message'] = "Email has been Sent";
         $data['NextPage'] = $this->websiteRoot.'refemailsent';
      }else{
         $data['NextPage'] = $this->websiteRoot.'newreference';
         $data['Message'] = "ERROR: Email was not sent.";
         $data['EmailError'] = $this->email->print_debugger();
      }
      return($data);
   }

   private function GetReferenceMemberID($data){
      $ReferenceMemberID = 0;
      $sql = "SELECT M.MemberID FROM members M, referees R "
         ."WHERE R.RefereeID = ? "
         ."AND UPPER(M.Lastname) = UPPER(R.Lastname) "
         ."AND (M.Email = R.Email "
         ." OR (M.Phone = R.Phone "
         ."AND (UPPER(R.Firstname) = UPPER(M.Firstname))))";
      $query = $this->db->query($sql, array($data['RefereeID']));
      $row = $query->row_array();
      if($row){
         $ReferenceMemberID = $row['MemberID'];
      } else {
         $data['Message'] = "Reference is not a member.";
      }
      return($ReferenceMemberID);
   }

   public function UpdateMemberStatus($data){
      $data['NextPage'] = $this->websiteRoot.'refconfirm';
      //echo var_dump($data);
      if(!isset($data['RID'])){
         // If following a link from a Reference email use person logged in 
         if($data['Status']=='Admin' or $data['Status']=='Member'){
            $data['RID'] = $data['MemberID'];
         } else {
             $data['NextPage'] = $this->websiteRoot.'invalidentry';
             $data['Message'] = "You need to be logged in for this link to work";
         }
      }  
      if(!isset($data['MID']) or !isset($data['RID'])){
         $data['NextPage'] = $this->websiteRoot.'invalidentry';
      } else {
         $sql = "SELECT * FROM members "
           ."WHERE MemberID = ? "
           ."AND Status <> 'Admin' ";
         $query = $this->db->query($sql, array($data['MID']));
         $row = $query->row_array();
         if($row){
            $data['MemEmail'] = $row['Email'];
            $data['MemFirstName'] = $row['FirstName'];
            $data['MemLastName'] = $row['LastName'];
         } else { 
            $data['NextPage'] = $this->websiteRoot.'invalidentry';
         }
         $sql = "SELECT * FROM members "
           ."WHERE MemberID = ? "
           ."AND (Status = 'Admin' or Status = 'Member') ";
         $query = $this->db->query($sql, array($data['RID']));
         $row = $query->row_array();
         if($row){
            $data['RefEmail'] = $row['Email'];
            $data['RefFirstName'] = $row['FirstName'];
            $data['RefLastName'] = $row['LastName'];
         } else {
            $data['NextPage'] = $this->websiteRoot.'invalidentry';
         }
      } 
      if(!($data['NextPage'] == $this->websiteRoot.'invalidentry')) {
         $sql = "UPDATE members SET Status = ? WHERE MemberID = ? ";
         $this->db->query($sql, array($data['NewStatus'],$data['MID']));
         if($data['NewStatus']=='Member'){
            $data = $this->ConfirmRefEmail($data);
         }
         if($data['NewStatus']=='Concerns'){
            $data = $this->RefConcernsEmail($data);
         }
      }
      return($data);
   }

   public function ConfirmRefEmail($data){
      // Send Email
      $config['protocol'] = 'sendmail';
      $config['mailtype'] = 'html';
      $this->email->initialize($config);
      $this->email->clear();
      $this->email->to($data['MemEmail']);
      $this->email->bcc($this->websiteEmail,$this->websiteAdmin);
      $this->email->from($this->websiteEmail,$this->websiteAdmin);
      $this->email->reply_to($this->websiteEmail);
      $this->email->subject("Member Status upgraded at ".$this->websiteName); 
      $emailtext = "Dear ".$data['MemFirstName'].",<br/><br/>\n\n" 
         ."Just a quick note to let you know that your have been granted 'Member' "
         ."status on the website ".$this->websiteName."<br/><br/>\n\n" 
         ."Your may now return to the website and request returnee referral contacts "
         ."or add your own list of places where you know Christians willing to "
         ."receive and support other Christians returning home.<br/><br/>\n\n"
         ."Please be sure to familiarise yourself with the procedures and guidelines "
         ."on the website with regard to security and protecting personal data.<br/><br/>\n\n"
         ."<b><a href='".$this->websiteURL.$this->websiteRoot."login'>"
            . "[ CLICK TO LOGIN ]</a> <- Click here to return to the site</b> <br/><br/>\n\n"     
         ."If you have any difficulty using the above links or this this the first time "
         ."that you have been asked to provide a reference for the website, "
         .$this->websiteName.", please reply to this email (".$this->websiteEmail.") "
         ."and someone will be in touch.<br/><br/>\n\n"
         ."Your feedback back on this process would be very much appreciated.<br/><br/>\n\n"
         ."Best regards,<br/><br/>\n\n" 
         .$this->websiteAdmin."<br/><br/>\n\n".$this->websiteName."\n";
      $this->email->message($emailtext);
      //echo $emailtext;   
      if($this->email->send()){
         $data['Message'] = "Email has been sent";
      }else{
         $data['Message'] = "ERROR: Email was not sent.";
         $data['EmailError'] = $this->email->print_debugger();
      }
      return($data);
   }
   
   public function RefConcernsEmail($data){
      // Send Email
      $config['protocol'] = 'sendmail';
      $config['mailtype'] = 'html';
      $this->email->initialize($config);
      $this->email->clear();
      $this->email->to($this->websiteEmail,$this->websiteAdmin);
      $this->email->from($this->websiteEmail);
      $this->email->reply_to($data['RefEmail']);
      $this->email->subject("Concerns about Reference request at ".$this->websiteName); 
      $emailtext = "<b>Automated email from ".$this->websiteName."</b><br/><br/>\n\n" 
         .$data['RefFirstName']." ".$data['RefLastName']
         ." has concerns about the reference request received from "
         .$data['MemFirstName']." ".$data['MemLastName']." (".$data['MemEmail'].")<br/><br/>\n\n" 
         ."You may wish to follow this up with the member and person requesting access.<br/><br/>\n\n" 
         .$this->websiteAdmin."<br/><br/>\n\n".$this->websiteName."\n";
      $this->email->message($emailtext);
      //echo $emailtext;
      if($this->email->send()){
         $data['Message'] = "Email has been Sent";
      }else{
         $data['Message'] = "ERROR: Email was not sent.";
         $data['EmailError'] = $this->email->print_debugger();
      }
      return($data);
   }
 */  
      
 /*
   public function Activate($data){
       return($data);
   }
   
  
   public function VerifyEmail($data){
      $this->email->initialize();
      $this->email->clear();
      $this->email->$to($data['MemberEmail']);
      $this->email->$from($this->websiteEmail,$this->websiteAdmin);
      $this->email->$reply_to($this->websiteEmail);
      $this->email->$subject("Your registration at ".$this->websiteName); 
      $emailtext = "Dear ".$data['FirstName'].",<br/><br/>\n\n" 
         ."Thank you for registering on-line.<br/><br/>\n\n"
         ."The details you supplied where;<br/><br/>\n\n"
         ."Name:     ".$data['FirstName']." ".$data['LastName']."<br/>\n"
         ."Email:    ".$data['Email']."<br/>\n"
         ."Mobile:   ".$data['C2P_Mobile']."<br/>\n"
         ."Password: ".$data['Password']."<br/>\n"
         ."Reminder: ".$data['Reminder']."<br/>\n"
         ."Account:  ".$data['Account']."<br/><br/>\n\n"
         ."Please keep this email safe for your future record.<br/><br/>\n\n"
         ."In order to verify the email address you registrated please click "
         ."on the link below and login.<br/><br/>\n\n"
         .$this->websiteRoot.$this->websiteURL."activate?Check="
         .$data['Check']."&Email=".trim($data['Email'])."<br/><br/>\n\n" 
         ."If you have any difficulty with the login process please email "
         .$this->websiteEmail."<br/><br/>\n\n"
         ."Best regards,<br/><br/>\n\n" 
         .$this->websiteAdmin."<br/><br/>\n\n".$this->websiteName."\n";
      $this->email->message($emailtext);
      $this->email->send();
      echo $this->email->print_debugger();
      return($return);
   }

    */
}
  