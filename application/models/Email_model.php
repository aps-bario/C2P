<?php
class Email_model extends CI_Model {
    private $websiteURL  = 'https://www.connecting2people.net/';
    private $websiteRoot = 'c2p/';
    private $websiteName = 'Connecting2People - helping to connect Christians returning home';
    private $websiteAdmin = 'Connecting2People Admin';
    private $websiteEmail = 'admin@Connecting2People.net';
    
    /*************
     * FUNCTIONS *
     *************
     * EmailHTMLHeader()    - HTML Code needed by Apple Mail to process forms
     * EmailHTMLFooter()    - HTML Code needed by Apple Mail to process forms
     * FeedbackSave()       - Email Feedback to C2P Admin
     * NewMember()          - Sent to verifiy email address of new members
     * PasswordReset()      - Notify members of password reset by admin
     * NewReference()       - Email to Referee asking for a new reference 
     * AdminReference()     - Email to Admin to confirm new member reference
     * ReferenceConfirm()   - Confirmation of member status after reference
     * ReferenceConcerns()  - Disabled
     * Referral_email()     - No Code
     * NoReferral()         - Notify Sponsor that no referral possible
     * Referred()           - Notify Sponsor that Gatekeeper will be in touch
     * NewReferral()        - Notify Gatekeeper of a new referral
     * ChaseGateKeeper()    - Chase Gatekeeper for progress on referral
     * ChaseSponsor         - Chase Sponsor for progress update from returnee
     * CityWatchReferral()  - Notify City Watch of new referral
     * SendReturneeForm()   -
     * ReturneeForm1()      -
     * ForwardReturneeData()-
     * 
    */
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('email');
        $this->load->helper('Emailhtml_helper');   
        $this->load->model('Clicklink_model');
        //$this->$websiteURL = $config['base_url'];
    }
    /*
    private function EmailHTMLHeader(){
        $html = "<html><head>"
            ."<meta http-equiv=\"Content-Type\" content=\"text/html charset=utf-8\">"
            ."<base></head>"
            ."<body style=\"word-wrap: break-word; -webkit-nbsp-mode: space; -webkit-line-break: after-white-space;\">"
            ."<base>"
            ."<div class=\"Apple-Mail-URLShareUserContentTopClass\"><br></div>"
            ."<div class=\"Apple-Mail-URLShareWrapperClass\" style=\"position: relative !important;\">"
            ."<blockquote type=\"cite\" style=\"border-left-style: none; color: inherit; padding: inherit; margin: inherit;\">";
        return($html);
    }
    private function EmailHTMLFooter(){
        $html = "</blockquote></div><br><br>"
            ."<div apple-content-edited=\"true\">"
            ."<div><a href=\"mailto:shiande.dm@gmail.com\">shiande.dm@gmail.com</a></div>"
            ."<div ><br></div><br class=\"Apple-interchange-newline\"></div>"
            ."<br></body></html>";  
        return($html);
    }
    */
    public function FeedbackSave($data){
        $Name = (isset($_POST['Name'])?$_POST['Name']:($data['FirstName'].' '.$data['LastName']));
        $Email = (isset($_POST['Email'])?$_POST['Email']:$data['Email']);
        $Phone = (isset($_POST['Phone'])?$_POST['Phone']:'');
        $Type = (isset($_POST['Type'])?$_POST['Type']:'Feedback');
        $Subject = (isset($_POST['Subject'])?$_POST['Subject']:'C2P Feedback');
        $EmailBody = (isset($_POST['EmailBody'])?$_POST['EmailBody']:'No message included');
        $sql = "INSERT INTO feedback (Name, Email, Phone, Type, Subject, Message) "
            ."VALUES ('$Name', '$Email', '$Phone', '$Type',"
            ."'".str_replace("'", "''", $Subject)."',"
            ."'".str_replace("'", "''", $EmailBody)."')";
        $this->db->query($sql);
        // Send Email
        $config['protocol'] = 'sendmail';
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->clear();
        $this->email->to('admin@connecting2people.net');
        $this->email->from($Email,$Name);
        $this->email->reply_to($Email);
        $this->email->subject("Connecting2People Feedback (".$Type."):".$Subject); 
        $this->email->message("<h4>Connecting2People Feedback (".$Type."):</h4><h3>".$Subject."</h3>"
                .$EmailBody."<br/><br/>".$Name."<br/>".$Email."<br/>".$Phone);
        if($this->email->send()){;
            // echo $this->email->print_debugger();
            $data['NextPage'] = 'c2p/emailsent';
            $data['Message'] = "Your Feedback has been sent by email - Thank you.";
        }else{
            $data['EmailError'] = $this->email->print_debugger();
        }
        return($data);
    } 

    public function NewMember($data){
       $sql = "SELECT * FROM members WHERE MemberID = ? ";
        $query = $this->db->query($sql, array($data['MemberID']));
        $row = $query->row_array();
      if($row){
        $config['mailtype'] = 'html';
        $config['protocol'] = 'sendmail';  
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
            ."If you are not a new member, but have recently changed your email address, "
            ."then we still need you to confirm this new address and to ask a reference "
            ."to confirm that it is an address that they have for you.<br/><br/>\n\n";
        
//            $emailtext .="<b color='red'>PLEASE NOTE: <br/>\n"
//            ."There are some clickable links below, that allow you to update the "
//            ."online system directly from this email. However, in order for them "
//            ."to work, you will need to be connected to the Internet when "
//            ."you click them. So please do not assume they have worked unless "
//            ."you actually see them launch an internet browser and access a web page."
//            ."</b><br/><br/>\n\n ";
           
        // Prepare Clicklink Code for Email
        //$data['MemberID'] = $row["MemberID"];
        $data['ClickLinkEmail'] = $data['Email'];
        $data['ClickLinkModel'] = 'member';
        $data['ClickLinkModelID'] = $data['MemberID'];
        $data['ClickLinkModelFn'] = 'Update';
        $data['ClickLinkCLValue'] = 'Verified';
        $data['ClickLinkCLSQL'] = "UPDATE members SET Status = 'Verified' "
            ."WHERE Status = 'Registered' AND MemberID = ".$data['MemberID'];
        $data = $this->Clicklink_model->Create($data);
        //if($data['ClicklinkCreated']){
        // Write link into email            
        $emailtext.="<b><a href='".$this->websiteURL."/clicklink/".$data['ClicklinkCLCode']."'>"
            ."[CLICK TO CONFIRM]</a> I confirm receipt of this email.</b> <br/><br/>\n\n";
        //}
        $emailtext.="If you have any difficulty with the login process please email "
            .$this->websiteEmail."<br/><br/>\n\n"
            ."New features are being added to the site all the time so please "
            ."keep checking on what has changed or been improved. "
            ."Your feedback back would be very much appreciated.<br/><br/>\n\n"
            ."Best regards,<br/><br/>\n\n" 
            .$this->websiteAdmin."<br/><br/>\n\n".$this->websiteName."\n";
        $this->email->message($emailtext);
        if($this->email->send()){;
//          echo $this->email->print_debugger();
            // $this->websiteRoot.
            $data['NextPage'] = 'c2p/emailsent';
            $data['Message'] = 'You have been sent an email to confirm your email address';
        }else{
            $data['EmailError'] = $this->email->print_debugger();
        }
      } else {
         $data['Message'] = 'Member account created, but verification email not sent.';
      }
      return($data);
    }
    public function PasswordReset($data){
        $sql = "SELECT * FROM members WHERE Email = ? ";
        $query = $this->db->query($sql, array($data['PasswordEmail']));
        $row = $query->row_array();
        if($row){
            $config['mailtype'] = 'html';
            $config['protocol'] = 'sendmail';  
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->to($data['PasswordEmail']);
            $this->email->bcc($this->websiteEmail,$this->websiteAdmin);
            $this->email->from($this->websiteEmail,$this->websiteAdmin);
            $this->email->reply_to($this->websiteEmail);
            $this->email->subject("Password reset at ".$this->websiteName); 
            $emailtext = "Dear ".$row['FirstName'].",<br/><br/>\n\n" 
                ."Your password has been reset on the Connecting2People web-site. "
                ."If you did not request this please inform the system administator. "
                ."<br/><br/>\n\n"
                ."A temporary password has been set for for you: <br/><br/>\n\n"
                ."New Password: ".$data['Password']."<br/>\n<br/>\n"
                ."Please now return to the <a ref='https://www.connecting2people.net/c2p/login'>"
                ."Connecting2People.net</a> website "
                ."and change the password to one of your choosing. <br/>\n<br/>\n"
                ."Please keep this email safe until your have changed your password.<br/><br/>\n\n";
            $emailtext.="If you have any difficulty with the login process please email "
                .$this->websiteEmail."<br/><br/>\n\n"
                ."New features are being added to the site all the time so please "
                ."keep checking on what has changed or been improved. "
                ."Your feedback back would be very much appreciated.<br/><br/>\n\n"
                ."Best regards,<br/><br/>\n\n" 
                .$this->websiteAdmin."<br/><br/>\n\n".$this->websiteName."\n";
            $this->email->message($emailtext);
            if($this->email->send()){;
//              echo $this->email->print_debugger();
                // $this->websiteRoot.
                $data['NextPage'] = 'c2p/emailsent';
                $data['Message'] = 'The member has been emailed a new password';
            }else{
                $data['EmailError'] = $this->email->print_debugger();
            }
        } else {
            $data['Message'] = 'Member account created, but verification email not sent.';
        }
        return($data);
    }
    public function NewReference($data){
      // Send Email
      $config['protocol'] = 'sendmail';
      $config['mailtype'] = 'html';
      $this->email->initialize($config);
      $this->email->clear();
      $this->email->to($data['RefEmail']);
      $this->email->bcc($this->websiteEmail,$this->websiteAdmin);
      $this->email->from($this->websiteEmail,$this->websiteAdmin);
      $this->email->reply_to($this->websiteEmail);
      $this->email->subject("Connecting2People Reference request for "
         .$data['FirstName']." ".$data['LastName']); 
      $emailtext = "Dear ".$data['RefFirstName'].",<br/><br/>\n\n" 
         ."We have received a request from "
         .$data['FirstName']." ".$data['LastName']." to use returnee referral "
         ."services on our website ".$this->websiteName."<br/><br/>\n\n" 
         ."Your name and contact details were provided as someone who would be "
         ."willing to confirm ".$data['FirstName']."'s identity and suitability to "
         ."be allowed to make requests to other users of this service to help "
         ."refer students returning home.<br/><br/>\n\n"
         .$data['FirstName']." ".$data['LastName']." has provided the "
         ."following contact details for you and themselves, "
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
         ."please click the following link;<br/><br/>\n\n";
//            $emailtext .="<b color='red'>PLEASE NOTE: <br/>\n"
//             ."There are some clickable links below, that allow you to update the "
//             ."online system directly from this email. However, in order for them "
//             ."to work, you will need to be connected to the Internet when "
//           ."you click them. So please do not assume they have worked unless "
//             ."you actually see them launch an internet browser and access a web page."
//            ."</b><br/><br/>\n\n ";
        // Prepare Clicklink Code for Email
        $data['ClickLinkEmail'] = $data['RefEmail'];
        $data['ClickLinkModel'] = 'member';
        $data['ClickLinkModelID'] = $data['MemberID'];
        $data['ClickLinkModelFn'] = 'Update';
        $data['ClickLinkCLValue'] = 'Member';
        $data['ClickLinkCLSQL'] = "UPDATE members SET Status = 'Member' "
            ."WHERE Status = 'Verified' AND MemberID = ".$data['MemberID'];
        $data = $this->Clicklink_model->Create($data);
        // Write link into email            
        $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
         ."[ CLICK TO CONFIRM ]</a> I am happy to confirm suitability</b> <br/><br/>\n\n"
         ."If you have any concerns about the identity or suitability of this person "
         ."with regard to giving them access to the website, either reply to this email "
         ."or simply click the link below and we will get back in contact with you.<br/><br/>\n\n";
        // Prepare Clicklink Code for Email
        $data['ClickLinkEmail'] = $data['RefEmail'];
        $data['ClickLinkModel'] = 'member';
        $data['ClickLinkModelID'] = $data['MemberID'];
        $data['ClickLinkModelFn'] = 'Update';
        $data['ClickLinkCLValue'] = 'Concerns';
        $data['ClickLinkCLSQL'] = "UPDATE members SET Status = 'Concerns' "
            ."WHERE MemberID = ".$data['MemberID'];
        $data = $this->Clicklink_model->Create($data);
        // Write link into email            
        $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
         ."[ CLICK IF CONCERNS ]</a> I have concerns about confirming suitability</b> <br/><br/>\n\n"
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
            $data['NextPage'] = 'c2p/emailsent';
            $data['Message'] = 'An email has been sent to your reference.';
      }else{
         $data['NextPage'] = 'member/newreference';
         $data['Message'] = "ERROR: Email was not sent.";
         $data['EmailError'] = $this->email->print_debugger();
      }
      return($data);
   }
    public function AdminReference($data){
        // Send Email
        $config['protocol'] = 'sendmail';
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->clear();
        $this->email->to($this->websiteEmail);
        $this->email->from($this->websiteEmail);
        $this->email->reply_to($this->websiteEmail);
        $this->email->subject("Connecting2People Reference request from "
            .$data['FirstName']." ".$data['LastName']); 
        $emailtext = "Automated Email from the website ".$this->websiteName."<br/><br/>\n\n" 
            .$data['FirstName']." ".$data['LastName']." "
            ."has requested access to ".$this->websiteName." and provided the "
            ."following reference details for someone who is not yet a member.<br/><br/>\n\n" 
            .$data['FirstName']." has provided the following contact details themselves "
            ."and their reference, together brief summary of their connection and interest. "
            ."<br/><br/>\n\n"
            ."Name:     ".$data['FirstName']." ".$data['LastName']."<br/>\n"
            ."Email:    ".$data['Email']."<br/>\n"
            ."Phone:    ".$data['C2P_Mobile']."<br/>\n<br/>\n"
            ."Reference Name:    ".$data['RefFirstName']." ".$data['RefLastName']."<br/>\n"
            ."Reference Email:   ".$data['RefEmail']."<br/>\n"
            ."Reference Phone:   ".$data['RefPhone']."<br/>\n<br/>\n"
            ."Other information: <br/>\n".$data['RefDetails']."<br/>\n<br/>\n"
            ."Please contact the reference and if you are then happy to confirm that "
            .$data['FirstName']." should be allowed to access to the referral system "
            ."and it will not compromise personal information about those in China "
            ."or others like yourself connecting returnees back home.<br/><br/>\n\n ";
//            $emailtext .="<b color='red'>PLEASE NOTE: <br/>\n"
//            ."There are some clickable links below, that allow you to update the "
// /           ."online system directly from this email. However, in order for them "
//            ."to work, you will need to be connected to the Internet when "
//            ."you click them. So please do not assume they have worked unless "
//            ."you actually see them launch an internet browser and access a web page."
//            ."</b><br/><br/>\n\n ";
        // Prepare Clicklink Code for Email
        $data['ClickLinkEmail'] = $this->websiteEmail;
        $data['ClickLinkModel'] = 'member';
        $data['ClickLinkModelID'] = $data['MemberID'];
        $data['ClickLinkModelFn'] = 'Update';
        $data['ClickLinkCLValue'] = 'Member';
        $data['ClickLinkCLSQL'] = "UPDATE members SET Status = 'Member' "
            ."WHERE MemberID = ".$data['MemberID'];
        $data = $this->Clicklink_model->Create($data);
        // Write link into email            
        $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
            ."[ CLICK TO CONFIRM ]</a> I am happy to confirm suitability</b> <br/><br/>\n\n"
            ."If you have any concerns about the identity or suitability of this person "
            ."with regard to giving them access to the website, either reply to this email "
            ."or simply click the link below and we will get back in contact with you.<br/><br/>\n\n";
        // Prepare Clicklink Code for Email
        $data['ClickLinkEmail'] = $this->websiteEmail;
        $data['ClickLinkModel'] = 'member';
        $data['ClickLinkModelID'] = $data['MemberID'];
        $data['ClickLinkModelFn'] = 'Update';
        $data['ClickLinkCLValue'] = 'Concerns';
        $data['ClickLinkCLSQL'] = "UPDATE members SET Status = 'Concerns' "
            ."WHERE MemberID = ".$data['MemberID'];
        $data = $this->Clicklink_model->Create($data);
        // Write link into email            
        $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
            ."[ CLICK IF CONCERNS ]</a> I have concerns about confirming suitability</b> <br/><br/>\n\n"
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
            $data['NextPage'] = 'c2p/emailsent';
            $data['Message'] = 'The system administrator has been sent details if your reference.';
        }else{
            $data['NextPage'] = 'member/newreference';
            $data['Message'] = "ERROR: Email was not sent.";
            $data['EmailError'] = $this->email->print_debugger();
        }
        return($data);
    }   
    public function ReferenceConfirm($data){
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
         ."on the website with regard to security and protecting personal data.<br/><br/>\n\n";
//            $emailtext .="<b color='red'>PLEASE NOTE: <br/>\n"
//         ."There are some clickable links below, that allow you to update the "
//         ."online system directly from this email. However, in order for them "
//         ."to work, you will need to be connected to the Internet when "
//         ."you click them. So please do not assume they have worked unless "
//         ."you actually see them launch an internet browser and access a web page."
//         ."</b><br/><br/>\n\n "
      $emailtext .="<b><a href='".$this->websiteURL.$this->websiteRoot."login'>"
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
        $data['NextPage'] = 'c2p/emailsent';
        $data['Message'] = "Email has been sent";
      }else{
         $data['Message'] = "ERROR: Email was not sent.";
         $data['EmailError'] = $this->email->print_debugger();
      }
      return($data);
   }
    public function Referral_Email($data){
        
        return($data);
    }
    public function NoReferral($data){
        $sql = "SELECT M.FirstName, M.Email, R.ReturneeAlias "
            ."FROM members M, returnees R "
            ."WHERE M.MemberID = R.SponsorID AND R.ReturneeID = ? ";
        $query = $this->db->query($sql, array($data['ReturneeID']));
        $row = $query->row_array();
        if($row){
            // Send Email
            $config['protocol'] = 'sendmail';
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->to($row['Email']);
            $this->email->bcc($this->websiteEmail,$this->websiteAdmin);
            $this->email->from($this->websiteEmail,$this->websiteAdmin);
            $this->email->reply_to($this->websiteEmail);
            $this->email->subject("C2P Reference request for ".$row['ReturneeAlias']." - Unsuccessful"); 
            $emailtext = "Dear ".$row['FirstName'].",<br/><br/>\n\n" 
                ."We have processed your request to find a contact for ".$row['ReturneeAlias'].". "
                ."Unfortunately, we do not currently know of anyone who has a contact in that location. "
                ."Your friend's details can remain in the system where you can manage them, and then in "
                ."future will be able to return to the ".$this->websiteName." website and request a new "
                ."search to be done. New contact locations are being listed all the time.<br/><br/>\n\n" 
                ."Your feedback back on this process would be very much appreciated.<br/><br/>\n\n"
                ."Best regards,<br/><br/>\n\n" 
                .$this->websiteAdmin."<br/><br/>\n\n".$this->websiteName."\n";
            $this->email->message($emailtext);
            if($this->email->send()){
                $data['Message'] = "Email has been Sent";
            }else{
                $data['Message'] = "ERROR: Email was not sent.";
                $data['EmailError'] = $this->email->print_debugger();
            }
        } else {
            $data['Message'] = "ERROR: Unable to prepare email.";
        }
        $data['NextPage'] = 'sponsors/myreturnees';
        return($data);
    }
    public function Referred($data){
        // Email to Sponsor
        $sql = "SELECT S.FirstName as SFirstName, S.LastName as SLastName, "
            ."S.Email as SEmail,  S.Mobile as SMobile, "
            ."G.FirstName as GFirstName, G.LastName as GLastName, G.Email as GEmail,"
            ."R.ReturneeAlias, R.Country, R.Province, R.City, R.District, R.Details, "
            ."R.ReturnMonth, R.ReturnYear, "
            ."F.ReferralID, F.ReturneeID, F.PlaceID "
            ."FROM members S, returnees R, members G, referrals F "
            ."WHERE G.MemberID = F.GatekeeperID "
            ."AND S.MemberID = F.SponsorID "
            ."AND R.ReturneeID = F.ReturneeID "    
            ."AND F.ReturneeID = ? ";
        $query = $this->db->query($sql, array($data['ReturneeID']));
        $row = $query->row_array();
        if($row){
            // Send Email
            $config['protocol'] = 'sendmail';
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->to($row['SEmail']);
            $this->email->bcc($this->websiteEmail,$this->websiteAdmin);
            $this->email->from($this->websiteEmail,$this->websiteAdmin);
            $this->email->reply_to($this->websiteEmail,$this->websiteAdmin);
            $this->email->subject("Connecting2People Returnee contact request for "
                .$row['ReturneeAlias']); 
            $emailtext = "Dear ".$row['SFirstName'].",<br/><br/>\n\n" 
                ."We have processed your request and found a contact for ".$row['ReturneeAlias'].". "
                ."Our policy is that the initiative to make contact should be firstly with the person "
                ."who has the contact in the country your friend is returning to, and then the contact "
                ."themselves. For this reason, we have not given you the details of this 'Gatekeeper', "
                ."but rather have asked them to contact you for more information about "
                .$row['ReturneeAlias'].".<br/><br/>\n\n"
                ."We would ask that you keep this email so that when you are contacted by someone you "
                ."can click the appropriate link below, so both you and the system can keep track of "
                ."the progress of this referral. If you do not hear from anyone in a few days or, if "
                ."after you have been in touch it is clear that they will not be able to assist you, "
                ."then you may use one of the other links below to trigger a new referral request.<br/><br/>\n\n"
                ."Your friend's details can remain in the system where you can manage them, and then in "
                ."future will be able to return to the ".$this->websiteName." website and track the progress "
                ."updated by the Gatekeeper for the contact in the home country. We ask only that when you "
                ."hear from ".$row['ReturneeAlias'].", that they have been contacted, that you click the "
                ."last of the links so that the system knows that the referral is complete.<br/><br/>\n\n";
//            $emailtext .="<b color='red'>PLEASE NOTE: <br/>\n"
//                ."There are some clickable links below, that allow you to update the "
//            ."online system directly from this email. However, in order for them "
//            ."to work, you will need to be connected to the Internet when "
//            ."you click them. So please do not assume they have worked unless "
//            ."you actually see them launch an internet browser and access a web page."
//            ."</b><br/><br/>\n\n ";
// Prepare Clicklink Code for Email
            $data['ClickLinkEmail'] = $row['SEmail'];
            $data['ClickLinkModel'] = 'referral';
            $data['ClickLinkModelID'] = $row['ReferralID'];
            $data['ClickLinkModelFn'] = 'Insert';
            $data['ClickLinkCLValue'] = 'Acknowledged';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Acknowledged')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ Acknowledged ]</a> My referral request has been acknowledged, someone has contacted me.</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Concerned';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Concerned')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ CONCERNED ]</a> I am concerned about the process or the person who contacted me.</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Contacted';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Contacted')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ CONTACTED ]</a> My friend has confirmed that they have been contacted by someone where they are.</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            
            $data['ClickLinkModel'] = 'referral';
            $data['ClickLinkModelID'] = $row['ReturneeID'];
            $data['ClickLinkModelFn'] = 'ReferralCheck';
            $data['ClickLinkCLValue'] = 'New Referral';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'NewReferral')";
            //$data['ClickLinkCLAction'] = "$"."data['ReturneeID'] = '".$row['ReturneeID']."'; "
            //        ."ReferralCheck($data);";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ NEW REFERRAL ]</a> I have not been contacted, or contact was declined, please start a new referral.</b><br/><br/>\n\n"
                ."Please keep this email so that you will be able to use the other links above as contact progresses. "
                ."If you have any difficulty using the above links or this this the first time "
                ."you have used this system and would like advise, then you may email us at "
                .$this->websiteEmail." and someone will be in touch.<br/><br/>\n\n"
                ."Your feedback back on this process would be very much appreciated.<br/><br/>\n\n"
                ."Best regards,<br/><br/>\n\n" 
                .$this->websiteAdmin."<br/><br/>\n\n".$this->websiteName."\n";
            $this->email->message($emailtext);
            if($this->email->send()){
                $data['NextPage'] = 'c2p/emailsent';
                $data['Message'] = "An email has been sent to a possible contact.";
            }else{
                $data['Message'] = "ERROR: Email was not sent.";
                $data['EmailError'] = $this->email->print_debugger();
            }
        } else {
            $data['Message'] = "ERROR: Unable to prepare email.";
        }
        $data['NextPage'] = 'sponsor/myreturnees';
        return($data);
    }
    public function NewReferral($data){
        $sql = "SELECT S.FirstName as SFirstName, S.LastName as SLastName, "
            ."S.Email as SEmail,  S.Mobile as SMobile, "
            ."G.FirstName as GFirstName, G.LastName as GLastName, G.Email as GEmail,"
            ."R.ReturneeAlias, R.Country, R.Province, R.City, R.District, R.Details, "
            ."R.ReturnMonth, R.ReturnYear, "
            ."F.ReferralID, F.ReturneeID, F.PlaceID "
            ."FROM members S, returnees R, members G, referrals F "
            ."WHERE G.MemberID = F.GatekeeperID "
            ."AND S.MemberID = F.SponsorID "
            ."AND R.ReturneeID = F.ReturneeID "    
            ."AND F.ReturneeID = ? "
            ."ORDER BY F.ReferralID DESC ";
        $query = $this->db->query($sql, array($data['ReturneeID']));
        $row = $query->row_array();
        if($row){
            // Send Email
            $config['protocol'] = 'sendmail';
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->to($row['GEmail']);
            $this->email->bcc($this->websiteEmail,$this->websiteAdmin);
            $this->email->from($this->websiteEmail,$this->websiteAdmin);
            $this->email->reply_to($row['SEmail']);
            $this->email->subject("C2P Returnee request for "
                .$row['ReturneeAlias']." returning to ".$row['City']); 
            $emailtext = "Dear ".$row['GFirstName'].",<br/><br/>\n\n" 
                ."We have received a request for a contact in a location you have told us you know someone. "
                ."The person making this request is known to other users of this web service and therefore "
                ."should understand the security implications of passing the details of the returnee they "
                ."they know to you, as well as the need to protect the your contact's security."
                ."The details of the returnee and their sponsor are below. They have not been given any "
                ."information about you or your contact, so the initiative to make "
                ."referral has been left to you.<br/>\n<br/>\n"
                ."<b>RETURNEE: </b>".$row['ReturneeAlias']." returning to;<br/>\n"
                ."Country: ".$row['Country']."<br/>\n"
                ."Province: ".$row['Province']."<br/>\n"
                ."City: ".$row['City']."<br/>\n"
                ."District: ".$row['District']."<br/>\n"
                ."Expected return month: ".$row['ReturnMonth']." ".$row['ReturnYear']."<br/>\n"    
                ."Other information given:  ".$row['Details']."<br/>\n<br/>\n"
                ."<b>SPONSOR</b>: ".$row['SFirstName']." ".$row['SLastName']."<br/>\n"
                ."Email: ".$row['SEmail']."<br/>\n"
                ."Phone: ".$row['SMobile']."<br/>\n<br/>\n"
                ."In order to make it easier for you to contact the person above, "
                ."you need only reply to this email and as the sponsor's email has been added for you.<br/>\n"
                ."When you have considered whether you can help please click the appropriate link(s) below.<br/><br/>\n\n ";
//            $emailtext .="<b color='red'>PLEASE NOTE: <br/>\n"
//               ."There are some clickable links below, that allow you to update the "
//               ."online system directly from this email. However, in order for them "
//               ."to work, you will need to be connected to the Internet when "
//               ."you click them. So please do not assume they have worked unless "
//               ."you actually see them launch an internet browser and access a web page."
//               ."</b><br/><br/>\n\n ";
         // Prepare Clicklink Code for Email
            $data['ClickLinkEmail'] = $row['GEmail'];
            $data['ClickLinkModel'] = 'referral';
            $data['ClickLinkModelID'] = $row['ReferralID'];
            $data['ClickLinkModelFn'] = 'Insert';
            $data['ClickLinkCLValue'] = 'Responded';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID,Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Responded')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ RESPONDED ]</a> I have responded to the sponsor of the returnee.</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Concerned';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Concerned')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ CONCERNED ]</a> I have concerns about the identity of the returnee or their sponsor. </b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Cancelled';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Cancelled')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ CANCELLED ]</a> Sponsor <b>CANCELLED</b> referral or was unable to provide details</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Declined';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Declined')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ DECLINED ]</a> I have declined to help on this occasion. </b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Accepted';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Accepted')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ ACCEPTED ]</a> I have agreed to connect the returnee with one of my contacts.</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Connected';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Connected')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ CONNECTED ]</a> I have provided my contact with details of the person retuning to their location.</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Confirmed';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Confirmed')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ CONFIRMED ]</a> I have received confirmation from my contact that they have contacted the returnee</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Failed';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Failed')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ FAILED ]</a> My contact failed to connect with the returnee or I have lost touch with my contact</b><br/><br/>\n\n";
            
            $emailtext.="Please keep this email so that you will be able to use the other links above as contact progresses. "
                ."If you have any difficulty using the above links or this this the first time "
                ."you have been asked to refer a refurnee to one of you contacts and would like advise, then you may email us at "
                .$this->websiteEmail." and someone will be in touch.<br/><br/>\n\n"
                ."Your feedback back on this process would be very much appreciated.<br/><br/>\n\n"
                ."Best regards,<br/><br/>\n\n" 
                .$this->websiteAdmin."<br/><br/>\n\n".$this->websiteName."\n";
            $this->email->message($emailtext);
//            $data['NextPage'] = 'sponsor/myreturnees';
            $data['NextPage'] = 'c2p/emailsent';
            if($this->email->send()){
                $data['NextPage'] = 'c2p/emailsent';
                $data['Message'] = 'Sorry - No contact has been found. This has been confirmed by an email.';
                $data['Message'] = "Email has been Sent";
            }else{
                $data['Message'] = "ERROR: Email was not sent.";
                $data['EmailError'] = $this->email->print_debugger();
            }
        } else {
            $data['Message'] = "ERROR: Unable to prepare email.";
        }
        return($data);
    }
 
    public function ChaseGatekeeper($data){
        $sql = "SELECT S.FirstName as SFirstName, S.LastName as SLastName, "
            ."S.Email as SEmail,  S.Mobile as SMobile, "
            ."G.FirstName as GFirstName, G.LastName as GLastName, G.Email as GEmail,"
            ."R.ReturneeAlias, R.Country, R.Province, R.City, R.District, R.Details, "
            ."R.ReturnMonth, R.ReturnYear, "
            ."F.ReferralID, F.ReturneeID, ifnull(F.PlaceID,0) as PlaceID, F.Updated "
            ."FROM members S, returnees R, members G, referrals F "
            ."WHERE G.MemberID = F.GatekeeperID "
            ."AND S.MemberID = F.SponsorID "
            ."AND R.ReturneeID = F.ReturneeID "    
            ."AND F.ReferralID = ? ";
        $query = $this->db->query($sql, array($data['ReferralID']));
        $row = $query->row_array();
        
        if($row){
            // Send Email
            $config['protocol'] = 'sendmail';
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->to($row['GEmail']);
            $this->email->bcc($this->websiteEmail,$this->websiteAdmin);
            $this->email->from($this->websiteEmail,$this->websiteAdmin);
            $this->email->reply_to($this->websiteEmail,$this->websiteAdmin);
            $this->email->subject("C2P Follow-up request for "
                .$row['ReturneeAlias']." returning to ".$row['City']); 
            $emailtext = "Dear ".$row['GFirstName'].",<br/><br/>\n\n" 
                ."You received a referral request on ".date('d/m/Y',strtotime($row['Updated']))." for the returnee below, "
                ."and as the current status of this referral is not 'Confirmed' (or 'Failed'), "
                ."nor has it been updated in the last month, we would like to request an update. "
                ."<br/>\n<br/>\n"
                ."<b>RETURNEE: </b>".$row['ReturneeAlias']." returning to;<br/>\n"
                ."Country: ".$row['Country']."<br/>\n"
                ."Province: ".$row['Province']."<br/>\n"
                ."City: ".$row['City']."<br/>\n"
                ."District: ".$row['District']."<br/>\n"
                ."Expected return month: ".$row['ReturnMonth']." ".$row['ReturnYear']."<br/>\n"    
                ."Other information given:  ".$row['Details']."<br/>\n<br/>\n"
                ."<b>SPONSOR</b>: ".$row['SFirstName']." ".$row['SLastName']."<br/>\n"
                ."Email: ".$row['SEmail']."<br/>\n"
                ."Phone: ".$row['SMobile']."<br/>\n<br/>\n";
                
//            $emailtext .="<b color='red'>PLEASE NOTE: <br/>\n"
//               ."There are some clickable links below, that allow you to update the "
//               ."online system directly from this email. However, in order for them "
//               ."to work, you will need to be connected to the Internet when "
//               ."you click them. So please do not assume they have worked unless "
//               ."you actually see them launch an internet browser and access a web page."
//               ."</b><br/><br/>\n\n ";
//               
            // Progress Summary
            $sql2 = "SELECT Min(RP.Updated) as Updated, RP.Status "
                ."FROM referralprogress RP, referralstatus RS "
                ."WHERE RP.Status = RS.Status AND referralid = ? "
                ."GROUP BY Status ORDER BY RS.ListOrder ASC ";
            $query2 = $this->db->query($sql2, array($data['ReferralID']));
            //$row2 = $query2->row_array();
            $results = $query2->result_array();
            if(isset($results)){
                $emailtext.="<b>Referral Progress Summary</b><br/>\n";
                foreach($results as $row2):
                    $emailtext.= date('d/m/Y',strtotime($row2['Updated']))." - ";
                    switch($row2['Status']):
                    case 'Responded': $emailtext.="You <b>Responded</b> to the returnee's sponsor<br/>\n"; break;
                    case 'Acknowledged': $emailtext.="Sponsor <b>Acknowledged</b> you contacting them<br/>\n"; break;
                    case 'Concerned': $emailtext.="You were <b>Concerned</b> about the sponsor or returnee<br/>\n"; break;
                    case 'Declined': $emailtext.="You <b>Declined</b> to refer this returnee<br/>\n"; break;
                    case 'Accepted': $emailtext.="You <b>Accepted</b> this returnee for referral<br/>\n"; break;
                    case 'New Referral': $emailtext.="A <b>New referral</b> was requested for the returnee<br/>\n"; break;
                    case 'Connected': $emailtext.="You <b>Connected</b> with your contact about this returnee<br/>\n"; break;
                    case 'Confirmed': $emailtext.="You <b>Confirmed</b> that this returnee had been contacted<br/>\n"; break;
                    case 'Contacted': $emailtext.="Sponsor confirmed that this returnee had been <b>Contacted</b><br/>\n"; break;
                    case 'Chased': $emailtext.="You were <b>Chased</b> by the system for a progress update<br/>\n"; break;
                    case 'Failed': $emailtext.="You reported that your contact had 'Failed' to contact this returnee<br/>\n"; break;
                    endswitch;
                endforeach;
                $emailtext.="<br/>\n";
            }
            $emailtext.="Please check with your contact person and then update the progress of this referral by clicking the appropriate link(s) below.<br/><br/>\n\n ";

            // Prepare Clicklink Code for Email
            $data['ClickLinkEmail'] = $row['GEmail'];
            $data['ClickLinkModel'] = 'referral';
            $data['ClickLinkModelID'] = $row['ReferralID'];
            $data['ClickLinkModelFn'] = 'Insert';
            $data['ClickLinkCLValue'] = 'Responded';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID,Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Responded')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ RESPONDED ]</a> I have responded to the sponsor of the returnee.</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Concerned';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Concerned')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ CONCERNED ]</a> I have concerns about the identity of the returnee or their sponsor. </b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Cancelled';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Cancelled')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ CANCELLED ]</a> Sponsor <b>CANCELLED</b> referral or was unable to provide details</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Declined';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Declined')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ DECLINED ]</a> I have declined to help on this occasion. </b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Accepted';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Accepted')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ ACCEPTED ]</a> I have agreed to connect the returnee with one of my contacts.</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Connected';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Connected')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ CONNECTED ]</a> I have provided my contact with details of the person retuning to their location.</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Confirmed';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Confirmed')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ CONFIRMED ]</a> I have received confirmation from my contact that they have contacted the returnee</b><br/><br/>\n\n";            
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Failed';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Failed')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ FAILED ]</a> My contact failed to connect with the returnee or I have lost touch with my contact</b><br/><br/>\n\n";
            
            $emailtext.="Please keep this email so that you will be able to use the other links above as contact progresses. "
                ."If you have any difficulty using the above links or this this the first time "
                ."you have been asked to refer a refurnee to one of you contacts and would like advise, then you may email us at "
                .$this->websiteEmail." and someone will be in touch.<br/><br/>\n\n"
                ."Your feedback back on this process would be very much appreciated.<br/><br/>\n\n"
                ."Best regards,<br/><br/>\n\n" 
                .$this->websiteAdmin."<br/><br/>\n\n".$this->websiteName."\n";
            $this->email->message($emailtext);
//            $data['NextPage'] = 'sponsor/myreturnees';
            $data['NextPage'] = 'c2p/emailsent';
            if($this->email->send()){
                $data['NextPage'] = 'c2p/emailsent';
                //$data['Message'] = 'Sorry - No contact has been found. This has been confirmed by an email.';
                $data['Message'] = "Email has been Sent";
                $sql = "INSERT INTO referralprogress "
                    ."(ReferralID, ReturneeID, PlaceID,Status) VALUES "
                    ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Chased')";
                $this->db->query($sql);
            }else{
                $data['Message'] = "ERROR: Email was not sent.";
                $data['EmailError'] = $this->email->print_debugger();
            }
        } else {
            $data['Message'] = "ERROR: Unable to prepare email.";
        }
        return($data);
    }
    public function ChaseSponsor($data){
        // Email to Sponsor
        $sql = "SELECT S.FirstName as SFirstName, S.LastName as SLastName, "
            ."S.Email as SEmail,  S.Mobile as SMobile, "
            ."G.FirstName as GFirstName, G.LastName as GLastName, G.Email as GEmail,"
            ."R.ReturneeAlias, R.Country, R.Province, R.City, R.District, R.Details, "
            ."R.ReturnMonth, R.ReturnYear, "
            ."F.ReferralID, F.ReturneeID, F.PlaceID "
            ."FROM members S, returnees R, members G, referrals F "
            ."WHERE G.MemberID = F.GatekeeperID "
            ."AND S.MemberID = F.SponsorID "
            ."AND R.ReturneeID = F.ReturneeID "    
            ."AND F.ReturneeID = ? ";
        $query = $this->db->query($sql, array($data['ReturneeID']));
        $row = $query->row_array();
        if($row){
            // Send Email
            $config['protocol'] = 'sendmail';
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->to($row['SEmail']);
            $this->email->bcc($this->websiteEmail,$this->websiteAdmin);
            $this->email->from($this->websiteEmail,$this->websiteAdmin);
            $this->email->reply_to($this->websiteEmail,$this->websiteAdmin);
            $this->email->subject("Connecting2People Returnee contact request for "
                .$row['ReturneeAlias']); 
            $emailtext = "Dear ".$row['SFirstName'].",<br/><br/>\n\n" 
                ."We have processed your request and found a contact for ".$row['ReturneeAlias'].". "
                ."Our policy is that the initiative to make contact should be firstly with the person "
                ."who has the contact in the country your friend is returning to, and then the contact "
                ."themselves. For this reason, we have not given you the details of this 'Gatekeeper', "
                ."but rather have asked them to contact you for more information about "
                .$row['ReturneeAlias'].".<br/><br/>\n\n"
                ."We would ask that you keep this email so that when you are contacted by someone you "
                ."can click the appropriate link below, so both you and the system can keep track of "
                ."the progress of this referral. If you do not hear from anyone in a few days or, if "
                ."after you have been in touch it is clear that they will not be able to assist you, "
                ."then you may use one of the other links below to trigger a new referral request.<br/><br/>\n\n"
                ."Your friend's details can remain in the system where you can manage them, and then in "
                ."future will be able to return to the ".$this->websiteName." website and track the progress "
                ."updated by the Gatekeeper for the contact in the home country. We ask only that when you "
                ."hear from ".$row['ReturneeAlias'].", that they have been contacted, that you click the "
                ."last of the links so that the system knows that the referral is complete.<br/><br/>\n\n";
//            $emailtext .="<b color='red'>PLEASE NOTE: <br/>\n"
//                ."There are some clickable links below, that allow you to update the "
//            ."online system directly from this email. However, in order for them "
//            ."to work, you will need to be connected to the Internet when "
//            ."you click them. So please do not assume they have worked unless "
//            ."you actually see them launch an internet browser and access a web page."
//            ."</b><br/><br/>\n\n ";
// Prepare Clicklink Code for Email
            $data['ClickLinkEmail'] = $row['SEmail'];
            $data['ClickLinkModel'] = 'referral';
            $data['ClickLinkModelID'] = $row['ReferralID'];
            $data['ClickLinkModelFn'] = 'Insert';
            $data['ClickLinkCLValue'] = 'Acknowledged';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Acknowledged')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ Acknowledged ]</a> My referral request has been acknowledged, someone has contacted me.</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Concerned';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Concerned')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ CONCERNED ]</a> I am concerned about the process or the person who contacted me.</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Contacted';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Contacted')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ CONTACTED ]</a> My friend has confirmed that they have been contacted by someone where they are.</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'New Referral';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'NewReferral')";
            //$data['ClickLinkCLAction'] = "$"."data['ReturneeID'] = '".$row['ReturneeID']."'; "
            //        ."ReferralCheck($data);";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ NEW REFERRAL ]</a> I have not been contacted, or contact was declined, please start a new referral.</b><br/><br/>\n\n"
                ."Please keep this email so that you will be able to use the other links above as contact progresses. "
                ."If you have any difficulty using the above links or this this the first time "
                ."you have used this system and would like advise, then you may email us at "
                .$this->websiteEmail." and someone will be in touch.<br/><br/>\n\n"
                ."Your feedback back on this process would be very much appreciated.<br/><br/>\n\n"
                ."Best regards,<br/><br/>\n\n" 
                .$this->websiteAdmin."<br/><br/>\n\n".$this->websiteName."\n";
            $this->email->message($emailtext);
            if($this->email->send()){
                $data['NextPage'] = 'c2p/emailsent';
                $data['Message'] = "An email has been sent to a possible contact.";
            }else{
                $data['Message'] = "ERROR: Email was not sent.";
                $data['EmailError'] = $this->email->print_debugger();
            }
        } else {
            $data['Message'] = "ERROR: Unable to prepare email.";
        }
        $data['NextPage'] = 'sponsor/myreturnees';
        return($data);
    }
    public function CityWatchReferral($data){
        $sql = "SELECT S.FirstName as SFirstName, S.LastName as SLastName, "
            ."S.Email as SEmail,  S.Mobile as SMobile, "
            ."G.FirstName as GFirstName, G.LastName as GLastName, G.Email as GEmail,"
            ."R.ReturneeAlias, R.Country, R.Province, R.City, R.District, R.Details, "
            ."R.ReturnMonth, R.ReturnYear, "
            ."F.ReferralID, F.ReturneeID, F.CityWatchID "
            ."FROM members S, returnees R, members G, referrals F "
            ."WHERE F.Status = 'CityWatch' "
            ."AND G.MemberID = F.GatekeeperID "
            ."AND S.MemberID = F.SponsorID "
            ."AND R.ReturneeID = F.ReturneeID "    
            ."AND F.CityWatchID = ? "
            ."AND F.ReturneeID = ? ";
        $query = $this->db->query($sql, array($data['CityWatchID'],$data['ReturneeID']));
        $row = $query->row_array();
        if($row){
            // Send Email
            $config['protocol'] = 'sendmail';
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->to($row['GEmail']);
            $this->email->bcc($this->websiteEmail,$this->websiteAdmin);
            $this->email->from($this->websiteEmail,$this->websiteAdmin);
            $this->email->reply_to($row['SEmail']);
            $this->email->subject("Connecting2People ".$row['City']." Watch - Returnee "
                .$row['ReturneeAlias']); 
            $emailtext = "Dear ".$row['GFirstName'].",<br/><br/>\n\n" 
                ."You have asked to be copied in on all referrals to ".$row['City']
                ." and we have received a request for a contact in that location. "
                ."Another Gatekeepter has already been asked to contact the sponsor, "
                ."but as a CityWatch Gatekeeper associated with this location you have "
                ."also been included as a possible referral contact. If you choose to "
                ."contact the Sponsor, please make them aware of the role you are playing "
                ."and that they should also receive contact from someone possibly with a "
                ."closer contact. <br/><br/>\n\n"
                ."The person making this request is known to other users of this web service "
                ."and therefore should understand the security implications of passing the "
                ."details of the returnee they they know to you, as well as the need to "
                ."protect your contact's security. <br/><br/>\n\n"
                ."The details of the returnee and their sponsor are below. They have not been given any "
                ."information about you or your contact, so the initiative to make "
                ."referral has been left to you.<br/>\n<br/>\n"
                ."<b>RETURNEE: </b>".$row['ReturneeAlias']." returning to;<br/>\n"
                ."Country: ".$row['Country']."<br/>\n"
                ."Province: ".$row['Province']."<br/>\n"
                ."City: ".$row['City']."<br/>\n"
                ."District: ".$row['District']."<br/>\n"
                ."Expected return month: ".$row['ReturnMonth']." ".$row['ReturnYear']."<br/>\n"    
                ."Other information given:  ".$row['Details']."<br/>\n<br/>\n"
                ."<b>SPONSOR</b>: ".$row['SFirstName']." ".$row['SLastName']."<br/>\n"
                ."Email: ".$row['SEmail']."<br/>\n"
                ."Phone: ".$row['SMobile']."<br/>\n<br/>\n"
                ."In order to make it easier for you to contact the person above, "
                ."you need only reply to this email and as the sponsor's email has been added for you.<br/>\n"
                ."When you have considered whether you can help please click the appropriate link(s) below.<br/><br/>\n\n ";
//            $emailtext .="<b color='red'>PLEASE NOTE: <br/>\n"
//                ."There are some clickable links below, that allow you to update the "
//                ."online system directly from this email. However, in order for them "
//                ."to work, you will need to be connected to the Internet when "
//                ."you click them. So please do not assume they have worked unless "
//                ."you actually see them launch an internet browser and access a web page."
//                ."</b><br/><br/>\n\n ";
// Prepare Clicklink Code for Email
            $data['ClickLinkEmail'] = $row['GEmail'];
            $data['ClickLinkModel'] = 'referral';
            $data['ClickLinkModelID'] = $row['ReferralID'];
            $data['ClickLinkModelFn'] = 'Insert';
            $data['ClickLinkCLValue'] = 'Responded';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, CityWatchID,Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['CityWatchID'].",'Responded')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ RESPONDED ]</a> I have responded to the sponsor of the returnee.</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Concerned';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, CityWatchID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['CityWatchID'].",'Concerned')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ CONCERNED ]</a> I have concerns about the identity of the returnee or their sponsor. </b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Declined';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, CityWatchID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['CityWatchID'].",'Declined')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ DECLINED ]</a> I have declined to help on this occasion. </b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Accepted';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, CityWatchID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['CityWatchID'].",'Accepted')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ ACCEPTED ]</a> I have agreed to connect the returnee with one of my contacts.</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Connected';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, CityWatchID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['CityWatchID'].",'Connected')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ CONNECTED ]</a> I have provided my contact with details of the person retuning to their location.</b><br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkCLValue'] = 'Confirmed';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, CityWatchID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['CityWatchID'].",'Confirmed')";
            $data = $this->Clicklink_model->Create($data);
            // Write link into email            
            $emailtext.="<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ CONFIRMED ]</a> I have received confirmation from my contact that they have contacted the returnee</b><br/><br/>\n\n"
                ."Please keep this email so that you will be able to use the other links above as contact progresses. "
                ."If you have any difficulty using the above links or this this the first time "
                ."you have been asked to refer a refurnee to one of you contacts and would like advise, then you may email us at "
                .$this->websiteEmail." and someone will be in touch.<br/><br/>\n\n"
                ."Your feedback back on this process would be very much appreciated.<br/><br/>\n\n"
                ."Best regards,<br/><br/>\n\n" 
                .$this->websiteAdmin."<br/><br/>\n\n".$this->websiteName."\n";
            $this->email->message($emailtext);
            if($this->email->send()){
                $data['NextPage'] = 'c2p/emailsent';
                $data['Message'] = "An email has been sent to a possible contact.";
            }else{
                $data['Message'] = "ERROR: Email was not sent.";
                $data['EmailError'] = $this->email->print_debugger();
            }
        } else {
            $data['Message'] = "ERROR: Unable to prepare email.";
        }        
        return($data);
    }
    
}