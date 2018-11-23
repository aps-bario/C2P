<?php
class Login_model extends CI_Model {
    public function __construct(){
        parent::__construct();
	$this->load->database();
        $this->load->library('email');
        //$data = array();    
    }
    public function Logout($data){
        $this->session->set_userdata('UserStatus','');
        $data['UserStatus'] = '';
        $data['NextPage'] = 'c2p/login.php';
        return($data);
    }
   
    public function Login($data){
        $data['PageMode'] = 'Login';      
      $data['LoginMessage'] = 'Please login';
      if(!isset($data['UserEmail']) or $data['UserEmail'] ==''){
         $data['LoginMessage'] = 'Please enter your email address';
         return($data);
      }
      if(!isset($data['Password']) or $data['Password'] ==''){
         $data['LoginMessage'] = 'Please enter a password';
         return($data);
      }   
      $sql = "SELECT UserID, FirstName, LastName, Mobile, Status, Password, Reminder, Account, "
        ."MD5(?) AS Entered FROM users WHERE Email = ? ";
      $query = $this->db->query($sql, array($data['Password'], strtolower($data['UserEmail'])));
      $row = $query->row_array();
      if($row){
         if($row['Entered'] == $row['Password']){
            $this->session->set_userdata('UserID',$row['UserID']);
            $this->session->set_userdata('FirstName',$row['FirstName']);
            $this->session->set_userdata('LastName',$row['LastName']);
            $this->session->set_userdata('C2P_Mobile',$row['Mobile']);
            $this->session->set_userdata('UserStatus',$row['Status']);
            $this->session->set_userdata('Account',$row['Account']);
            $this->session->set_userdata('UserEmail',$data['UserEmail']);
            $data['UserID'] = $row['UserID'];
            $data['FirstName'] = $row['FirstName'];
            $data['LastName'] = $row['LastName'];
            $data['C2P_Mobile'] = $row['Mobile'];
            $data['UserStatus'] = $row['Status'];
            $data['Account'] = $row['Account'];
            /*
             * NOTE TO SELF
             * 
             * The redirection to other pages does not really work well from
             * here as it does not call the appropriate controllers, so either
             * a html redirect is needed, or a general landing page in the 
             * PUBLIC area.
             * 
             */
            if(isset($data['UserID'])){ 
               if($data['UserStatus'] == "Guest"){
                  $data['NextPage'] = "guest/guesthome.php";
               } elseif($data['UserStatus'] == "Helper"){
                  $data['NextPage'] = "helper/helperhome.php";
               } elseif($data['UserStatus'] == "Host"){
                  $data['NextPage'] = "host/hosthome.php";
               } elseif($data['UserStatus'] == "Admin"){
                  $data['NextPage'] = "admin/adminhome.php";
               }else {
                  $data['NextPage'] = "public/home.php";
               }
               $sql = "UPDATE users SET LastVisited = '".date('Y-m-d H:i:s')."' " 
                  ."WHERE Email = '".strtolower($data['UserEmail'])."'";
               $this->db->query($sql);
            }
         }else{
            $data['LoginMessage'] = 'Password Incorrect';
            $data['Reminder'] = $row["Reminder"];
         }
      }else{
         $data['UserEmail'] = '';
         $data['LoginMessage'] = 'User not registered';
      }
      return($data);
   }
   
   public function Newuser($data){
//      $data['UserID'] = '';
//      $data['UserStatus'] = '';
//      $data['FirstName'] = '';
      $data['PageMode'] = 'NewUser';
      return($data);
   }
 /*  
   public function Register($data){
      $data['NextPage'] = 'public/newuser';
      if($data['FirstName']=='' or $data['LastName']=='' 
         or $data['UserEmail']=='' or $data['Account']=='' 
         or $data['Password']=='' or $data['Confirm']==''
         or $data['Reminder']==''){
      $data['LoginMessage'] = 'Please complete all fields to register.';  
      }elseif(strpos($data["UserEmail"],"@") == 0 
         or strpos($data["UserEmail"],".") == 0 
         or strlen(trim($data["UserEmail"])) < 10){
         $data['LoginMessage'] = "Your email address does not appear to be valid";    
      }elseif($data["Password"] != $data["Confirm"]){ 
         $data['LoginMessage'] = "The passwords that you enter differ, please try again.";
      }else{
         $sql = "SELECT UserID, FirstName, Password, Status, Reminder, Account "
            ."FROM users WHERE Email = ? ";
         $query = $this->db->query($sql, array(strtolower($data['UserEmail'])));
         $row = $query->row_array();
         if($row){
            $data['PageMode'] = "Login";
            $data['LoginMessage'] = "User already registered - Please Login";
            if(strtoupper($row["Password"]) == strtoupper($data['Password'])){ 
               $data['UserID'] = $row["UserID"];
               $data['GiveName'] = $row["FirstName"];
               $data['UserStatus'] = $row["Status"];
            }else{
               $data['Reminder'] = $row["Reminder"];
               $data['LoginMessage'] = "User already registered - Please Login";
            }
         }else{
            $sql = "INSERT INTO users "  
               ."(FirstName,LastName,Email,Mobile,Password,Reminder,Status,Account) "
               ."VALUES "
               ."   ('".$data['FirstName']."', "
               ."'".$data['LastName']."', "
               ."'".trim(strtolower($data['UserEmail']))."', "
               ."'".$data['UserPhone']."', "
               ."MD5('".$data['Password']."'), "
               ."'".$data['Reminder']."', "
               ."'NewUser','".$data['Account']."') ";       
            $this->db->query($sql);
            $sql = "SELECT UserID FROM users WHERE Email = ? "; 
            $query = $this->db->query($sql, array(strtolower($data['UserEmail'])));
            $row = $query->row_array();
            if($row){
               $data['ActivationCode'] = "0".((string)($row["UserID"]+132));
            }
            // Send Email
            $config['protocol'] = 'sendmail';
//            $config['protocol'] = 'smtp';
//            $config['smtp_host'] = 'auth.smtp.1and1.co.uk';
//            $config['smtp_user'] = 'smtp';
//            $config['smtp_pass'] = 'smtp';
            
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->to($data['UserEmail']);
            $this->email->from('admin@CWISW.org.uk','Admin');
            $this->email->reply_to('admin@CWISW.org.uk');
            $this->email->subject("Your registration at CWISW"); 
            $emailtext = "Dear ".$data['FirstName'].",<br/><br/>\n\n" 
               ."Thank you for registering on-line.<br/><br/>\n\n"
               ."The details you supplied where;<br/><br/>\n\n"
               ."Name:     ".$data['FirstName']." ".$data['LastName']."<br/>\n"
               ."Email:    ".$data['UserEmail']."<br/>\n"
               ."Phone:    ".$data['UserPhone']."<br/>\n"
               ."Password Reminder: ".$data['Reminder']."<br/>\n"
               ."Account Type:  ".$data['Account']."<br/><br/>\n\n"
               ."Please keep this email safe for your future record.<br/><br/>\n\n"
               ."In order to activate your registration please click on the link below and login.<br/><br/>\n\n"
               ."https://www.cwisw.org.uk/public/activate?AC="
               .$data['ActivationCode']."&UserEmail=".trim($data['UserEmail'])."<br/><br/>\n\n" 
               ."Once you have logged-in, please complete your GUEST/HOST profile.<br/><br/>\n\n" 
               ."If you have any difficulty with the login process please email "
               ."admin@cwisw.org.uk <br/><br/>\n\n"
               ."New features are being added to the site all the time so please"
               ."keep checking on what has changed or been improved. "
               ."Your feedback back would be very much appreciated.<br/><br/>\n\n"
               ."Best regards,<br/><br/>\n\n" 
               ."Admin<br/><br/>\n\nCoventry & Warwick International Student Welcome";
            $this->email->message($emailtext);
            if($this->email->send()){;
//            echo $this->email->print_debugger();
               $data['NextPage'] = 'public/register.php';
            }else{
               $data['EmailError'] = $this->email->print_debugger();
            }
         }
         //echo $data['LoginMessage'];
      }  
      return($data);
   }
  */ 
   public function Verify($data){
       return($data);
   }

   public function Activate($data){
      $data['PageMode'] = 'login';
      $data['UserID'] = $data['ActivationCode'] - 132;
      $data['UserEmail'] = strtolower($data['UserEmail']);
      $data['LoginMessage'] = "Sorry - Registration has encountered a problem";
      if($data['UserID']>0){
         $sql = "SELECT Account FROM users "
            ."WHERE UserID = ? AND Email = ? ";
         $query = $this->db->query($sql, array($data['UserID'],strtolower($data['UserEmail'])));
         $row = $query->row_array();
         if($row){         
            $data['UserStatus'] = $row['Account'];
            $sql = "UPDATE users SET Status = Account "  
               ."WHERE UserID = ? AND Email = ? ";         
            $this->db->query($sql,array($data['UserID'],$data['UserEmail']));  
            $data['PageMode'] = 'Login';
            $data['LoginMessage'] = "Your login has been activated";
            $data['NextPage'] = 'public/login.php';
            
         }
      }
      return($data);
   }
   
   
   public function VerifyEmail($data){
      $this->email->initialize();
      $this->email->clear();
      $this->email->$to($data['UserEmail']);
      $this->email->$from('admin@cwisw.org','Admin');
      $this->email->$reply_to('admin@cwisw.org.uk');
      $this->email->$subject("Your registration at CWISW"); 
      $emailtext = "Dear ".$data['FirstName'].",<br/><br/>\n\n" 
         ."Thank you for registering on-line.<br/><br/>\n\n"
         ."The details you supplied where;<br/><br/>\n\n"
         ."Name:     ".$data['FirstName']." ".$data['LastName']."<br/>\n"
         ."Email:    ".$data['UserEmail']."<br/>\n"
         ."Phone:    ".$data['UserPhone']."<br/>\n"
         ."Password: ".$data['Password']."<br/>\n"
         ."Reminder: ".$data['Reminder']."<br/>\n"
         ."Account:  ".$data['Account']."<br/><br/>\n\n"
        ."Please keep this email safe for your future record.<br/><br/>\n\n"
         ."In order to activate your registration please click on the link below and login.<br/><br/>\n\n"
         ."https://www.www.cwisw.org.uk/index.php/public/activate?AC="
         .$data['ActivationCode']."&UserEmail=".trim($data['UserEmail'])."<br/><br/>\n\n" 
         ."If you have any difficulty with the login process please email "
         ."admin@cross-culturalcoaching.co.uk <br/><br/>\n\n"
         ."New resources are being added to the site all the time and you can now " 
         ."booking a coaching sessions on-line.<br/><br/>\n\n"
         ."Best regards,<br/><br/>\n\n" 
         ."Andrew<br/><br/>\n\nCross-Cultural Coaching";
      $this->email->message($emailtext);
      $this->email->send();
      echo $this->email->print_debugger();
      return($return);
   }
   
   
}
  