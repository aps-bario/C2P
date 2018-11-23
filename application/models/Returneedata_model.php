<?php
class ReturneeData_model extends CI_Model {
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
     * FeedbackSave()?      - Email Feedback to C2P Admin
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
        $this->load->model('Clicklink_model');
    }
/*
    public function SendReturneeForm($data){
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
            ."AND F.ReferralID = ? ";
        $query = $this->db->query($sql, array($data['ReferralID']));
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
            $emailtext = $this->Email_model->EmailHTMLHeader();
            // C2P message starts here
            $emailtext.= "Dear ".$row['SFirstName'].",<br/><br/>\n\n" 
                ."In order to process your referral request for ".$row['ReturneeAlias']." more quickly, "
                ."would you please complete the enclosed form and press the [ Send ] button. "
                ."The information that you provide will not be stored, but will be forwarded "
                ."in another email directly to the person who has a contact that can help. "
                ."Email tends to be unreliable in China, so if you can provide a WeChat ID "
                ."or Chinese mobile number that will make contact easier.<br/><br/>\n\n";         
            // Returnee Form
            $data['ClickLinkEmail'] = $row['SEmail'];
            $data['ClickLinkModel'] = 'email';
            $data['ClickLinkModelID'] = $data['ReferralID'];
            $data['ClickLinkModelFn'] = 'ReturneeData';
            $data['ClickLinkCLValue'] = 'Returnee Form';
            $data['ClickLinkCLSQL'] = "INSERT INTO referralprogress "
                ."(ReferralID, ReturneeID, PlaceID, Status) VALUES "
                ."(".$row['ReferralID'].",".$row['ReturneeID'].",".$row['PlaceID'].",'Returnee Form')";
            //$data['ClickLinkCLAction'] = "$"."data['ReturneeID'] = '".$row['ReturneeID']."'; "
            //        ."ReferralCheck($data);";
            $data = $this->Clicklink_model->Create($data);
            $data['WebsiteURL'] = $this->websiteURL;
            $data=$this->Email_model->ReturneeForm($data);
            $emailtext.=$data['FormHTML'];
            // Continue Email
            $emailtext.="If for any reason the above form does not display well, "
                ."then you may click the following link to complete the form on-line.<br/><br/>\n\n"
                . "<b><a href='".$this->websiteURL."clicklink/".$data['ClicklinkCLCode']."'>"
                ."[ ON-LINE FORM ]</a></b>.<br/><br/>\n\n"
                ."Once you have submitted this form, and seen online that it has been processed, "
                ."you should hear from an the Gatekeeper fairly quickly. <br/><br/>\n\n";
            // Prepare Clicklink Code for Email
            $data['ClickLinkEmail'] = $row['SEmail'];
            $data['ClickLinkModel'] = 'referral';
            $data['ClickLinkModelID'] = $data['ReferralID'];
            $data['ClickLinkModelFn'] = 'Insert';
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
                .$this->websiteEmail." and someone will be in touch.<br/><br/>\n\n";
            $emailtext.="Your feedback back on this process would be very much appreciated.<br/><br/>\n\n"
                ."Best regards,<br/><br/>\n\n" 
                .$this->websiteAdmin."<br/><br/>\n\n".$this->websiteName."\n";
            // Apple Mail HTML Footer   
            $emailtext.=$this->Email_model->EmailHTMLFooter();
            $this->email->message($emailtext);
            if($this->email->send()){
                //$data['NextPage'] = 'c2p/emailsent';
                $data['Message'] = "Returnee Data Form has been emailed to the Sponsor.";
            }else{
                $data['Message'] = "ERROR: Email was not sent.";
                $data['EmailError'] = $this->email->print_debugger();
            }
        } else {
            $data['Message'] = "ERROR: Unable to prepare email.";
        }
        $data['NextPage'] = 'c2p/emailsent';
        return($data);
    }
    public function ReturneeForm($data){
        // Returnee Form
        $data['FormHTML'].="<p><fieldset style=\"background-color:yellow; width:100px; "
            ."border-width:1px; box-shadow: 10px 10px 5px #888888;\">"
            ."<legend style=\"border-width:1px; border-color:#000; border-style:line;\"> RETURNEE FORM </legend>"
            ."<form name=\"Returnee Form\" action=\"".$data['WebsiteURL']."code/".$data['ClicklinkCLCode']."\" method=\"post\">"
            ."<table>"
            ."<!--<tr><td nowrap>Referral No</td><td><input name=\"ReferralNo\" type=\"text\" value=\""
            .$data['ReferralID']."\" readonly/></td></tr>-->"
            ."<tr><td nowrap>Chinese Name</td><td><input name=\"ChineseName\" type=\"text\"/></td></tr>"
            ."<tr><td nowrap>English Name</td><td><input name=\"EnglishName\" type=\"text\"/></td></tr>"
            ."<tr><td nowrap>WeChat ID</td><td><input name=\"WeChatID\" type=\"text\"/></td></tr>"
            ."<tr><td nowrap>China Mobile</td><td><input name=\"ChinaMobile\" type=\"text\"/></td></tr>"
            ."<tr><td nowrap>China Email</td><td><input name=\"ChinaEmail\" type=\"text\"/></td></tr>"
            ."<tr><td nowrap>Is a Christian?</td><td><input name=\"Christian\" type=\"radio\" value=\"Yes\"> Yes &nbsp;"
            ."    <input name=\"Christian\" type=\"radio\" value=\"No\"> No </td></tr>"
            ."<tr><td nowrap>Is Baptised?</td><td><input name=\"Baptised\" type=\"radio\" value=\"Yes\"> Yes &nbsp;"
            ."    <input name=\"Baptised\" type=\"radio\" value=\"No\"> No </td></tr>"
            ."<tr><td nowrap>Submit Form</td><td align=\"right\">"
            ."<input name=\"Submit\" type=\"submit\" value=\" SEND \" onClick=\"this.form.submit();\"/></td></tr>"
            ."</table></form></fieldset></p><br/><br/>\n\n";
        return($data);
    }
    public function ReturneeData($data){
        // Returnee Data
        $data['FormHTML'].="<p><fieldset style=\"background-color:yellow; width:100px; "
            ."border-width:1px; box-shadow: 10px 10px 5px #888888;\">"
            ."<legend style=\"border-width:1px; border-color:#000; border-style:line;\"> RETURNEE DATA </legend>"
            ."<form name=\"Returnee Data\" >"
            ."<table>"
            ."<tr><th colspan=2>RETURNEE DATA</th></tr>"
            ."<!--<tr><td nowrap>Referral No</td><td><input name=\"ReferralNo\" type=\"text\" "
            ."value=\"".$data['ReferralID']."\" readonly/></td></tr>-->"
            ."<tr><td nowrap>Returnee Alias</td><td><input name=\"ChineseName\" type=\"text\" "
            ."value=\"".$row['ReturneeAlias']."\" readonly /></td></tr>"
            ."<tr><td nowrap>Chinese Name</td><td><input name=\"ChineseName\" type=\"text\" "
            ."value=\"".$row['ChineseName']."\" readonly /></td></tr>"
            ."<tr><td nowrap>English Name</td><td><input name=\"EnglishName\" type=\"text\" "
            ."value=\"".$row['EnglishName']."\" readonly /></td></tr>"
            ."<tr><td nowrap>WeChat ID</td><td><input name=\"WeChatID\" type=\"text\" "
            ."value=\"".$row['WeChatID']."\" readonly /></td></tr>"
            ."<tr><td nowrap>China Mobile</td><td><input name=\"ChinaMobile\" type=\"text\" "
            ."value=\"".$row['ChinaMibile']."\" readonly /></td></tr>"
            ."<tr><td nowrap>China Email</td><td><input name=\"ChinaEmail\" type=\"text\" "
            ."value=\"".$row['ChinaEmail']."\" readonly /></td></tr>"
            ."<tr><td nowrap>Is a Christian?</td>"
            ."<td><input name=\"Christian\" type=\"radio\" ".($data['Christian']=='Yes'?'checked':'')." readonly> Yes &nbsp;"
            ."    <input name=\"Christian\" type=\"radio\" ".($data['Christian']=='No'?'checked':'')." readonly> No </td></tr>"
            ."<tr><td nowrap>Is Baptised?</td>"
            ."<td><input name=\"Baptised\" type=\"radio\" ".($data['Baptised']=='Yes'?'checked':'')." readonly> Yes &nbsp;"
            ."    <input name=\"Baptised\" type=\"radio\" ".($data['Baptised']=='No'?'checked':'')." readonly> No </td></tr>"
            ."</table></form></fieldset></p><br/><br/>\n\n";
        return($data);
    }
    public function ForwardReturneeData($data){
        $data['Message'] = "ERROR: Unable to prepare email.";
        if(isset($data['ReferralID']) and $data['ReferralID'] != ''){
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
            ."AND F.ReferralID = ? "
            ."ORDER BY F.ReferralID DESC ";
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
            $this->email->reply_to($row['SEmail']);
            $this->email->subject("C2P Returnee Data for "
                .$row['ReturneeAlias']." returning to ".$row['City']); 
            $emailtext = $this->Email_model->EmailHTMLHeader();
            $emailtext.="Dear ".$row['GFirstName'].",<br/><br/>\n\n" 
                ."We have received an update from ".$row['SFirstName']." ".$row['SLastName'].", "
                ."who has completed a returnee form for ".$row['ReturneeAlias']." who is returning "
                ."to ".$row['Province'].", ".$row['District'].".<br/>\n<br/>\n";
            //Form Data
            $data = $this->Email_model->ReturneeData($data);
            $emailtext.=$data['FormHTML'];
            
            $emailtext.="In order to make it easier for you to contact the person above, "
                ."you need only reply to this email and as the sponsor's email has been added for you.<br/>\n"
                ."When you have considered whether you can help please click the appropriate link(s) below.<br/><br/>\n\n ";

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
            // Apple Mail HTML Footer   
            $emailtext.=$this->Email_model->EmailHTMLFooter();
            $this->email->message($emailtext);
//            $data['NextPage'] = 'sponsor/myreturnees';
            $data['NextPage'] = 'c2p/emailsent';
            if($this->email->send()){
                //$data['NextPage'] = 'c2p/emailsent';
                $data['Message'] = "Email has been Sent";
            }else{
                //$data['NextPage'] = 'c2p/emailsent';
                $data['Message'] = "ERROR: Email was not sent.";
                $data['EmailError'] = $this->email->print_debugger();
            }
        } else {
            //$data['NextPage'] = 'c2p/emailsent';
            $data['Message'] = "ERROR: Unable to prepare email.";
        }
        }
        $data['NextPage'] = 'c2p/emailsent';
        return($data);
    } 
 * */

}