<?php
class Returnee_model extends CI_Model {
    private $websiteURL  = 'https://www.connecting2people.net/';
    private $websiteRoot = 'c2p/';
    private $websiteName = 'Connecting2People - helping to connect Christians returning home';
    private $websiteAdmin = 'Connecting2People Admin';
    private $websiteEmail = 'admin@Connecting2People.net';


    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        //$this->load->model('Location_model');
        $this->load->model('District_model');
        //$this->load->model('Referral_model');
        //$this->load->model('Email_model');
    }
    
    public function MyReturnees($data){ 
        //$data = $this->Location_model->SelectLocations($data);
        $data = $this->District_model->SelectDistricts($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"ReturneeID DESC, ReferralID DESC"); 
        $data['NewStatus'] = (isset($data['NewStatus'])?$data['NewStatus']:""); 
	$data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
        //echo var_dump($data);
	if($data['PageMode'] == "Update"){ 
            if(!$data['MemberID']=='' and !$data['NewStatus']==''){ 
                if($data['NewStatus']=="Delete"){ 
                    $sql = "DELETE FROM returnees WHERE ReturneeID = ? "; 
                    $query = $this->db->query($sql, array($data['ContactID']));
		}else{ 
                    $sql = "UPDATE returnees SET Status = ? "
                        ."WHERE SponsorID = ?  AND ReturneeID = ? ";
                    $query = $this->db->query($sql, array($data['NewStatus'],
                    $data['MemberID'],
                    $data['ReturneeID'])); 
		} 
            }
        } 
        $sql = "SELECT L.ReferralID, L.GatekeeperID, L.SponsorID, "
            ."L.ReturneeID, L.Country, L.Province, L.City, L.District, "
            ."L.ReturneeAlias, L.Status, L.Updated, "
            ."L.AcknowledgedDate, L.AcknowledgedCode, "
            ."L.ContactedDate, L.ContactedCode, "
            ."L.ReferredDate, L.ReferredCode, "
            ."CONCAT(L.ReturnMonth,' ',L.ReturnYear) as Returning "
            ."FROM sponsorclicklinks L, months M "   
            ."WHERE L.ReturnMonth = M.Mon AND L.SponsorID = ? "
            ."AND L.ReferralStatus <> 'CityWatch' ";       
        if(isset($data['Country']) and !$data['Country'] == ''){
            $sql.="AND L.Country = '".$data['Country']."' ";
        }
        if(isset($data['Province']) and !$data['Province'] == ''){
            $sql.="AND L.Province = '".$data['Province']."' ";
        } 
        if(isset($data['City']) and !$data['City'] == ''){
            
            $sql.="AND L.City = '".$data['City']."'";
        }
// For some reason Postcode was not included in this view?        
//        if(isset($data['Postcode']) and !$data['Postcode'] == ''){
//            $sql.="AND L.Postcode = '".$data['Postcode']."' ";
//        }
        if(isset($data['District']) and !$data['District'] == ''){
            $sql.="AND L.District = '".$data['District']."' ";
        }
        if(isset($data['Returning']) and !$data['Returning'] == ''){
            $sql.="AND CONCAT(L.ReturnMonth,' ',L.ReturnYear) = '".$data['Returning']."' ";
        }
//        if(isset($data['NewStatus']) and !$data['NewStatus'] == ''){
//            $sql.="AND ifnull(P.Status,R.Status) = '".$data['NewStatus']."' ";
//        }
        $sql.="ORDER BY ".$data['ListOrder'];
	$query = $this->db->query($sql, array($data['MemberID'])); 
        //echo $sql;
        //echo $data['ListOrder'];
	$results = array(); 
	foreach ($query->result_array() as $row){ 
            $results[] = $row; 
	} 
        $data['NextPage'] = 'sponsor/myreturnees';
        $data['results'] = $results; 
        $sql = "SELECT Status FROM referralstatus ORDER BY ListOrder ";
        $query = $this->db->query($sql);
        $data['Statuses'] = $query->result_array();
        $data['PageMode'] ='List';
        return($data); 	
    }
    public function AllReturnees($data){ 
        //$data = $this->Location_model->SelectLocations($data);
        $data = $this->District_model->SelectDistricts($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"ReferralID DESC"); 
        $data['ReturneeStatus'] = (isset($data['ReturneeStatus'])?$data['ReturneeStatus']:""); 
	$data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
        //echo var_dump($data);
	if($data['PageMode'] == "Update"){ 
            if(!$data['MemberID']=='' and !$data['NewStatus']==''){ 
                if($data['NewStatus']=="Delete"){ 
                    $sql = "DELETE FROM returnees WHERE ReturneeID = ? "; 
                    $query = $this->db->query($sql, array($data['ContactID']));
		}else{ 
                    $sql = "UPDATE returnees SET Status = ? "
                        ."WHERE ReturneeID = ? ";
                    $query = $this->db->query($sql, array($data['ReturneeStatus'],
                    $data['ReturneeID'])); 
		} 
            }
        } 
/*        $sql = "SELECT R.Country, R.Province, R.City, R.Postcode, R.District, R.SponsorID, "
            ."CONCAT(S.FirstName,' ',S.LastName) as Sponsor, S.MemberID as SponsorID, "
            ."CONCAT(R.ReturnMonth,' ',R.ReturnYear) as Returning, "
            ."R.ReturneeAlias, ifnull(P.Status,R.Status) as Status " 
            ."FROM returnees R "
            ."INNER JOIN members S ON (S.MemberID = R.SponsorID) " 
            ."INNER JOIN months M ON (M.Mon = R.ReturnMonth) " 
            ."LEFT JOIN referrals L ON (L.ReturneeID = R.ReturneeID) " 
            ."LEFT JOIN (SELECT ReferralID, MAX(Updated) AS Latest "  
            ."FROM referralprogress GROUP BY ReferralID) F " 
            ."ON (F.ReferralID = L.ReferralID) " 
            ."LEFT JOIN referralprogress P ON (P.ReferralID = F.ReferralID "
            ."AND P.Updated = F.Latest) " 
            ."WHERE NOT R.Status = 'Deleted' ";

        $sql = "SELECT L.ReferralID, L.GatekeeperID, L.SponsorID, "
            ."CONCAT(S.FirstName,' ',S.LastName) as Sponsor, "
            ."CONCAT(G.FirstName,' ',G.LastName) as Gatekeeper, "    
            ."L.ReturneeID, L.Country, L.Province, L.City, L.District, "
            ."L.ReturneeAlias, L.Status ReturneeStatus, L.Updated, "
            ."L.AcknowledgedDate, L.AcknowledgedCode, "
            ."L.ContactedDate, L.ContactedCode, "
            ."L.ReferredDate, L.ReferredCode, "
            ."CONCAT(L.ReturnMonth,' ',L.ReturnYear) as Returning "
            ."FROM sponsorclicklinks L, members S, members G "   
            ."WHERE NOT L.Status = 'Deleted' "
            ."AND S.memberID = L.SponsorID "
            ."AND G.memberID = L.GatekeeperID ";      
*/
        
        $sql = "SELECT L.ReferralID, L.GatekeeperID, L.SponsorID, "
            ."CONCAT(S.FirstName,' ',S.LastName) as Sponsor, "
            ."CONCAT(G.FirstName,' ',G.LastName) as Gatekeeper, "
            ."L.ReturneeID, L.Country, L.Province, L.City, L.District, "
            ."L.ReturneeAlias, L.Updated, "
            ."L.AcknowledgedDate, L.AcknowledgedCode, "
            ."L.ContactedDate, L.ContactedCode, "
            ."L.ReferredDate, L.ReferredCode, "
            ."CONCAT(R.ReturnMonth,' ',R.ReturnYear) as Returning, "
            ."ifnull(L.Status,R.Status) as ReturneeStatus " 
            ."FROM returnees R "
            ."INNER JOIN members S ON (S.MemberID = R.SponsorID) "
            ."INNER JOIN months M ON (M.Mon = R.ReturnMonth)  "
            ."LEFT JOIN sponsorclicklinks L ON (L.ReturneeID = R.ReturneeID) "
            ."LEFT JOIN members G ON (G.MemberID = L.GatekeeperID) "
            ."WHERE NOT L.Status = 'Deleted' "
            ."AND L.ReferralStatus <> 'CityWatch' ";
                
/*        
        $sql = "SELECT L.ReferralID, L.GatekeeperID, L.SponsorID, "
            ."CONCAT(S.FirstName,' ',S.LastName) as Sponsor, "
            ."CONCAT(G.FirstName,' ',G.LastName) as Gatekeeper, "    
            ."L.ReturneeID, L.Country, L.Province, L.City, L.District, "
            ."L.ReturneeAlias, L.Status ReturneeStatus, L.Updated, "
            ."L.AcknowledgedDate, L.AcknowledgedCode, "
            ."L.ContactedDate, L.ContactedCode, "
            ."L.ReferredDate, L.ReferredCode, "
            ."CONCAT(L.ReturnMonth,' ',L.ReturnYear) as Returning "
            ."FROM sponsorclicklinks L, members S, members G "   
            ."WHERE NOT L.Status = 'Deleted' "
            ."AND S.memberID = L.SponsorID "
            ."AND G.memberID = L.GatekeeperID ";      
*/        
        

        
        if(isset($data['Country']) and !$data['Country'] == ''){
            $sql.="AND L.Country = '".$data['Country']."' ";
        }
        if(isset($data['Province']) and !$data['Province'] == ''){
            $sql.="AND L.Province = '".$data['Province']."' ";
        } 
        if(isset($data['City']) and !$data['City'] == ''){
            $sql.="AND L.City = '".$data['City']."'";
        }
        // Code below causes an error
        //if(isset($data['Postcode']) and !$data['Postcode'] == ''){
        //    $sql.="AND L.Postcode = '".$data['Postcode']."' ";
        //}
        if(isset($data['District']) and !$data['District'] == ''){
            $sql.="AND L.District = '".$data['District']."' ";
        }
        if(isset($data['Returning']) and !$data['Returning'] == ''){
            $sql.="AND CONCAT(L.ReturnMonth,' ',L.ReturnYear) = '".$data['Returning']."' ";
        }
        if(isset($data['ReturneeStatus']) and !$data['ReturneeStatus'] == ''){
            $sql.="AND L.Status = '".$data['ReturneeStatus']."' ";
        }
        $sql.="ORDER BY ".$data['ListOrder'];
         $query = $this->db->query($sql); 
        //echo $sql;
        //echo $data['ListOrder'];
         $results = array(); 
         foreach ($query->result_array() as $row){ 
            $results[] = $row; 
         } 
        $data['NextPage'] = 'sysadmin/allreturnees';
        $data['results'] = $results; 
        $sql = "SELECT Status FROM referralstatus ORDER BY ListOrder ";
        $query = $this->db->query($sql);
        $data['Statuses'] = $query->result_array();
        $data['PageMode'] ='List';
        return($data); 	
    }
    public function NewReturnee($data){
        //$data = $this->Location_model->SelectLocations($data);
        $data = $this->District_model->SelectDistricts($data);
        $data['NextPage'] = 'sponsor/newreturnee';
        return($data);
    }
    public function NewReturneeSave($data){
        //$data = $this->Location_model->SelectLocations($data);
        $data = $this->District_model->SelectDistricts($data);
        if(!isset($data['Returnee'])){ $data['Returnee'] = ''; }
        if(!isset($data['ReturnYear'])){ $data['ReturnYear'] = ''; }
        if(!isset($data['ReturnMonth'])){ $data['ReturnMonth'] = ''; }
        if(!isset($data['Details'])){ $data['Details'] = ''; }
        if(!isset($data['Postcode'])){ $data['Postcode'] = ''; }
        if(!isset($data['District'])){ $data['District'] = ''; }
        if(!isset($data['PageMode'])){ $data['PageMode'] = 'Insert'; }
        $data['NextPage'] = 'sponsor/addreturnee';
        if($data['PageMode'] == 'Insert'){
            if((!isset($data['Country']) OR $data['Country']=='') OR
                (!isset($data['Province']) OR $data['Province']=='') OR
                (!isset($data['City']) OR$data['City']=='')){
                $data['Message'] = 'Please select at least Country, Province & City';
            } elseif(!isset($data['Returnee']) OR $data['Returnee']==''){
                $data['Message'] = 'Please provide a returnee name (or alias) for your returnee';
            } elseif((!isset($data['ReturnMonth']) OR $data['ReturnMonth']=='') OR 
                (!isset($data['ReturnYear']) OR $data['ReturnYear']=='')){
                $data['Message'] = 'Please indicate the date this person is returning home';
            } elseif(!isset($data['Details']) OR $data['Details']==''){
                $data['Message'] = 'Please provide a little information about this person returning home';
            } elseif(!isset($data['MemberID']) OR $data['MemberID']==''){
                $data['Message'] = 'Session timed out - Please login again.';
            } else {
                // Check if the Returnee already exists
                $sql = "SELECT ReturneeID from returnees "
                    ."WHERE SponsorID = ".$data['MemberID']." "
                    ."AND ReturneeAlias = '".str_replace("'", "''",$data['Returnee'])."' "
                    ."AND City = '".$data['City']."' "    
                    ."AND ReturnYear = '".$data['ReturnYear']."' "
                    ."AND ReturnMonth = '".$data['ReturnMonth']."' ";
                $query = $this->db->query($sql);
                $row = $query->row_array();
                if($row){
                    $data['ReturneeID'] = $row['ReturneeID'];
                    $data['Message'] = 'This Returnee appears to already exist.';
                } else {                
                    // Handle single quotes added to text
                    $data['Details'] = str_replace("'", "''", $data['Details']);
                    // All data okay - so create a new returnee record    
                    $sql = "INSERT INTO returnees (SponsorID, ReturneeAlias, "
                        ."ReturnMonth, ReturnYear, Details, Country, Province, "
                        ."City, Postcode, District) VALUES ('".$data['MemberID']."','"
                        .str_replace("'", "''",$data['Returnee'])."','".$data['ReturnMonth']."','"
                        .$data['ReturnYear']."','".str_replace("'", "''",$data['Details'])."','"
                        .$data['Country']."','".$data['Province']."','"
                        .$data['City']."','".$data['Postcode']."','".$data['District']."')"; 
                    $this->db->query($sql);
                    // Now recover the ReturneeID just created
                    $sql = "SELECT ReturneeID from returnees "
                        ."WHERE SponsorID = ".$data['MemberID']." "
                        ."AND ReturneeAlias = '".str_replace("'", "''",$data['Returnee'])."' "
                        ."AND ReturnYear = '".$data['ReturnYear']."' "
                        ."AND ReturnMonth = '".$data['ReturnMonth']."' "
                        ."AND Status = 'New Returnee' ";
                    $query = $this->db->query($sql);
                    //echo $sql;
                    $row = $query->row_array();
                    if($row){
                        $data['ReturneeID'] = $row['ReturneeID'];
                    }
                    // Check if a referral is possible 
                    $data = $this->Referral_model->ReferralCheck($data);
                }
                if($data['Status'] == 'Sponsor'){
                    // Values set to use for MyReturnees List Page
                    $data['Returning'] = $data['ReturnMonth'].' '.$data['ReturnYear'];
                    //$data['District'] = ''; // As may not have been set for Returnee
                    //$data['NewStatus'] = '';
                } else {
                    // As Member has Sponsored first Returnee - upgrade Status
                    $sql = "UPDATE members SET Status = 'Sponsor' "
                        ."WHERE MemberID = ".$data['MemberID']." "
                        ."AND Status = 'Member' ";
                    $this->db->query($sql);
                    $data['Status'] = 'Sponsor';
                }    
                $data = $this->Returnee_model->MyReturnees($data);
                $data['NextPage'] = 'sponsor/myreturnees';
            }      
        }
        if($data['NextPage'] == 'sponsor/newreturnee'){
            // Data rejected return to ReturneeNew Page
            //$data = $this->Location_model->SelectLocations($data); 
            $data['NextPage'] = 'sponsor/newreturnee';
        }
        return($data);
    }
    public function DeleteReturnee($data){
        $Returnees = 0;
        $AccountReferrals = 0;
        $AccountProgress = 0; 
        $Clicklinks = 0;
        if(isset($data['Returnee']) and !$data['Returnee']==''){
            // Delete specified Returnee
            $sql = "SELECT Count(0) as Num FROM returnees "
                ."WHERE ReturneeID = ".$data['ReturneeID'];
            $query = $this->db->query($sql);
            $row = $query->row_array();
            $Returnees += $row['Num'];
//            $sql = "DELETE FROM returnees "
//                ."WHERE ReturneeID = ".$data['ReturneeID'];
            $sql = "UPDATE returnees SET Status = 'Deleted' "
                ."WHERE ReturneeID = ".$data['ReturneeID'];
            $query = $this->db->query($sql);
            // Delete specified Returnee from Referrals table
            $sql = "SELECT Count(0) as Num FROM referrals "
                ."WHERE ReturneeID = ".$data['ReturneeID'];
            $query = $this->db->query($sql);
            $row = $query->row_array();
            $Referrals += $row['Num'];
//            $sql = "DELETE FROM referrals "
//                ."WHERE ReturneeID = ".$data['ReturneeID'];
            $sql = "UPDATE referrals SET Status = 'Deleted' "
                ."WHERE ReturneeID = ".$data['ReturneeID'];
            $query = $this->db->query($sql);
            // Delete any other orphaned Referral records where Returnee has been deleted
            $sql = "SELECT Count(0) as Num FROM referrals F "
                ."WHERE NOT EXISTS ("
                ."  SELECT 1 FROM returnees R "
                ."  WHERE R.ReturneeID = F.ReturneeID "
                .")";
            $query = $this->db->query($sql);
            $row = $query->row_array();
            $Referrals += $row['Num'];
//            $sql = "DELETE FROM referrals F "
//                ."WHERE NOT EXISTS ("
//                ."  SELECT 1 FROM returnees R "
//                ."  WHERE R.ReturneeID = F.ReturneeID "
//                .")";
            $sql = "UPDATE referrals F SET Status = 'Deleted' "
                ."WHERE NOT EXISTS ("
                ."  SELECT 1 FROM returnees R "
                ."  WHERE R.ReturneeID = F.ReturneeID "
                .")";
            $query = $this->db->query($sql);
            // Delete specified Returnee from ReferralProgress table
            $sql = "SELECT Count(0) as Num FROM referralprogress "
                ."WHERE ReturneeID = ".$data['ReturneeID'];
            $query = $this->db->query($sql);
            $row = $query->row_array();
            $Progress += $row['Num'];
            $sql = "DELETE FROM referralprogress "
                ."WHERE ReturneeID = ".$data['ReturneeID'];
//            $query = $this->db->query($sql);
            // Delete any other orphaned ReferralProgress records where Referral has been deleted
            $sql = "SELECT Count(0) as Num FROM referralprogress P "
                ."WHERE NOT EXISTS ("
                ."  SELECT 1 FROM referrals F "
                ."  WHERE F.ReferralID = P.ReferralID "
                .")";
            $query = $this->db->query($sql);
            $row = $query->row_array();
            $Progress += $row['Num'];
            $sql = "DELETE FROM referralprogress P "
                ."WHERE NOT EXISTS ("
                ."  SELECT 1 FROM referrals F "
                ."  WHERE F.ReferralID = P.ReferralID "
                .")";
//            $query = $this->db->query($sql);
            // Delete any orphaned Clicklinks where Referral has been deleted
            $sql = "SELECT Count(0) as Num FROM clicklinks C "
                ."WHERE NOT EXISTS ("
                ."  SELECT 1 FROM referrals F "
                ."  WHERE C.ModelID = 'referral' and F.ReturneeID = C.ModelID "
                .")";
            $query = $this->db->query($sql);
            $row = $query->row_array();
            $Clicklinks += $row['Num'];
            $sql = "DELETE FROM clicklinks C "
                ."WHERE NOT EXISTS ("
                ."  SELECT 1 FROM referrals F "
                ."  WHERE C.ModelID = 'referral' and F.ReturneeID = C.ModelID "
                .")";
//            $query = $this->db->query($sql);
        }    
        $data['Message'] = 'Returnee ID:'.$data['ReturneeID'].' - '.$Returnees.' Returnee Records, '
                .$Referrals.' Referrals, '.$Progress.' Progress Records, '
                .$Clicklings.' Clicklinks - DELETED!';
        echo $data['Message'];        
        return($data);
    }
    
    
    
 }
