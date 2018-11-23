<?php
class Admin_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('email');
 //     $data = array();
	}
 
   public function HelperList($data){
      $sql = "SELECT * FROM hosts WHERE NOT HostStatus = 'Host' ";
      $query = $this->db->query($sql);
      $hosts = $query->result_array();
      $data['hosts'] = array();
      $data['hosts'] = $hosts;
      return($data);
   }

   public function GetReference($data){
      $data['HostID'] = (isset($_POST['HostID'])?$_POST['HostID']:0);
      $data['ListOrder'] = (isset($_POST['ListOrder'])?$_POST['ListOrder']:'LastName,FirstName');
      $sql = "SELECT * FROM hosts where HostID = ? ORDER BY ? ";
      //echo var_dump($data);
      $query = $this->db->query($sql,array($data['HostID'],$data['ListOrder']));
      $row = $query->row_array();
      $heshe = ($row['Gender']=='M'?'he':'she');
      $config['protocol'] = 'sendmail';
      $config['mailtype'] = 'html';
      $this->email->initialize();
      $this->email->clear();
      $this->email->to($row['LeaderEmail']);
      $this->email->cc($row['HostEmail']);
      $this->email->bcc('admin@cwisw.org.uk','Admin');
      $this->email->from('admin@cwisw.org.uk','Admin');
      $this->email->reply_to('admin@cwisw.org.uk');
      $this->email->subject("Request for CWISW hosting reference."); 
      $emailtext = "Dear ".$row['ChurchLeader'].",\n\n" 
         ."Jesus said, ‘I was hungry and you gave me something "
         ."to eat, I was thirsty and you gave me something to drink, I was a stranger "
         ."and you invited me in.’ (Matthew 25:35;).\n\n"
         .$row['FirstName']." ".$row['LastName']." has informed us that "
         .$heshe." is a member of your church, has asked to join the "
         ."‘Coventry & Warwick International Student Welcome’ scheme as a host, "
         ."and given your name as someone who could provide a reference. \n\n"
         ."CWISW is a web-based organisation which seeks to link students looking "
         ."for hospitality, with members of churches in Coventry and Warwickshire "
         ."who want to engage in the Christian ministry of welcome.  Take a look "
         ."at our website (www.cwisw.org.uk), and please do promote it to students "
         ."and potential hosts within your church.\n\n"
         ."In order to protect the students who are looking for hospitality, "
         ."we ask for their church minister’s contact details so we can obtain "
         ."a reference of their good standing within that church.  Obviously we "
         ."are particularly keen to know that there are no suspicions of "
         ."impropriety/criminality.  We would want to know that the prospective "
         ."host has been a regular church member for at least a year, and involved "
         ."in the life of the church without any problems. \n\n" 
         ."This person is currently registered with CWISW as a ‘helper’. "
         ."When we receive a satisfactory reference, their status on the website "
         ."will change from ‘Helper’ to ‘Host’.  Only hosts can offer events and "
         ."receive students into their homes.  Helpers can attend hospitality "
         ."events as guests (but would also aim to help the host).\n\n"
         ."If you forward this e-mail for someone else to complete, please copy "
         ."us in so we know from whom to expect a reply. \n\n"
         ."Thank you for your help in this ministry,\n\n"
         ."CWISW Admin\n\n\n\n";
      $emailtext.="\n\n"
         ."Please ‘reply to sender’ of this e-mail (admin@cwisw.org.uk) with the "
         ."following completed:\n\n"
         ."Re: ".$row['FirstName']." ".$row['LastName']."\n\n"
         ."By returning this e-mail, I certify that this person is known to me, " 
         ."has been a member of my church for more than a year, and there is no "
         ."concern regarding their Christian character, nor any suspicion of "
         ."impropriety or criminal behaviour.  I have no reservation in recommending "
         ."them to act as a host for international students. \n\n"
         ."Any remarks about suitability, types of student they might be best "
         ."suited to host, etc: ";

      $this->email->message($emailtext);
      try {
         $this->email->send();
         // mail($to, $subject, $emailtext, implode("\r\n", $headers));
         $sql = "UPDATE hosts SET HostStatus = 'Pending' "
            ."WHERE HostID = ? ";
         $this->db->query($sql,array($data['HostID']));
      } catch (PDOException $e) {
         echo $this->email->print_debugger();
         echo 'Failed to send email: '.$e->getMessage();
      }
      return($data);
   }
   
   public function ApproveHost($data){
      $data['HostID'] = (isset($_POST['HostID'])?$_POST['HostID']:0);
      $sql = "UPDATE hosts SET HostStatus = 'Host', HostSetBy = ?, "
         ."HostSetOn = '".date('Y-m-d',strtotime('today')) ."' "
         ."WHERE HostID = ? AND HostStatus = 'Pending' ";
      //echo var_dump($data);
      $this->db->query($sql,array($data['FirstName'],$data['HostID']));
      // Update Users Table
      $sql = "UPDATE users U, hosts H SET U.Status = 'Host' "
         ."WHERE U.Email = H.HostEmail AND H.HostID = ?  ";
      //echo var_dump($data);
      $this->db->query($sql,array($data['HostID']));
      return($data);
   }  
   
   public function InviteRequest($data){
      $data['RequestID'] = (isset($_POST['RequestID'])?$_POST['RequestID']:0);
      $data['GuestID'] = (isset($_POST['GuestID'])?$_POST['GuestID']:0);
      $data['EventID'] = (isset($_POST['EventID'])?$_POST['EventID']:0);
      $sql = "SELECT * FROM invites "
         ."WHERE EventID = ".$data['EventID']." "
         ."AND NOT InviteStatus = 'Unselected' "
         ."AND RequestID = ".$data['RequestID']." ";
      $query = $this->db->query($sql);
      $result = $query->result_array();
      if($result){
         $sql = "UPDATE invites SET InviteStatus = 'Unselected', Updated = now() "
            ."WHERE RequestID = ".$data['RequestID']." AND EventID = ".$data['EventID']." ";
      } else {
         $sql = "INSERT INTO invites (GuestID, RequestID, EventID, HostID, InviteStatus, Created) "
            ."SELECT R.GuestID, R.RequestID, E.EventID, H.HostID, 'Selected',now() "
            ."FROM events E, hosts H, requests R "
            ."WHERE (E.HostID = H.HostID OR E.HostEmail = H.HostEmail) "
            ."AND E.EventID = ".$data['EventID']." "
            ."AND R.RequestID = ".$data['RequestID']." ";
      }
      $this->db->query($sql);
      //echo $sql;
      return($data);
   }
     
   public function InviteGuest($data){
      $data = $this->EventFilter($data);
      $data['UninvitedID'] = (isset($_POST['UninvitedID'])?$_POST['UninvitedID']:0);
      $data['EventID'] = (isset($_POST['EventID'])?$_POST['EventID']:0);
      $sql = "SELECT * FROM invites "
         ."WHERE EventID = ".$data['EventID']." "
         ."AND InviteStatus IN ('Invited','Selected') "
         ."AND GuestID = ".$data['UninvitedID']." ";
      $query = $this->db->query($sql);
      $result = $query->result_array();
      if($result){
         $sql = "UPDATE invites SET InviteStatus = 'Unselected', Updated = now() "
            ."WHERE GuestID = ".$data['UninvitedID']." AND EventID = ".$data['EventID']." ";
      } else {
         $sql = "INSERT INTO invites (GuestID, EventID, HostID, InviteStatus, Created) "
            ."SELECT ".$data['UninvitedID'].", E.EventID, H.HostID, 'Selected',now() "
            ."FROM events E, hosts H "
            ."WHERE (E.HostID = H.HostID OR E.HostEmail = H.HostEmail) "
            ."AND E.EventID = ".$data['EventID']." ";
      }
      $this->db->query($sql);
    //  echo $sql;
      return($data);
   }
   public function UninviteGuest($data){
      $data = $this->EventFilter($data);
      $data['InvitedID'] = (isset($_POST['InvitedID'])?$_POST['InvitedID']:0);
      $data['EventID'] = (isset($_POST['EventID'])?$_POST['EventID']:0);
      $sql = "UPDATE invites SET InviteStatus = 'Unselected', Updated = now() "
         ."WHERE GuestID=".$data['InvitedID']." AND EventID=".$data['EventID']." ";
      $this->db->query($sql);
     // echo $sql;
      return($data);
   }
   public function InviteSelected($data){
      $data['EventID'] = (isset($_POST['EventID'])?$_POST['EventID']:0);
      $data = $this->EventFilter($data);
      $sql = "SELECT E.EventID, E.EventTitle, E.EventDate, E.EventStart, E.EventFinish, "
         ."E.EventAddress, E.EventDetails, "
         ."G.GuestEmail, G.FirstName as GuestFirstName, G.LastName as GuestLastName, "
         ."GuestDetails, G.Mobile as GuestMobile, "
         ."H.HostEmail, H.Phone as HostPhone, H.Mobile as HostMobile, "
         ."H.FirstName as HostFirstName, H.LastName as HostLastName "
         ."FROM events E, invites I, guests G, hosts H "
         ."WHERE G.GuestID = I.GuestID "
         ."AND H.HostID = I.HostID "
         ."AND I.EventID = E.EventID "
         ."AND E.EventID = '".$data['EventID']."' "
         ."AND I.InviteStatus = 'Selected' ";

      
      $sql = "SELECT E.EventID, E.EventTitle, E.EventDate, E.EventStart, E.EventFinish, "
         ."E.EventAddress, E.EventDetails, G.PrefName as GuestPrefName,"
         ."G.GuestEmail, G.FirstName as GuestFirstName, G.LastName as GuestLastName, "
         ."G.GuestDetails, G.Mobile as GuestMobile, R.RequestDetails, "
         ."H.HostEmail, H.Phone as HostPhone, H.Mobile as HostMobile, "
         ."H.FirstName as HostFirstName, H.LastName as HostLastName "
         ."FROM ((( events E "     
         ."INNER JOIN hosts H ON (H.HostID = E.HostID OR H.HostEmail = E.HostEmail)) "
         ."INNER JOIN invites I ON I.EventID = E.EventID ) "     
         ."INNER JOIN guests G ON G.GuestID = I.GuestID ) "
         ."LEFT OUTER JOIN requests R ON R.RequestID = I.RequestID "
         ."WHERE E.EventID = ".$data['EventID']." "
         ."AND I.InviteStatus = 'Selected' ";     
              
//         ."FROM events E, hosts H, invites I, guests G, requests R "
//         ."WHERE G.GuestID = I.GuestID "
//         ."AND H.HostID = I.HostID "
//         ."AND I.EventID = E.EventID "
//         ."AND E.EventID = '".$data['EventID']."' "
//         ."AND I.InviteStatus = 'Selected' ";
      $query = $this->db->query($sql);
      $results = $query->result_array();
      foreach($results as $invite){
         $this->EmailInvite($invite);
      }
      $sql = "UPDATE invites SET InviteStatus = 'Invited', Updated = now() "
         ."WHERE InviteStatus = 'Selected' AND EventID=".$data['EventID']." ";
      $this->db->query($sql);
      $sql = "DELETE FROM invites "
         ."WHERE InviteStatus = 'Unselected' "
         ."AND EventID=".$data['EventID']." ";
      $this->db->query($sql);
      $sql = "UPDATE requests R, invites I "
         ."SET R.RequestStatus = 'Invited' "
         ."WHERE I.RequestID = R.RequestID "
         ."AND I.InviteStatus = 'Invited' "
         ."AND NOT R.RequestStatus = 'Invited' ";
      $this->db->query($sql);
     // echo $sql;
      return($data);
   }
   
   public function EmailInvite($invite){
      
      $this->email->initialize();
      // Email the Guest with the details of the event and the host
      $this->email->clear();
      $this->email->to($invite['GuestEmail']);
      $this->email->cc('admin@cwisw.org.uk');
      $this->email->from('admin@cwisw.org.uk','Admin');
      $this->email->reply_to('admin@cwisw.org.uk');
      $this->email->subject("Your invite to ".$invite['EventTitle']
              ." with ".$invite['HostFirstName']." ".$invite['HostLastName']); 
      $emailtext = "Dear ".$invite['GuestFirstName'].",\n\n" 
         ."You are invited to the following: \n\n"
         ."Event Name: ".$invite['EventTitle']."\n"
         ."Event Date: ".$invite['EventDate']."\n"
         ."Event Time: ".$invite['EventStart']." - ".$invite['EventFinish']."\n"
         ."Address: ".$invite['EventAddress']."\n\n"
         ."Details: ".$invite['EventDetails']."\n\n"
         ."Host Name : ".$invite['HostFirstName']." ".$invite['HostLastName']."\n"
         ."Host Email: ".$invite['HostEmail']."\n"
         ."Host Phone: ".$invite['HostPhone']."\n"
         ."Host Mobile: ".$invite['HostMobile']."\n\n"
         ."Your Host would appreciate confirmation that you will be attending,"
         ."either by email or phone. If for any reason that you find you are "
         ."unable to attend, please also let your host know in good time. You "
         ."can also update the status of your attendance at this event and other "
         ."on line at www.cwisw.org.uk \n\n"
         ."Best regards,\n\n" 
         ."CWISW Admin\n\n"
         ."Coventry & Warwick International Student Welcome\n\n";
      $this->email->message($emailtext);
      $this->email->send();
      // Email the Host with details of the Guest Invited
      //$this->email->initialize();
      $this->email->clear();
      $this->email->to($invite['HostEmail']);
      $this->email->cc('admin@cwisw.org.uk');
      $this->email->from('admin@cwisw.org.uk','Admin');
      $this->email->reply_to('admin@cwisw.org.uk');
      $this->email->subject($invite['GuestFirstName']." ".$invite['GuestLastName']
         ." invited to ".$invite['EventTitle']); 
      $emailtext = "Dear ".$invite['HostFirstName'].",\n\n" 
         ."You advertised the following event with CWISW: \n\n"
         ."Event Name: ".$invite['EventTitle']."\n"
         ."Event Date: ".$invite['EventDate']."\n"
         ."Event Time: ".$invite['EventStart']." - ".$invite['EventFinish']."\n"
         ."Address: ".$invite['EventAddress']."\n\n"
         ."Details: ".$invite['EventDetails']."\n\n"
         ."The following guest has been matched and invited to your event:\n\n"
         ."Guest Name : ".$invite['GuestFirstName']." ".$invite['GuestLastName']." "
         ." (".$invite['GuestPrefName'].")\n"
         ."Guest Email: ".$invite['GuestEmail']."\n"
         ."Guest Mobile: ".$invite['GuestMobile']."\n\n"
         ."Guest Details: ".$invite['GuestDetails']."\n\n"
         ."Request Details: ".$invite['RequestDetails']."\n\n"
         ."Your Guest has been asked to confirm with you that they are attending,"
         ."either by email or phone. If for any reason you have to cancel your event, "
         ."please make sure this student is notified and you also email admin@cwisw.org.uk \n\n"
         ."You can also monitor or change the status of your event on-line at www.cwisw.org.uk \n\n"
         ."When would very much appreciate hearing from you after your event has taken place, "
         ."particularly which students attended and how you feel the occasion went.\n\n"
         ."Best regards,\n\n" 
         ."CWISW Admin\n\n"
         ."Coventry & Warwick International Student Welcome\n\n";
      $this->email->message($emailtext);
      $this->email->send();

      // echo $this->email->print_debugger();
      $return = TRUE;
      return($return);
   }
      
   public function EventFilter($data){
      $data['When']=(isset($_POST['When'])?$_POST['When']:'');
      $data['Type']=(isset($_POST['Type'])?$_POST['Type']:'');
      $data['Size']=(isset($_POST['Size'])?$_POST['Size']:'');
      $data['Status']=(isset($_POST['Status'])?$_POST['Status']:'');
      $data['Spaces']=(isset($_POST['Spaces'])?$_POST['Spaces']:'');
      return($data);
   }
   
   public function InviteLists($data){
      // Get a list of all matching events
      $data = $this->EventFilter($data);
      $sql = "SELECT E.*, H.FirstName, H.LastName, "
         ."IF(ISNULL(I.Guests),0,I.Guests) Guests "
         ."FROM (events E "
         ."INNER JOIN hosts H ON (H.HostID = E.HostID OR H.HostEmail = E.HostEmail))"
         ."LEFT OUTER JOIN (SELECT EventID, Count(1) Guests FROM invites "
         ."WHERE NOT InviteStatus = 'Unselected' "
         ."GROUP BY EventID) I ON E.EventID = I.EventID "
         ."WHERE TRUE ";
      switch ($data['When']){
         case 'Past':
            $sql.="AND EventDate < '".date('Y-m-d',strtotime('today')) ."' ";
            break;
         case 'Today':
            $sql.="AND EventDate = '".date('Y-m-d',strtotime('today')) ."' ";
            break;
         case '1Week':
            $sql.="AND EventDate < '".date('Y-m-d',strtotime('+1 week')) ."' "
                 ."AND EventDate >= '".date('Y-m-d',strtotime('today')) ."' ";
            break;
         case '1Month':
            $sql.="AND EventDate < '".date('Y-m-d',strtotime('+1 month')) ."' "
                 ."AND EventDate >= '".date('Y-m-d',strtotime('today')) ."' ";
            break;
      }
      if(!$data['Type']=='') {
         $sql.="AND EventType = '".$data['Type']."' ";
      }
      if(!$data['Size']=='') {
         $sql.="AND EventSize = '".$data['Size']."' ";
      }
      if(!$data['Status']=='') {
         $sql.="AND EventStatus = '".$data['Status']."' ";
      } else {
         $sql.="AND NOT EventStatus = 'Deleted' "
            ."AND NOT EventStatus = 'Cancelled' ";
      }

      switch ($data['Spaces']){
         case 'Spaces':
            $sql.="AND IF(ISNULL(I.Guests),0,I.Guests) < EventMax ";
            break;
         case 'Empty':
            $sql.="AND IF(ISNULL(I.Guests),0,I.Guests) = 0 ";
            break;
         case 'Full':
            $sql.="AND IF(ISNULL(I.Guests),0,I.Guests) = EventMax ";
            break;
         case 'TooMany':
            $sql.="AND IF(ISNULL(I.Guests),0,I.Guests) > EventMax ";
            break;
      }
      $sql.="ORDER BY E.EventID ";
      $query = $this->db->query($sql);
      $events = $query->result_array();
      $data['events'] = $events;
      
      // Get details of selected event
      $data['EventID'] = (isset($_POST['EventID'])?$_POST['EventID']:'');
      // echo var_dump($data);
      if(!$data['EventID']==''){
         $sql = "SELECT * FROM events WHERE EventID = ? ";
         $query = $this->db->query($sql, array($data['EventID']));
         $row = $query->row_array();
         if($row){
            foreach($row as $field=>$value){
               $data[$field] = $value;
            }
         }
         // Get the gender of the Host
         $sql = "SELECT H.Gender FROM hosts H, events E "
            ."WHERE (H.HostID = E.HostID OR H.HostEmail = E.HostEmail) "
            ."AND E.EventID = ? ";
         $query = $this->db->query($sql, array($data['EventID']));
         $row = $query->row_array();
         if($row){
            $HostGender = $row['Gender'];
         }    
         //echo var_dump($sql);
         //echo var_dump($HostGender);
         // Get details of guest REQUESTS that who match event 
         // but are not invited to any other event in the same day
         $sql = "SELECT G.*, R.*, IF(ISNULL(I.Invites),0,I.Invites) Invites "
            ."FROM (requests R "
            ."INNER JOIN guests G ON G.GuestID = R.GuestID) "     
            ."LEFT OUTER JOIN (SELECT GuestID, Count(1) Invites FROM invites "
            ."WHERE NOT InviteStatus = 'Unselected' "
            ."GROUP BY GuestID) I ON G.GuestID = I.GuestID "
            ."WHERE NOT G.GuestID IN ("
            ."    SELECT I.GuestID "
            ."    FROM invites I, events E, events F "
            ."    WHERE I.EventID = E.EventID " 
            ."    AND I.InviteStatus <> 'Unselected' "
            ."    AND E.EventDate = F.EventDate "
            ."    AND F.EventID = ? "
            .") "
            ."AND R.RequestType = ? "
            ."AND (R.RequestStatus = 'Request' OR R.RequestStatus = 'Pending') "; 
         // Check Guests meet Event Limitations
         //if($data['OnlyOne']==1){ $sql.="AND G.OnlyOne=1 "; }
         if($data['SameSex']==1){ $sql.="AND G.Gender='$HostGender' ";}
         //if(!$data['Vegetarian']==0){ $sql.="AND R.Vegetarian!=1 ";}        
         //if(!$data['Kids']==0){ $sql.="AND R.Kids!=1 ";}        
         //if(!$data['Pets']==1){ $sql.="AND R.Pets!=1 ";}        
         //if(!$data['Smoker']==0){ $sql.="AND R.Smoker!=1 ";}          
         $sql.="ORDER BY G.LastName, G.FirstName ";
         $query = $this->db->query($sql, array($data['EventID'],$data['EventType']));
         $requested = $query->result_array();
         if($requested){
            $data['requested'] = $requested;
         }
         
         // Get details of guests who match event 
         // but are not invited to any other event in the same day
         $sql = "SELECT G.*, IF(ISNULL(I.Invites),0,I.Invites) Invites "
            ."FROM guests G "
            ."LEFT OUTER JOIN ("
            ."    SELECT GuestID, Count(1) Invites FROM invites "
            ."    WHERE NOT InviteStatus = 'Unselected' "
            ."    GROUP BY GuestID) I ON G.GuestID = I.GuestID "
            ."WHERE NOT G.GuestID IN ("
            ."    SELECT I.GuestID "
            ."    FROM invites I, events E, events F "
            ."    WHERE I.EventID = E.EventID " 
            ."    AND I.InviteStatus <> 'Unselected' "
            ."    AND E.EventDate = F.EventDate "
            ."    AND F.EventID = ? "
            .") "
            ."AND NOT G.GuestStatus = 'Deleted' "
            ."AND NOT G.GuestStatus = 'Expired' ";
         // Check Guests meet Event Limitations
         if($data['OnlyOne']==1){ $sql.="AND G.OnlyOne=1 "; }
         if($data['SameSex']==1){ $sql.="AND G.Gender='$HostGender' ";}
         if(!$data['Vegetarian']==0){ $sql.="AND G.Vegetarian!=1 ";}        
         if(!$data['Pets']==1){ $sql.="AND G.Pets!=1 ";}        
         if(!$data['Kids']==0){ $sql.="AND G.Kids!=1 ";}        
         if(!$data['Smoker']==0){ $sql.="AND G.Smoker!=1 ";}                       
         $sql.="ORDER BY G.LastName, G.FirstName ";
         //$sql.="ORDER BY I.Invites ";
         $query = $this->db->query($sql, array($data['EventID']));
         $uninvited = $query->result_array();
         if($uninvited){
            $data['uninvited'] = $uninvited;
         }
         // Get details of guests already invited to this event
         $sql = "SELECT * FROM guests G, invites I "
            ."WHERE G.GuestID = I.GuestID AND I.InviteStatus <> 'Unselected' "
            ."AND I.EventID = ? ";
         $sql.="ORDER BY G.LastName, G.FirstName ";
         $query = $this->db->query($sql, array($data['EventID']));
         $data['GuestCount'] = $query->num_rows();
         $query = $this->db->query($sql, array($data['EventID']));
         $invited = $query->result_array();
         if($invited){
            $data['invited'] = $invited;
         }   
      }
 //   echo var_dump($data);
      return($data);
   }
   public function GetProfile($data){    
      // Following Code removed as it was losing the HostEmail
      //$data['HostEmail'] = (isset($_POST['HostEmail'])?$_POST['HostEmail']:'');
      // A Host may only update the profile for their own email address
      //if($data['UserStatus']=='Host' and !$data['UserEmail']==''){
      //   $data['HostEmail'] = $data['UserEmail'];
      //}
      $sql = "SELECT * FROM hosts WHERE HostEmail = ? ";
      $query = $this->db->query($sql, array(strtolower($data['HostEmail'])));
      $row = $query->row_array();
      if($row){
         foreach($row as $field=>$value){
            $data[$field] = $value;
         }
      }
   //   echo var_dump($data);
      return($data);
   }
   
   public function SetChurch($data){
      $data['ChurchID'] = (isset($_POST['ChurchID'])?$_POST['ChurchID']:0);
      $data['ChurchName'] = (isset($_POST['ChurchName'])?$_POST['ChurchName']:'');
      $data['ChurchArea'] = (isset($_POST['ChurchArea'])?$_POST['ChurchArea']:'');
      $data['ChurchLeader'] = (isset($_POST['ChurchLeader'])?$_POST['ChurchLeader']:'');
      $data['LeaderEmail'] = (isset($_POST['LeaderEmail'])?$_POST['LeaderEmail']:'');
      $data['LeaderPhone'] = (isset($_POST['LeaderPhone'])?$_POST['LeaderPhone']:'');
      return($data);
   }
   
   public function GetChurch($data){
      $data['ChurchID'] = (isset($_POST['ChurchID'])?$_POST['ChurchID']:0);
      $sql = "SELECT * FROM hostchurches WHERE ChurchID = ? ";
      $query = $this->db->query($sql,array($data['ChurchID']));
      $row = $query->row_array();
      if($row){
         foreach($row as $field=>$value){
            $data[$field] = $value;
         }
      }
      //echo var_dump($data);
      return($data);
   }
   
   public function GetChurches($data){
      $data['ListOrder'] = (isset($_POST['ListOrder'])?$_POST['ListOrder']:'ChurchName');
      $sql = "SELECT ChurchID, ChurchName, ChurchArea, ChurchLeader, "
         ."LeaderPhone, LeaderEmail FROM hostchurches "
         ."ORDER BY ? "; 
      $query = $this->db->query($sql,array($data['ListOrder']));
      $data['Churches'] = $query->result_array();
//      $churches = array();
//      if ($query->num_rows() > 0){
//         foreach ($query->result_array() as $row){
//           // $churches[$row['ChurchName']] = $row;
//             $churches[] = $row;
//         }
//      }
//      $data['Churches'] = $churches;
      //echo var_dump($churches);
      return($data);
   }

   public function SaveChurch($data){
      $data['ChurchID'] = (isset($_POST['ChurchID'])?$_POST['ChurchID']:0);
      $sql = "SELECT 1 FROM hostchurches WHERE ChurchID = ? ";
      $query = $this->db->query($sql, array($data['ChurchID']));
      $row = $query->row_array();
      if($row){
         // Update the existing record
         $sql = "UPDATE hostchurches SET "
            ."ChurchName = '".$data['ChurchName']."', "
            ."ChurchArea = '".$data['ChurchArea']."', "
            ."ChurchLeader = '".$data['ChurchLeader']."', "
            ."LeaderEmail = '".strtolower($data['LeaderEmail'])."', "
            ."LeaderPhone = '".$data['LeaderPhone']."', "
            ."Updated = '".date('Y-m-d H:i:s')."' " 
            ."WHERE ChurchID = '".$data['ChurchID']."' ";
      } else {   
         // Insert a new record
         $sql = "INSERT INTO hostchurches ("  
            ."ChurchName, ChurchArea, ChurchLeader, "
            ."LeaderEmail, LeaderPhone "
            .") VALUES ("     
            ."'".$data['ChurchName']."',"
            ."'".$data['ChurchArea']."',"
            ."'".$data['ChurchLeader']."',"
            ."'".strtolower($data['LeaderEmail'])."',"
            ."'".$data['LeaderPhone']."'"
            .")";
      }
      $this->db->query($sql);
      return($data);
   }
   
   
   public function GetHost($data){
      $sql = "SELECT * FROM hosts WHERE HostID = ? ";
      $query = $this->db->query($sql,array($_POST['HostID']));
      $host = $query->row_array();
      foreach($host as $field=>$value){
         $data[$field] = $value;
      }
      return($data);
   }
   
   public function SaveHost($data){
      $sql = "SELECT 1 FROM hosts WHERE HostID = ? ";
      $query = $this->db->query($sql,array($_POST['HostID']));
      $row = $query->row_array();
      if($row){
         // Update the existing record
         $sql = "UPDATE hosts SET "
            ."HostEmail = '".strtolower($data['HostEmail'])."', "
            ."LastName = '".$data['LastName']."', "
            ."FirstName = '".$data['FirstName']."', "
            ."Title = '".$data['Title']."', "
            ."PrefName = '".$data['PrefName']."', "
            ."Marital = '".$data['Marital']."', "
            ."AgeRange = '".$data['AgeRange']."', "
            ."Address1 = '".$data['Address1']."', "
            ."Address2 = '".$data['Address2']."', "
            ."City = '".$data['City']."', "
            ."County = '".$data['County']."', "
            ."Postcode = '".$data['Postcode']."', "
            ."Phone = '".$data['Phone']."', "
            ."Mobile = '".$data['C2P_Mobile']."', "
            ."Kids = '".$data['Kids']."', "
            ."KidsDetails = '".$data['KidsDetails']."', "
            ."Pets = '".$data['Pets']."', "
            ."PetsDetails = '".$data['PetsDetails']."', "
            ."Host = '".$data['Host']."', "
            ."Experience = '".$data['Experience']."', "
            ."Car = '".$data['Car']."', "
            ."Transport = '".$data['Transport']."', "
            ."Countries = '".$data['Countries']."', "
            ."Languages = '".$data['Languages']."', "
            ."ChurchName = '".$data['ChurchName']."', "
            ."ChurchLeader = '".$data['ChurchLeader']."', "
            ."LeaderPhone = '".$data['LeaderPhone']."', "
            ."LeaderEmail = '".$data['LeaderEmail']."', "
            ."University = '".$data['University']."', "
            ."MaxGuests = '".$data['MaxGuests']."', "
            ."MaleOnly = '".$data['MaleOnly']."', "
            ."FemaleOnly = '".$data['FemaleOnly']."', "
            ."EitherSex = '".$data['EitherSex']."', "
            ."Smokers = '".$data['Smokers']."', "
            ."Singles = '".$data['Singles']."', "
            ."Couples = '".$data['Couples']."', "
            ."SmallGroup = '".$data['SmallGroup']."', "
            ."LargeGroup = '".$data['LargeGroup']."', "
            ."MixedSex = '".$data['MixedSex']."', "
            ."SameSex = '".$data['SameSex']."', "
            ."Families = '".$data['Families']."', "
            ."Children = '".$data['Children']."', "
            ."Meal = '".$data['Meal']."', "
            ."Christmas = '".$data['Christmas']."', "
            ."Easter = '".$data['Easter']."', "
            ."Party = '".$data['Party']."', "
            ."Walk = '".$data['Walk']."', "
            ."Trip = '".$data['Trip']."', "
            ."Weekend = '".$data['Weekend']."', "
            ."Mailing = '".$data['Mailing']."', "
            ."HostDetails = '".$data['HostDetails']."', "
            ."Updated = '".date('Y-m-d H:i:s')."' " 
            ."WHERE HostID = '".$data['HostID']."' ";
         $this->db->query($sql);
      } else {   
         // Insert a new record
         $sql = "INSERT INTO hosts ("  
            ."HostEmail, LastName, FirstName, Title, "
            ."PrefName, Marital, AgeRange, Address1, "
            ."Address2, City, County, Postcode, "
            ."Phone, Mobile, Kids, KidsDetails, "
            ."Pets, PetsDetails, Host, Experience, "
            ."Car, Transport, Countries, Languages, "
            ."ChurchName, ChurchLeader, LeaderPhone, LeaderEmail, "
            ."University, MaxGuests, "
            ."MaleOnly, FemaleOnly, EitherSex, Smokers, "     
            ."Singles, Couples, SmallGroup, LargeGroup, "
            ."MixedSex, SameSex, Families, Children, "
            ."Meal, Christmas, Easter, Party, "
            ."Walk, Trip, Weekend, Mailing, "
            ."HostDetails, Created "
            .") VALUES ("     
            ."'".strtolower($data['HostEmail'])."','".$data['LastName']."',"
            ."'".$data['FirstName']."','".$data['Title']."',"
            ."'".$data['PrefName']."','".$data['Marital']."',"
            ."'".$data['AgeRange']."','".$data['Address1']."',"
            ."'".$data['Address2']."','".$data['City']."',"
            ."'".$data['County']."','".$data['Postcode']."',"
            ."'".$data['Phone']."','".$data['C2P_Mobile']."',"
            ."".$data['Kids'].",'".$data['KidsDetails']."',"
            ."".$data['Pets'].",'".$data['PetsDetails']."',"
            ."".$data['Host'].",'".$data['Experience']."',"
            ."".$data['Car'].",'".$data['Transport']."',"
            ."'".$data['Countries']."','".$data['Languages']."',"
            ."'".$data['ChurchName']."','".$data['ChurchLeader']."',"
            ."'".$data['LeaderPhone']."','".$data['LeaderEmail']."',"
            ."'".$data['University']."','".$data['MaxGuests']."',"
            ."".$data['MaleOnly'].",".$data['FemaleOnly'].","
            ."".$data['EitherSex'].",".$data['Smokers'].","
            ."".$data['Singles'].",".$data['Couples'].","
            ."".$data['SmallGroup'].",".$data['LargeGroup'].","
            ."".$data['MixedSex'].",".$data['SameSex'].","
            ."".$data['Families'].",".$data['Children'].","
            ."".$data['Meal'].",".$data['Christmas'].","
            ."".$data['Easter'].",".$data['Party'].","
            ."".$data['Walk'].",".$data['Trip'].","
            ."".$data['Weekend'].",".$data['Mailing'].","
            ."'".$data['HostDetails']."','".date('Y-m-d H:i:s')."'"
            .")";
         $this->db->query($sql);
      }
      return($data);
   }   
   
   public function AdminTasks($data){
      $data['AdminTask'] = (isset($_POST['AdminTask'])?$_POST['AdminTask']:'');
      switch($data['AdminTask']):
         case 'Make All Dormant':
            $sql = "UPDATE guests SET GuestStatus = 'Dormant' "
               ."WHERE GuestStatus = 'Active' "; 
            $this->db->query($sql);
            break;
         case 'Request Updates':
            $sql = "SELECT E.EventID, E.EventTitle, E.EventDate, E.EventStart, E.EventFinish, "
               ."E.EventAddress, E.EventDetails, G.PrefName as GuestPrefName,"
               ."G.GuestEmail, G.FirstName as GuestFirstName, G.LastName as GuestLastName, "
               ."G.GuestDetails, G.Mobile as GuestMobile, R.RequestDetails, "
               ."H.HostEmail, H.Phone as HostPhone, H.Mobile as HostMobile, "
               ."H.FirstName as HostFirstName, H.LastName as HostLastName "
               ."FROM ((( events E "     
               ."INNER JOIN hosts H ON (H.HostID = E.HostID OR H.HostEmail = E.HostEmail)) "
               ."INNER JOIN invites I ON I.EventID = E.EventID ) "     
               ."INNER JOIN guests G ON G.GuestID = I.GuestID ) "
               ."LEFT OUTER JOIN requests R ON R.RequestID = I.RequestID "
               ."WHERE E.EventID = ".$data['EventID']." "
               ."AND I.InviteStatus = 'Selected' ";     
            $sql = "SELECT * FROM guests "
               ."WHERE GuestStatus = 'Test' ";
            $query = $this->db->query($sql);
            $results = $query->result_array();
            foreach($results as $profile){
               $this->EmailInvite($profile);
            }          
            break;
      endswitch;
      $sql = "SELECT * FROM hosts WHERE NOT HostStatus = 'Host' ";
      $query = $this->db->query($sql);
      $hosts = $query->result_array();
      $data['hosts'] = array();
      $data['hosts'] = $hosts;
      return($data);
   }
    
     public function UpdateRequest($profile){
      $this->email->initialize();
      // Email the Guest/Host and ask them to update their profile
      $this->email->clear();
      $this->email->to($profile['GuestEmail']);
      $this->email->cc('admin@cwisw.org.uk');
      $this->email->from('admin@cwisw.org.uk','Admin');
      $this->email->reply_to('admin@cwisw.org.uk');
      $this->email->subject("CWISW Profile Update Request"); 
      $emailtext = "Dear ".$profile['FirstName'].",\n\n" 
         ."CWISW - Coventry & Warwickshire International Student Welcome\n\n"
         ."We are preparing for start linking students, who have registered on "
         ."on our web-site, local hosts who have in willing to welcome them.\n\n"
         ."As you have previous been involved with this programme, we would like "
         ."check with you before assuming that you want be included this year. "
         ."It is also important that the information that you provided previous "
         ."is correct and up to date. We have therefore marked your account as "
         ."being Dormant until you have reviewed and re-submitted your profile.\n\n"
         ."If you no longer wish to be involved with this programme, then your "
         ."information will remain on file, but will not be used, so no action "
         ."from you is required.\n\n"
         ."HOWEVER, we hope that you do want to participate again this year, and "
         ."so would request that you return to the CWISW web-site by clicking the "
         ."link below, to review and re-submit your ".$profile['ProfileType']." "
         ."profile. While you are there you may also like to set-up a "
         .$profile['RequestType']." "
         ."for the coming year.\n\n"
              
              
         ."Event Name: ".$profile['EventTitle']."\n"
         ."Event Date: ".$profile['EventDate']."\n"
         ."Event Time: ".$profile['EventStart']." - ".$profile['EventFinish']."\n"
         ."Address: ".$profile['EventAddress']."\n\n"
         ."Details: ".$profile['EventDetails']."\n\n"
         ."Host Name : ".$profile['HostFirstName']." ".$profile['HostLastName']."\n"
         ."Host Email: ".$profile['HostEmail']."\n"
         ."Host Phone: ".$profile['HostPhone']."\n"
         ."Host Mobile: ".$profile['HostMobile']."\n\n"
         ."Your Host would appreciate confirmation that you will be attending,"
         ."either by email or phone. If for any reason that you find you are "
         ."unable to attend, please also let your host know in good time. You "
         ."can also update the status of your attendance at this event and other "
         ."on line at www.cwisw.org.uk \n\n"
         ."Best regards,\n\n" 
         ."CWISW Admin\n\n"
         ."Coventry & Warwick International Student Welcome\n\n";
      $this->email->message($emailtext);
      $this->email->send();
      // echo $this->email->print_debugger();
      $return = TRUE;
      return($return);
   }
 
}
  