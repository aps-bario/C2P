<?php
class Member_model extends CI_Model {
    private $websiteURL  = 'https://www.connecting2people.net/';
    private $websiteRoot = 'c2p/';
    private $websiteName = 'A network of people helping Christians returning home';
    private $websiteAdmin = 'C2P Admin';
    private $websiteEmail = 'aps@lifespeak.co.uk';

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Email_model');
    }
    
    // Is this really needed?
    public function NewMember($data){
      $data['NextPage'] = 'member/newmember';
      $data['PageMode'] = 'NewMember';
      return($data);
    }
    public function EditMember($data){
      $data['NextMode'] = 'member/editmember';
      $data['PageMode'] = 'EditMember';
      $data['Message'] = 'Please complete all fields.';
      return($data);
    }
    public function MemberAccess($data,$AccessLevel){
        // Check if the current Member Status is as high as the AccessLevel required for Access
        $MemberLevels = array(0=>"not logged in",1=>"Registered",2=>"Verified",3=>"Pending",4=>"Concerns",
            5=>"Member",6=>"Sponsor",7=>"Gatekeeper",8=>"CityWatch",9=>"SysAdmin");
        //echo var_dump($MemberLevels);
        $Status = (isset($data['Status']) and !$data['Status'] =='')?$data['Status']:"not logged in";
        $UserLevel = array_search($Status,$MemberLevels,true);
        $UserLevel = $UserLevel==null?0:$UserLevel;
        $ReqdLevel = array_search($AccessLevel,$MemberLevels,true);
        $data['AccessGranted'] = $UserLevel>=$ReqdLevel;
        if(!$data['AccessGranted']){    
            $data['NextPage'] = "c2p/login";
            $data['Message'] = $AccessLevel.' access level required! You have '.$Status;
            //$data['Message'] .= " [$UserLevel/$ReqdLevel]";
            $data['Message'] .= ' - Access '.($UserLevel>=$ReqdLevel?'Granted':'Blocked');
            //echo $data['Message'];
        }
        return($data);
    }
    

   public function NewMemberSave($data){
        $data['NextPage'] = 'member/newmember';
        if($data['FirstName']=='' or $data['LastName']=='' 
            or $data['Email']=='' or $data['C2P_Mobile']=='' or $data['Account']=='' 
            or $data['Password']=='' or $data['Confirm']=='' or $data['Reminder']==''){
            $data['Message'] = 'Please complete all fields to register.';  
        }elseif(strpos($data["Email"],"@") == 0 
            or strpos($data["Email"],".") == 0 
            or strlen(trim($data["Email"])) < 8){
            $data['Message'] = "Your email address does not appear to be valid";    
        }elseif(strlen(trim($data["C2P_Mobile"])) < 8){
            $data['Message'] = "Please enter a full international mobile(cell)/phone number";    
        }elseif($data["Password"] != $data["Confirm"]){ 
            $data['Message'] = "The passwords that you enter differ, please try again.";
        }else{
            $sql = "SELECT MemberID, Email, FirstName, Password, Status, Reminder, Account "
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
            } else {
                $sql = "INSERT INTO members "  
                    ."(FirstName,LastName,Email,Mobile,Password,Reminder,Status,Account) "
                    ."VALUES "
                    ."   ('".$data['FirstName']."','".$data['LastName']."', "
                    ."'".trim(strtolower($data['Email']))."','".$data['C2P_Mobile']."', "
                    ."MD5('".$data['Password']."'),'".str_replace("'", "''", $data['Reminder'])."', "
                    ."'Registered','".$data['Account']."') ";       
                $this->db->query($sql);
                $sql = "SELECT MemberID, Status FROM members WHERE Email = ? "; 
                $query = $this->db->query($sql, array(strtolower($data['Email'])));
                $row = $query->row_array();
                if($row){
                    // Prepare Email to new member
                    $data['MemberID'] = $row['MemberID'];
                    $data['Status'] = $row['Status'];
                    $data = $this->Email_model->NewMember($data);
                    $data['NextPage'] = 'c2p/emailsent';  
                }
            }
        }  
        return($data);  
    }  
    
    public function EditMemberSave($data){
        $data['NextPage'] = 'member/editmember';
        if($data['FirstName']=='' or $data['LastName']=='' 
            or $data['Email']=='' or $data['C2P_Mobile']==''){
            $data['Message'] = 'Please complete all fields to register.';  
        }elseif(strpos($data["Email"],"@") == 0 
            or strpos($data["Email"],".") == 0 
            or strlen(trim($data["Email"])) < 10){
            $data['Message'] = "Your email address does not appear to be valid";    
        }elseif(strlen(trim($data["Email"])) < 10){
            $data['Message'] = "Please enter a full international mobile(cell)/phone number";    
        }elseif($data["Password"] != $data["Confirm"]){ 
            $data['Message'] = "The passwords that you enter differ, please try again.";
        }else{
            $sql = "SELECT email FROM members "
                ."WHERE MemberID = ? AND Password = MD5(?) ";
            $query = $this->db->query($sql, array($data['MemberID'], $data['OldPassword']));
            $row = $query->row_array();
            if($row){
                if ($row['email'] <> strtolower($data['Email'])){
                    // If email address has been changed then it needs to be checked
                    // 1. Revoke system access, set status to 'Registered'.
                    $sql = "UPDATE members SET FirstName = ?, LastName = ?, "
                        ."Email = ?, Mobile = ?, Status = 'Registered' "
                        ."WHERE MemberID = ? ";
                    $this->db->query($sql, array(
                        $data['FirstName'], 
                        $data['LastName'], 
                        strtolower($data['Email']), 
                        $data['C2P_Mobile'], 
                        $data['MemberID']));
                    $data['Message'] = "Your details have been updated.";
                    $data['NextPage'] = 'member/editmember';  
                    // 2. Send an email address confirmation request
                    
                    $sql = "SELECT MemberID, Status FROM members WHERE Email = ? "; 
                    $query = $this->db->query($sql, array(strtolower($data['Email'])));
                    $row = $query->row_array();
                    if($row){
                        // Prepare Email to new member
                        $data['MemberID'] = $row['MemberID'];
                        $data['Status'] = $row['Status'];
                        $data = $this->Email_model->NewMember($data);
                        $data['NextPage'] = 'c2p/emailsent';  
                    }
                    // NOTE 
                    // The user will also have to request a new reference to confirm 
                    // their details, because the email address is different. 
                    // But, this is perhaps not a bad thing.
                } else {
                    $sql = "UPDATE members SET FirstName = ?, LastName = ?, "
                        ."Email = ?, Mobile = ? WHERE MemberID = ? ";
                    $this->db->query($sql, array(
                        $data['FirstName'], 
                        $data['LastName'], 
                        strtolower($data['Email']), 
                        $data['C2P_Mobile'], 
                        $data['MemberID']));
                    $data['Message'] = "Your details have been updated.";
                    $data['NextPage'] = 'member/editmember';  
                }                  
            } else {
                $data['Message'] = "Unable to match old password with Member ID.";
            }
        }  
        return($data);
    }  
    
    public function ForgetMember($data){
        $data['NextPage'] = 'member/editmember';
        
        if($data['FirstName']=='' or $data['LastName']=='' 
            or $data['Email']=='' or $data['C2P_Mobile']==''){
            $data['Message'] = 'Please complete all fields to register.';  
        }elseif(strpos($data["Email"],"@") == 0 
            or strpos($data["Email"],".") == 0 
            or strlen(trim($data["Email"])) < 10){
            $data['Message'] = "Your email address does not appear to be valid";    
        }elseif(strlen(trim($data["Email"])) < 10){
            $data['Message'] = "Please enter a full international mobile(cell)/phone number";    
        }elseif($data["Password"] != $data["Confirm"]){ 
            $data['Message'] = "The passwords that you enter differ, please try again.";
        }else{
            $sql = "SELECT email FROM members "
                ."WHERE MemberID = ? AND Password = MD5(?) ";
            $query = $this->db->query($sql, array($data['MemberID'], $data['OldPassword']));
            $row = $query->row_array();
            if($row){
                if ($row['email'] <> strtolower($data['Email'])){
                    // If email address has been changed then it needs to be checked
                    // 1. Revoke system access, set status to 'Registered'.
                    $sql = "UPDATE members SET FirstName = ?, LastName = ?, "
                        ."Email = ?, Mobile = ?, Status = 'Registered' "
                        ."WHERE MemberID = ? ";
                    $this->db->query($sql, array(
                        $data['FirstName'], 
                        $data['LastName'], 
                        strtolower($data['Email']), 
                        $data['C2P_Mobile'], 
                        $data['MemberID']));
                    $data['Message'] = "Your details have been updated.";
                    $data['NextPage'] = 'member/editmember';  
                    // 2. Send an email address confirmation request
                    
                    $sql = "SELECT MemberID, Status FROM members WHERE Email = ? "; 
                    $query = $this->db->query($sql, array(strtolower($data['Email'])));
                    $row = $query->row_array();
                    if($row){
                        // Prepare Email to new member
                        $data['MemberID'] = $row['MemberID'];
                        $data['Status'] = $row['Status'];
                        $data = $this->Email_model->NewMember($data);
                        $data['NextPage'] = 'c2p/emailsent';  
                    }
                    // NOTE 
                    // The user will also have to request a new reference to confirm 
                    // their details, because the email address is different. 
                    // But, this is perhaps not a bad thing.
                } else {
                    $sql = "UPDATE members SET FirstName = ?, LastName = ?, "
                        ."Email = ?, Mobile = ?, Status = ? WHERE MemberID = ? ";
                    $this->db->query($sql, array(
                        'Forgotten', 'Forgotten','Forgotten','Forgotten','Forgotten',
                        $data['MemberID']));
                    $data['Message'] = "Your personal details have been 'Forgotten'.";
                    $data['NextPage'] = 'member/editmember';  
                }                  
            } else {
                $data['Message'] = "Unable to match old password with Member ID.";
            }
        }  
        return($data);
    }  
    
    public function NewPasswordSave($data){
        $data['NextPage'] = 'member/newpassword';
        if($data['OldPassword']=='' or $data['Password']=='' 
            or $data['Confirm']=='' or $data['Reminder']==''){
            $data['Message'] = 'Please complete all fields to change your password.';  
        }elseif($data["Password"] != $data["Confirm"]){ 
            $data['Message'] = "The passwords that you enter differ, please try again.";
        }else{
            $sql = "SELECT 1 FROM members "
                ."WHERE MemberID = ? AND Password = MD5(?) ";
            $query = $this->db->query($sql, array($data['MemberID'], $data['OldPassword']));
            $row = $query->row_array();
            if($row){
                $sql = "UPDATE members SET Password = MD5(?), Reminder = ? "
                    ."WHERE MemberID = ? ";
                $this->db->query($sql, array($data['Password'], $data['Reminder'], $data['MemberID']));
                $data['Message'] = "Password updated.";
                //$data['NextPage'] = $this->websiteRoot.'newpassword';  
            } else {
                $data['Message'] = "Unable to match old password with Member ID.";
            }
        }
        return($data);
    }  
    public function ResetPassword($data){
        return($data);
    }
    public function ResetPasswordSave($data){
        $data['NextPage'] = 'sysadmin/resetpassword';
        if($data['PasswordEmail']=='' or $data['Password']=='' 
            or $data['Confirm']=='' or $data['Reminder']==''){
            $data['Message'] = 'Please complete all fields to change your password.';  
        }elseif($data["Password"] != $data["Confirm"]){ 
            $data['Message'] = "The passwords that you enter differ, please try again.";
        }else{
            $sql = "SELECT MemberID FROM members WHERE Email = ? ";
            $query = $this->db->query($sql, array($data['PasswordEmail']));
            $row = $query->row_array();
            if($row){
                $sql = "UPDATE members SET Password = MD5(?), Reminder = ? "
                    ."WHERE MemberID = ? ";
                $this->db->query($sql, array($data['Password'], $data['Reminder'], $row['MemberID']));
                $data['Message'] = "Password updated.";
                // Send member a reset passwordemail
                $data = $this->Email_model->PasswordReset($data);
            } else {
                $data['Message'] = "Email address not registered by a member.";
            }
        }
        return($data);
    }  

    public function AllMembers($data){
            $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List");
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"LastVisited DESC");
        $data['NewStatus'] = (isset($data['NewStatus'])?$data['NewStatus']:"");
        $data['ListMemberID'] = (isset($data['ListMemberID'])?$data['ListMemberID']:"");
        if($data['PageMode'] == "Update"){
            if(!$data['ListMemberID']=='' and !$data['NewStatus']==''){
//                if($data['NewStatus']=="Delete"){
//                    $sql = "DELETE FROM members WHERE MemberID = ? ";
//                    $query = $this->db->query($sql, array($data['ListMemberID']));
//                }else{
                    $sql = "UPDATE members SET Status = ? WHERE MemberID = ? ";
                    $query = $this->db->query($sql, array($data['NewStatus'],$data['ListMemberID']));
//                }
                $data['PageMode'] ='List';
            }
        }
        $sql = "SELECT MemberID, Email, FirstName, LastName, Status, OptedIn, Confirmed, Forgotten, Updated, LastVisited "
            ."FROM members ORDER BY ".$data['ListOrder']." ";
        $query = $this->db->query($sql);
        $results = array();
        foreach ($query->result_array() as $row){
            $results[] = $row;
        }
        $data['results'] = $results;
        return($data);
    }
    
    // GATEKEEPERS
    
    // Reference
    public function NewReference($data){
        $data['NextPage'] = 'member/newreference';
        $data['PageMode'] = 'newreference';
        return($data);
    }
    
    public function NewReferenceSave($data){
        //echo var_dump($data); 
        $data['NextPage'] = 'member/newreference';
        if($data['FirstName']=='' or $data['Email']=='' or $data['Account']==''){
            $data['Message'] = 'Your are not logged in. Please login to progress further.';  
            $data['NextPage'] = 'c2p/login.php';    
        }
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
        //}elseif(strlen(trim($data["RefPhone"])) < 10){
        //    $data['Message'] = "Please enter a full international mobile(cell)/phone number";    
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
                    ."'".str_replace("'", "''", $data['RefDetails'])."', "
                    ."'Unchecked') ";  
                $this->db->query($sql);
                $sql = "SELECT RefereeID FROM referees WHERE MemberID = ? AND Updated = ("
                    ."SELECT Max(Updated) FROM referees WHERE MemberID = ?) "; 
                $query = $this->db->query($sql, array($data["MemberID"],$data["MemberID"]));
                $row = $query->row_array();
                if($row){
                    $data['RefereeID'] = $row["RefereeID"];
                    // Check is the Reference is already a member
                    if(($ReferenceMemberID = $this->GetReferenceMemberID($data))>0
                        and (trim(strtolower($data['RefEmail'])) <> $data['Email'])){
                        $data['ReferenceMemberID'] = $ReferenceMemberID;
                        // Prepare email to new reference
                        $this->Email_model->NewReference($data);
                    } else {
                        // Prepare email to new admin about new reference
                        $this->Email_model->AdminReference($data);
                    }
                    $data['NextPage'] = 'c2p/emailsent';
                    // Update Member record with MemberID of Reference provided (if already a member)
                    $sql = "UPDATE members SET ReferenceID = ".$ReferenceMemberID." "
                        ."WHERE memberID = ".$data["MemberID"]." ";
                    $this->db->query($sql);
                    $sql = "UPDATE members SET ParentID = ".$ReferenceMemberID." "
                        ."WHERE memberID = ".$data["MemberID"]." "
                        ."AND ParentID IS NULL ";
                    $this->db->query($sql);
                } else {
                    $data['Message'] = "ERROR: Unable to recover Reference record";
                }
            } else {
                $data['Message'] = "ERROR: Unable to recover Member record";
            }
        } 
        return($data);
   }  

   private function GetReferenceMemberID($data){
        $ReferenceMemberID = 0;
        $sql = "SELECT M.MemberID FROM members M, referees R "
            ."WHERE R.RefereeID = ? "
            ."AND M.Status IN ('Member','Sponsor','Gatekeeper','SysAdmin') "
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
    
    public function MimicMember($data){
        // Pass in a value for MimicEmail
        // Save MemberID and Email so it can be restored after Mimic
        //$this->session->set_userdata('AdminID',$data('MenberID'));
        //$this->session->set_userdata('AdminEmail',$data('Email'));
        $sql = "SELECT * FROM members WHERE Email = ? ";
        $query = $this->db->query($sql, array($data['MimicEmail']));
        $row = $query->row_array();
        if($row){
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
                }
            }
        } else {
            $data['Message'] = "Member email not found.";
        }
        return($data);
    }    
    
    // Probably not needed as Admin can simply login in again.
    private function StopMimic($data){
        // Save MemberID and Email so it can be restored after Mimic
        $this->session->set_userdata('MemberID',set_userdata('AdminID'));
        $this->session->set_userdata('Email',set_userdata('MemberEmail'));
        $sql = "SELECT M.MemberID FROM members M, referees R "
            ."WHERE R.RefereeID = ? "
            ."AND M.Status IN ('Member','Sponsor','Gatekeeper','SysAdmin') "
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
        return($data);
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
*/

   
    //RETURNEE
//    public function ReturneeNew($data){
//        //$data = $this->LocationsList($data);
//        
//        return($data);
//    }
    /*
    public function ReturneeAdd($data){
        if(!isset($data['Returnee'])){ $data['Returnee'] = ''; }
        if(!isset($data['ReturnYear'])){ $data['ReturnYear'] = ''; }
        if(!isset($data['ReturnMonth'])){ $data['ReturnMonth'] = ''; }
        if(!isset($data['Details'])){ $data['Details'] = ''; }
        $data['NextPage'] = 'member/returneenew';
        if((!isset($data['Country']) OR $data['Country']=='') OR
            (!isset($data['Province']) OR $data['Province']=='') OR
            (!isset($data['City']) OR$data['City']=='')){
            $data['Message'] = 'Please select at least Country, Province & City';
        } elseif((!isset($data['District']) OR $data['District']=='') AND
            (!isset($data['Other']) OR $data['Other']=='')) {
            $data['Message'] = 'Please select a district or enter one not listed';
        } elseif(!isset($data['Returnee']) OR $data['Returnee']==''){
            $data['Message'] = 'Please provide a returnee name (or alias) for your returnee';
        } elseif((!isset($data['ReturnMonth']) OR $data['ReturnMonth']=='') OR 
            (!isset($data['ReturnYear']) OR $data['ReturnYear']=='')){
            $data['Message'] = 'Please indicate the date this person is returning home';
        } elseif(!isset($data['Details']) OR $data['Details']==''){
            $data['Message'] = 'Please indicate the date this person is returning home';
        } elseif(!isset($data['MemberID']) OR $data['MemberID']==''){
            $data['Message'] = 'Session timed out - Please login again.';
        } else {
            // All data okay - so create a new returnee record    
            $sql = "INSERT INTO returnees (MemberID, Alias, "
                ."Month, Year, Details, Country, Province, "
                ."City, District, Other) VALUES ('"
                .$data['MemberID']."','".$data['Returnee']."','".$data['ReturnMonth']."','"
                .$data['ReturnYear']."','".$data['Details']."','".$data['Country']."','"
                .$data['Province']."','".$data['City']."','".$data['District']."','"
                .$data['Other']."')"; 
            //echo $sql;
            $this->db->query($sql);
            $data['NextPage'] = 'returneelist';
        }      
        if($data['NextPage'] == 'returneenew'){
            // Data rejected return to ReturneeNew Page
            $data = $this->LocationsList($data); 
            $data['NextPage'] = 'returneenew';
        }
        return($data);
   }
*/
   
  /* 
   
   public function Login($data){
      $data['PageMode'] = 'Login';      
      $data['Message'] = 'Please login';
      if(!isset($data['Email']) or $data['Email'] ==''){
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
            $this->session->set_userdata('Email',$data['Email']);
            $this->session->set_userdata('C2P_Mobile',$data['C2P_Mobile']);
            $data['MemberID'] = $row['MemberID'];
            $data['FirstName'] = $row['FirstName'];
            $data['LastName'] = $row['LastName'];
            $data['C2P_Mobile'] = $row['Mobile'];
            $data['Email'] = $row['Email'];
            $data['Status'] = $row['Status'];
            $data['Account'] = $row['Account'];
            if(isset($data['MemberID'])){ 
               $data['NextPage'] = $this->websiteRoot."home.php";
               $sql = "UPDATE members "
                  ."SET LastVisited = '".date('Y-m-d H:i:s')."' " 
                  ."WHERE Email = '".strtolower($data['Email'])."'";
               $this->db->query($sql);
            }
         }else{
            $data['Message'] = 'Password Incorrect';
            $data['Reminder'] = $row["Reminder"];
         }
      }else{
         $data['Email'] = '';
         $data['Message'] = 'Member not registered';
      }
      return($data);
   }
   
   public function Logout($data){
      $this->session->set_userdata('Status','');
      $data['Status'] = '';
      $data['NextPage'] = 'c2p/login.php';
      return($data);
   }
  */ 
   
 /*   
    private function LocationsList($data){  
        if(!isset($data['Country'])){ $data['Country'] = 'China'; }
        if(!isset($data['Province'])){ $data['Province'] = ''; }
        if(!isset($data['City'])){ $data['City'] = ''; }
        if(!isset($data['District'])){ $data['District'] = ''; }
        // Countries
        if(!$data['District']=='' AND $data['City']==''){
            $sql = "SELECT City, Province, Country FROM locations "
                ."WHERE Status = 'Active' AND District = ? ";
            $query = $this->db->query($sql, array($data['District']));
            $row = $query->row_array();
            $data['City'] = $row['City'];
            $data['Province'] = $row['Province'];
            $data['Country'] = $row['Country'];
        }
        if(!$data['City']=='' AND $data['Province']==''){
            $sql = "SELECT Province, Country FROM locations "
                ."WHERE Status = 'Active' AND City = ? ";
            $query =   $this->db->query($sql, array($data['City']));
            $row = $query->row_array();
            $data['Province'] = $row['Province'];
            $data['Country'] = $row['Country'];
        }
        $sql = "SELECT DISTINCT Country as Name FROM locations "
            ."WHERE Status = 'Active' AND Country IS NOT NULL ";
        if(isset($data['Province']) AND !$data['Province'] ==''){
            $sql.="AND Province = '".$data['Province']."' ";}
        if(isset($data['City']) AND !$data['City'] ==''){
            $sql.="AND City = '".$data['City']."' ";      }
        if(isset($data['District']) AND !$data['District'] ==''){
            $sql.="AND District = '".$data['District']."' ";}
        $sql.="ORDER BY Country ";
        $query = $this->db->query($sql);
        $Countries = $query->result_array();
        $data['Countries'] = $Countries;
        // Provinces
        $sql = "SELECT DISTINCT Province as Name FROM locations "
            ."WHERE Status = 'Active' AND Province IS NOT NULL ";
        if(isset($data['Country']) AND !$data['Country'] ==''){
            $sql.="AND Country = '".$data['Country']."' ";      }
        if(isset($data['City']) AND !$data['City'] ==''){
            $sql.="AND City = '".$data['City']."' ";      }
        if(isset($data['District']) AND !$data['District'] ==''){
            $sql.="AND District = '".$data['District']."' ";}
        $sql.="ORDER BY Province ";
            $query = $this->db->query($sql);
        $Provinces = $query->result_array();
        $data['Provinces'] = $Provinces;
        // Cities
        $sql = "SELECT DISTINCT City as Name FROM locations "
            ."WHERE Status = 'Active' AND City IS NOT NULL ";
        $query = $this->db->query($sql);
        $Cities = $query->result_array();
        if(isset($data['Country']) AND !$data['Country'] ==''){
          $sql.="AND Country = '".$data['Country']."' ";      }
      if(isset($data['Province']) AND !$data['Province'] ==''){
          $sql.="AND Province = '".$data['Province']."' ";}
      if(isset($data['District']) AND !$data['District'] ==''){
          $sql.="AND District = '".$data['District']."' ";}
      $sql.="ORDER BY City ";
      $query = $this->db->query($sql);
      $Cities = $query->result_array();
      $data['Cities'] = $Cities;
      // Districts
      $sql = "SELECT DISTINCT District as Name FROM locations "
         ."WHERE Status = 'Active' AND District IS NOT NULL ";
      if(isset($data['Country']) AND !$data['Country'] ==''){
          $sql.="AND Country = '".$data['Country']."' ";      }
      if(isset($data['Province']) AND !$data['Province'] ==''){
          $sql.="AND Province = '".$data['Province']."' ";}
      if(isset($data['City']) AND !$data['City'] ==''){
          $sql.="AND City = '".$data['City']."' ";      }
//      if(isset($data['District']) AND !$data['District'] ==''){
//          $sql.="AND District = '".$data['District']."' ";}
      $sql.="ORDER BY District ";   
      $query = $this->db->query($sql);
      $Districts = $query->result_array();
      $data['Districts'] = $Districts;
      // Statistics 
      $sql = "SELECT count(Distinct L.LocationID) AS Locations, "
        ."count(Distinct ContactID) AS Contacts, " 
        ."count(Distinct ChurchNum) AS Churches "
        ."FROM locations L "
        ."LEFT JOIN contacts C on (C.LocationID = L.LocationID) "
        ."LEFT JOIN amitychurches A on (A.Province = L.Province AND A.City = L.City) "
        ."WHERE L.Status = 'Active' AND L.City IS NOT NULL "; 
      if(isset($data['Country']) AND !$data['Country'] ==''){
          $sql.="AND L.Country = '".$data['Country']."' ";      }
      if(isset($data['Province']) AND !$data['Province'] ==''){
          $sql.="AND L.Province = '".$data['Province']."' ";}
      if(isset($data['City']) AND !$data['City'] ==''){
          $sql.="AND L.City = '".$data['City']."' ";      }
      if(isset($data['District']) AND !$data['District'] ==''){
          $sql.="AND L.District = '".$data['District']."' ";}
      //echo $sql;
      $query = $this->db->query($sql);
      $Stats = $query->row_array();
      $data['Stats'] = $Stats;
      //echo var_dump($data['Cities']);
      return($data);
   }
*/
    
   /* No longer needed 
   public function CreateCLVerify($data){
       $data['ClickLinkEmail'] = $data['Email'];
       $data['ClickLinkModel'] = 'member';
       $data['ClickLinkModelID'] = $data['MemberID'];
       $data['ClickLinkModelFn'] = 'Update';
       $data['ClickLinkCLValue'] = 'Verified';
       $data['ClickLinkCLSQL'] = "UPDATE members SET Status = 'Verified' "
            ."WHERE Status = 'Registered' AND MemberID = ".$data['MemberID'];
       $data = $this->Clicklink->Create($data);
       return($data);
   } 
   */    
      
       
   
   
   
   
 }


