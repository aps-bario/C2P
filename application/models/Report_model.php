<?php
class Report_model extends CI_Model {
    private $websiteURL  = 'https://www.connecting2people.net/';
    private $websiteRoot = 'c2p/';
    private $websiteName = 'Connecting2People - helping to connect Christians returning home';
    private $websiteAdmin = 'Connecting2People Admin';
    private $websiteEmail = 'admin@Connecting2People.net';


    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Location_model');
        $this->load->model('District_model');
        $this->load->model('Referral_model');
        $this->load->model('Email_model');
    }
    
    public function ProgressByLocation($data){ 
        //$data = $this->Location_model->SelectLocations($data);
        $data = $this->District_model->SelectDistricts($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"C.Country, C.Province, C.City, C.District "); 
        $data['ReturneeStatus'] = (isset($data['ReturneeStatus'])?$data['ReturneeStatus']:""); 
	$data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
        //echo var_dump($data)
    /*    
    $sql = "SELECT C.Country, C.Province, C.City, C.District, "
        ."Count(0) AS Returnees, "
	."SUM(IF(C.Status='NoReferral',1,0)) As NoReferral, "
        ."SUM(IF(C.Status='NewReferral',1,0)) As NewReferral, "
        ."SUM(IF(C.Status='Responded',1,0)) As Responded , "
        ."SUM(IF(C.Status='Acknowledged',1,0)) As Acknowledged , "
        ."SUM(IF(C.Status='Concerned',1,0)) As Concerned , "
        ."SUM(IF(C.Status='Cancelled',1,0)) As Cancelled , "
        ."SUM(IF(C.Status='Declined',1,0)) As Declined ,  "
        ."SUM(IF(C.Status='Accepted',1,0)) As Accepted , "
        ."SUM(IF(C.Status='Chased',1,0)) As Chased , "
        ."SUM(IF(C.Status='Connected',1,0)) As Connected , "
        ."SUM(IF(C.Status='Failed',1,0)) As Failed , "
        ."SUM(IF(C.Status='Confirmed',1,0)) As Confirmed , "
        ."SUM(IF(C.Status='Contacted',1,0)) As Contacted  "
    ."FROM ( "
    ."SELECT DISTINCT R.Country, R.Province, R.City, R.District, " 
        ."IFNULL(A.Status,'NoReferral') Status "
    ."FROM `returnees` R "
    ."LEFT JOIN ( "
        ."SELECT  P.ReturneeID, P.Status, P.ReferralID "
        ."FROM furthestprogress P, referrals F, members M  "
        ."WHERE P.ReferralID = F.ReferralID "
        ."AND F.GatekeeperID = M.MemberID) A on (R.ReturneeID = A.ReturneeID) "
    ."WHERE R.Status <> 'Deleted' ) C "
    ."WHERE TRUE ";    
  
    */    
        $sql = "SELECT C.Country, C.Province, C.City, C.District, "
        ."Count(0) AS Returnees, "
	."SUM(IF(C.Status='NoReferral',1,0)) As NoReferral, "
        ."SUM(IF(C.Status='NewReferral',1,0)) As NewReferral, "
        ."SUM(IF(C.Status='Responded',1,0)) As Responded , "
        ."SUM(IF(C.Status='Acknowledged',1,0)) As Acknowledged , "
        ."SUM(IF(C.Status='Concerned',1,0)) As Concerned , "
        ."SUM(IF(C.Status='Cancelled',1,0)) As Cancelled , "
        ."SUM(IF(C.Status='Declined',1,0)) As Declined ,  "
        ."SUM(IF(C.Status='Accepted',1,0)) As Accepted , "
        ."SUM(IF(C.Status='Chased',1,0)) As Chased , "
        ."SUM(IF(C.Status='Connected',1,0)) As Connected , "
        ."SUM(IF(C.Status='Failed',1,0)) As Failed , "
        ."SUM(IF(C.Status='Confirmed',1,0)) As Confirmed , "
        ."SUM(IF(C.Status='Contacted',1,0)) As Contacted  "
    ."FROM ( "
    ."SELECT DISTINCT R.Country, R.Province, R.City, R.District, " 
        ."IFNULL(A.Status,'NoReferral') Status "
    ."FROM `returnees` R "
    ."LEFT JOIN ( "
        ."SELECT  P.ReturneeID, P.Status, P.ReferralID "
        ."FROM furthestprogress P, referrals F "
        ."WHERE P.ReferralID = F.ReferralID "
        ."AND F.Status <> 'Deleted' "
        ."AND F.Status <> 'CityWatch') A on (R.ReturneeID = A.ReturneeID) "
    ."WHERE R.Status <> 'Deleted') C "
    ."WHERE TRUE ";    
        if(isset($data['Country']) and !$data['Country'] == ''){
            $sql.="AND C.Country = '".$data['Country']."' ";
        }
        if(isset($data['Province']) and !$data['Province'] == ''){
            $sql.="AND C.Province = '".$data['Province']."' ";
        } 
        if(isset($data['City']) and !$data['City'] == ''){
            $sql.="AND C.City = '".$data['City']."'";
        }
        if(isset($data['District']) and !$data['District'] == ''){
            $sql.="AND C.District = '".$data['District']."' ";
        }
        
        //$sql.="GROUP BY C.`Country`, C.`Province`, C.`City`, C.`District` ";
        //$sql.="GROUP BY C.`Country`, C.`Province`, C.`City`, C.`District`, C.FirstName, C.LastName ";
        
        $sql.="GROUP BY C.Country, C.Province, C.City, C.District ";
        $sql.="ORDER BY ".$data['ListOrder'];
        $query = $this->db->query($sql); 
        $data['sql'] = $sql;
        //echo $sql;
        //echo $data['ListOrder'];
         $results = array(); 
         foreach ($query->result_array() as $row){ 
            $results[] = $row; 
         } 
        $data['NextPage'] = 'reports/progbylocs';
        $data['results'] = $results; 
        $sql = "SELECT Status FROM referralstatus ORDER BY ListOrder ";
        $query = $this->db->query($sql);
        $data['Statuses'] = $query->result_array();
        $data['PageMode'] ='List';
        return($data); 	
    }
    
        public function ProgressBySponsor($data){ 
        //$data = $this->Location_model->SelectLocations($data);
        $data = $this->District_model->SelectDistricts($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"C.LastName, C.FirstName "); 
        $data['ReturneeStatus'] = (isset($data['ReturneeStatus'])?$data['ReturneeStatus']:""); 
	$data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
        //echo var_dump($data)

    $sql = "SELECT C.FirstName, C.LastName, Count(ReferralID) AS Referrals, "
	."SUM(IF(C.Status='NoReferral',1,0)) As NoReferral, "
        ."SUM(IF(C.Status='NewReferral',1,0)) As NewReferral, "
        ."SUM(IF(C.Status='Responded',1,0)) As Responded , "
        ."SUM(IF(C.Status='Acknowledged',1,0)) As Acknowledged , "
        ."SUM(IF(C.Status='Concerned',1,0)) As Concerned , "
        ."SUM(IF(C.Status='Cancelled',1,0)) As Cancelled , "
        ."SUM(IF(C.Status='Declined',1,0)) As Declined ,  "
        ."SUM(IF(C.Status='Accepted',1,0)) As Accepted , "
        ."SUM(IF(C.Status='Chased',1,0)) As Chased , "
        ."SUM(IF(C.Status='Connected',1,0)) As Connected , "
        ."SUM(IF(C.Status='Failed',1,0)) As Failed , "
        ."SUM(IF(C.Status='Confirmed',1,0)) As Confirmed , "
        ."SUM(IF(C.Status='Contacted',1,0)) As Contacted  "
    ."FROM ( "
    ."SELECT DISTINCT R.Country, A.ReferralID, A.FirstName, A.LastName,  " 
        ."IFNULL(A.Status,'NoReferral') Status "
    ."FROM `returnees` R "
    ."LEFT JOIN ( "
        ."SELECT P.ReturneeID, P.ReferralID, P.Status, M.FirstName, M.LastName  "
        ."FROM referralprogress P, referrals F, members M  "
        ."WHERE P.ReferralID = F.ReferralID "
        ."AND F.SponsorID = M.MemberID "
        . "AND F.Status <> 'Deleted' "
        . "AND F.Status <> 'CityWatch') A on (R.ReturneeID = A.ReturneeID) "
    ."WHERE R.Status <> 'Deleted' ) C "
    ."WHERE TRUE ";    
        $sql.="GROUP BY C.LastName, C.FirstName  ";
        $sql.="ORDER BY ".$data['ListOrder'];
        $query = $this->db->query($sql); 
        $data['sql'] = $sql;
        //echo $sql;
        //echo $data['ListOrder'];
         $results2 = array(); 
         foreach ($query->result_array() as $row){ 
            $results2[] = $row; 
         } 
    $data['results2'] = $results2; 
        
        
        
    $sql = "SELECT C.FirstName, C.LastName, Count(ReferralID) AS Referrals, "
	."SUM(IF(C.Status='NoReferral',1,0)) As NoReferral, "
        ."SUM(IF(C.Status='NewReferral',1,0)) As NewReferral, "
        ."SUM(IF(C.Status='Responded',1,0)) As Responded , "
        ."SUM(IF(C.Status='Acknowledged',1,0)) As Acknowledged , "
        ."SUM(IF(C.Status='Concerned',1,0)) As Concerned , "
        ."SUM(IF(C.Status='Cancelled',1,0)) As Cancelled , "
        ."SUM(IF(C.Status='Declined',1,0)) As Declined ,  "
        ."SUM(IF(C.Status='Accepted',1,0)) As Accepted , "
        ."SUM(IF(C.Status='Chased',1,0)) As Chased , "
        ."SUM(IF(C.Status='Connected',1,0)) As Connected , "
        ."SUM(IF(C.Status='Failed',1,0)) As Failed , "
        ."SUM(IF(C.Status='Confirmed',1,0)) As Confirmed , "
        ."SUM(IF(C.Status='Contacted',1,0)) As Contacted  "
    ."FROM ( "
    ."SELECT DISTINCT R.Country, A.ReferralID, A.FirstName, A.LastName,  " 
        ."IFNULL(A.Status,'NoReferral') Status "
    ."FROM `returnees` R "
    ."LEFT JOIN ( "
        ."SELECT P.ReturneeID,  P.ReferralID, P.Status, M.FirstName, M.LastName  "
        ."FROM furthestprogress P, referrals F, members M  "
        ."WHERE P.ReferralID = F.ReferralID "
        ."AND F.SponsorID = M.MemberID) A on (R.ReturneeID = A.ReturneeID) "
    ."WHERE R.Status <> 'Deleted' ) C "
    ."WHERE TRUE ";   
    /*
        if(isset($data['Country']) and !$data['Country'] == ''){
            $sql.="AND C.Country = '".$data['Country']."' ";
        }
        if(isset($data['Province']) and !$data['Province'] == ''){
            $sql.="AND C.Province = '".$data['Province']."' ";
        } 
        if(isset($data['City']) and !$data['City'] == ''){
            $sql.="AND C.City = '".$data['City']."'";
        }
        if(isset($data['District']) and !$data['District'] == ''){
            $sql.="AND C.District = '".$data['District']."' ";
        }
        
        //$sql.="GROUP BY C.`Country`, C.`Province`, C.`City`, C.`District` ";
        //$sql.="GROUP BY C.`Country`, C.`Province`, C.`City`, C.`District`, C.FirstName, C.LastName ";
      */  
        $sql.="GROUP BY C.LastName, C.FirstName  ";
        $sql.="ORDER BY ".$data['ListOrder'];
        $query = $this->db->query($sql); 
        $data['sql'] = $sql;
        //echo $sql;
        //echo $data['ListOrder'];
         $results = array(); 
         foreach ($query->result_array() as $row){ 
            $results[] = $row; 
         } 
        $data['results'] = $results; 
        $data['NextPage'] = 'reports/progbyspon';
        $sql = "SELECT Status FROM referralstatus ORDER BY ListOrder ";
        $query = $this->db->query($sql);
        $data['Statuses'] = $query->result_array();
        $data['PageMode'] ='List';
        return($data); 	
    }
    

    
    public function ProgressByGatekeeper($data){ 
        //$data = $this->Location_model->SelectLocations($data);
        $data = $this->District_model->SelectDistricts($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"C.LastName, C.FirstName "); 
        $data['ReturneeStatus'] = (isset($data['ReturneeStatus'])?$data['ReturneeStatus']:""); 
	$data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
        //echo var_dump($data)

    $sql = "SELECT C.FirstName, C.LastName, Count(ReferralID) AS Referrals, "
	."SUM(IF(C.Status='NoReferral',1,0)) As NoReferral, "
        ."SUM(IF(C.Status='NewReferral',1,0)) As NewReferral, "
        ."SUM(IF(C.Status='Responded',1,0)) As Responded , "
        ."SUM(IF(C.Status='Acknowledged',1,0)) As Acknowledged , "
        ."SUM(IF(C.Status='Concerned',1,0)) As Concerned , "
        ."SUM(IF(C.Status='Cancelled',1,0)) As Cancelled , "
        ."SUM(IF(C.Status='Declined',1,0)) As Declined ,  "
        ."SUM(IF(C.Status='Accepted',1,0)) As Accepted , "
        ."SUM(IF(C.Status='Chased',1,0)) As Chased , "
        ."SUM(IF(C.Status='Connected',1,0)) As Connected , "
        ."SUM(IF(C.Status='Failed',1,0)) As Failed , "
        ."SUM(IF(C.Status='Confirmed',1,0)) As Confirmed , "
        ."SUM(IF(C.Status='Contacted',1,0)) As Contacted  "
    ."FROM ( "
    ."SELECT DISTINCT R.Country, A.ReferralID, A.FirstName, A.LastName,  " 
        ."IFNULL(A.Status,'NoReferral') Status "
    ."FROM `returnees` R "
    ."LEFT JOIN ( "
        ."SELECT P.ReturneeID, P.ReferralID, P.Status, M.FirstName, M.LastName  "
        ."FROM referralprogress P, referrals F, members M  "
        ."WHERE P.ReferralID = F.ReferralID "
        ."AND F.GatekeeperID = M.MemberID "
        . "AND F.Status <> 'Deleted' "
        . "AND F.Status <> 'CityWatch') A on (R.ReturneeID = A.ReturneeID) "
    ."WHERE R.Status <> 'Deleted' ) C "
    ."WHERE TRUE ";    
    /*
        if(isset($data['Country']) and !$data['Country'] == ''){
            $sql.="AND C.Country = '".$data['Country']."' ";
        }
        if(isset($data['Province']) and !$data['Province'] == ''){
            $sql.="AND C.Province = '".$data['Province']."' ";
        } 
        if(isset($data['City']) and !$data['City'] == ''){
            $sql.="AND C.City = '".$data['City']."'";
        }
        if(isset($data['District']) and !$data['District'] == ''){
            $sql.="AND C.District = '".$data['District']."' ";
        }
        
        //$sql.="GROUP BY C.`Country`, C.`Province`, C.`City`, C.`District` ";
        //$sql.="GROUP BY C.`Country`, C.`Province`, C.`City`, C.`District`, C.FirstName, C.LastName ";
   */     
        $sql.="GROUP BY C.LastName, C.FirstName  ";
        $sql.="ORDER BY ".$data['ListOrder'];
        $query = $this->db->query($sql); 
        $data['sql'] = $sql;
        //echo $sql;
        //echo $data['ListOrder'];
         $results2 = array(); 
         foreach ($query->result_array() as $row){ 
            $results2[] = $row; 
         } 
    $data['results2'] = $results2; 
        
        
        
    $sql = "SELECT C.FirstName, C.LastName, Count(ReferralID) AS Referrals, "
	."SUM(IF(C.Status='NoReferral',1,0)) As NoReferral, "
        ."SUM(IF(C.Status='NewReferral',1,0)) As NewReferral, "
        ."SUM(IF(C.Status='Responded',1,0)) As Responded , "
        ."SUM(IF(C.Status='Acknowledged',1,0)) As Acknowledged , "
        ."SUM(IF(C.Status='Concerned',1,0)) As Concerned , "
        ."SUM(IF(C.Status='Cancelled',1,0)) As Cancelled , "
        ."SUM(IF(C.Status='Declined',1,0)) As Declined ,  "
        ."SUM(IF(C.Status='Accepted',1,0)) As Accepted , "
        ."SUM(IF(C.Status='Chased',1,0)) As Chased , "
        ."SUM(IF(C.Status='Connected',1,0)) As Connected , "
        ."SUM(IF(C.Status='Failed',1,0)) As Failed , "
        ."SUM(IF(C.Status='Confirmed',1,0)) As Confirmed , "
        ."SUM(IF(C.Status='Contacted',1,0)) As Contacted  "
    ."FROM ( "
    ."SELECT DISTINCT R.Country, A.ReferralID, A.FirstName, A.LastName,  " 
        ."IFNULL(A.Status,'NoReferral') Status "
    ."FROM `returnees` R "
    ."LEFT JOIN ( "
        ."SELECT P.ReturneeID,  P.ReferralID, P.Status, M.FirstName, M.LastName  "
        ."FROM furthestprogress P, referrals F, members M  "
        ."WHERE P.ReferralID = F.ReferralID "
        ."AND F.GatekeeperID = M.MemberID) A on (R.ReturneeID = A.ReturneeID) "
    ."WHERE R.Status <> 'Deleted' ) C "
    ."WHERE TRUE ";   
    /*
        if(isset($data['Country']) and !$data['Country'] == ''){
            $sql.="AND C.Country = '".$data['Country']."' ";
        }
        if(isset($data['Province']) and !$data['Province'] == ''){
            $sql.="AND C.Province = '".$data['Province']."' ";
        } 
        if(isset($data['City']) and !$data['City'] == ''){
            $sql.="AND C.City = '".$data['City']."'";
        }
        if(isset($data['District']) and !$data['District'] == ''){
            $sql.="AND C.District = '".$data['District']."' ";
        }
        
        //$sql.="GROUP BY C.`Country`, C.`Province`, C.`City`, C.`District` ";
        //$sql.="GROUP BY C.`Country`, C.`Province`, C.`City`, C.`District`, C.FirstName, C.LastName ";
      */  
        $sql.="GROUP BY C.LastName, C.FirstName  ";
        $sql.="ORDER BY ".$data['ListOrder'];
        $query = $this->db->query($sql); 
        $data['sql'] = $sql;
        //echo $sql;
        //echo $data['ListOrder'];
         $results = array(); 
         foreach ($query->result_array() as $row){ 
            $results[] = $row; 
         } 
        $data['results'] = $results; 
        $data['NextPage'] = 'reports/progbygate';
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
            ."WHERE NOT L.Status = 'Deleted' ";
                
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
    
 }
 
/*
 * VIEWS in the main database
 * 
 
*** VIEW FurthestProgress ***
select referralprogress.ProgressID AS ProgressID,
    `referralprogress`.`ReferralID` AS `ReferralID`,
    `referralprogress`.`ReturneeID` AS `ReturneeID`,
    `referralprogress`.`ContactID` AS `ContactID`,
    `referralprogress`.`PlaceID` AS `PlaceID`,
    `referralprogress`.`CityWatchID` AS `CityWatchID`,
    `referralprogress`.`Status` AS `Status`,
    `referralprogress`.`Updated` AS `Updated` 
from `referralprogress` 
where `referralprogress`.`ProgressID` in (
    select max(`P`.`ProgressID`) 
    from `referralprogress` `P` 
    join `referralstatus` `L` where exists(
        select 1 from `referralmaxorder` `M` 
        where ((`P`.`ReferralID` = `M`.`ReferralID`) 
        and (`L`.`ListOrder` = `M`.`MaxOrder`))
    ) 
    group by `P`.`ReferralID`
    )
);

*/
