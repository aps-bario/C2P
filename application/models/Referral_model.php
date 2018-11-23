<?php
class Referral_model extends CI_Model {
    private $websiteURL  = 'https://www.connecting2people.net/';
    private $websiteRoot = 'c2p/';
    private $websiteName = 'Connecting2People - helping to connect Christians returning home';
    private $websiteAdmin = 'Connecting2People Admin';
    private $websiteEmail = 'admin@Connecting2People.net';

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Email_model');
        $this->load->model('Location_model');
    }
    
    public function ReferralCheck($data){
        
        // Look for Contacts the match Returnee request
/*        $sql = "SELECT C.ContactID, C.GatekeeperID "
            ."FROM contacts C "
            ."INNER JOIN returnees R ON (R.Country = C.Country "
            ."AND R.Province = C.Province AND R.City = C.City "
            ."AND R.District = C.District "
            .") WHERE R.ReturneeID = ".$data['ReturneeID']." "
            ."GROUP BY C.ContactID, C.MemberID ORDER BY Count(1) ";
        $sql = "SELECT C.ContactID, C.GatekeeperID "
            ."FROM contacts C, returnees R "
            ."WHERE R.Country = C.Country "
            ."AND R.Province = C.Province "
            ."AND R.City = C.City "
            ."AND R.District = C.District "
            ."AND R.ReturneeID = ".$data['ReturneeID']." "
            ."GROUP BY C.ContactID, C.GatekeeperID ORDER BY Count(1) ";
 */
        // Code added to ensure that a second referral to the same place
        // does not go to the same gatekeeper. 
         $sql = "SELECT P.PlaceID, P.GatekeeperID "
            ."FROM gatekeeperplaces P, returnees R "
            ."WHERE R.Country = P.Country "
            ."AND R.Province = P.Province "
            ."AND R.City = P.City "
            ."AND R.District = P.District "
            ."AND R.ReturneeID = ".$data['ReturneeID']." "
            ."AND NOT EXISTS ("
                 . "SELECT 1 FROM referrals F "
                 . "WHERE F.ReturneeID = R.ReturneeID "
                 . "AND F.GatekeeperID = P.GatekeeperID "
                 . "AND F.PlaceID = P.PlaceID "
                 . ") "
            ."GROUP BY P.PlaceID, P.GatekeeperID ORDER BY Count(1) ";
         
 /*        
         //$Dummy = "SELECT member1, member2, count(node) as distance from ( select a.memberID member1, b.memberID member2, c.ParentID node from members a, members b, memberpaths c WHERE c.MemberID = a.MemberID or c.MemberID = b.memberID group by a.memberID, b.memberID, c.ParentID having count(c.ParentID) = 1 ) d group by member1, member2 ";
         
         $sql = "SELECT P.PlaceID, P.GatekeeperID "
            ."FROM gatekeeperplaces P, returnees R "
            ."WHERE R.Country = P.Country "
            ."AND R.Province = P.Province "
            ."AND R.City = P.City "
            ."AND R.District = P.District "
            ."AND R.ReturneeID = ".$data['ReturneeID']." "
            ."AND NOT EXISTS ("
                 . "SELECT 1 FROM referrals F "
                 . "WHERE F.ReturneeID = R.ReturneeID "
                 . "AND F.GatekeeperID = P.GatekeeperID "
                 . "AND F.PlaceID = P.PlaceID "
                 . ") "
            ."GROUP BY P.PlaceID, P.GatekeeperID ORDER BY Count(1) ";
         
         
         $Dummy = "SELECT member1, member2, count(node) as distance from ( select a.memberID member1, b.memberID member2, c.ParentID node from members a, members b, memberpaths c WHERE c.MemberID = a.MemberID or c.MemberID = b.memberID group by a.memberID, b.memberID, c.ParentID having count(c.ParentID) = 1 ) d group by member1, member2 ";
         
  */       
         
         
         
        $query = $this->db->query($sql);
        $row = $query->result_array();
        // Used by Ajax Call
        $data['Result'] = '<b style="color:red;">Failed!</b>';
        if($row==null){
            //echo 'No District Match';
            // If No match on district try city 

/*            $sql = "SELECT C.ContactID, C.GatekeeperID "
                ."FROM contacts C "
                ."INNER JOIN returnees R ON (R.Country = C.Country "
                ."AND R.Province = C.Province AND R.City = C.City "
                .") WHERE R.ReturneeID = ".$data['ReturneeID']." "
                ."GROUP BY C.ContactID, C.MemberID ORDER BY Count(1) ";
            $sql = "SELECT C.ContactID, C.GatekeeperID "
                ."FROM contacts C, returnees R "
                ."WHERE R.Country = C.Country "
                ."AND R.Province = C.Province "
                ."AND R.City = C.City "
                ."AND R.ReturneeID = ".$data['ReturneeID']." "
                ."GROUP BY C.ContactID, C.GatekeeperID ORDER BY Count(1) ";
*/
            // Code added to ensure that a second referral to the same place
            // does not go to the same gatekeeper. 
            $sql = "SELECT P.PlaceID, P.GatekeeperID "
                ."FROM gatekeeperplaces P, returnees R "
                ."WHERE R.Country = P.Country "
                ."AND R.Province = P.Province "
                ."AND R.City = P.City "
                ."AND R.ReturneeID = ".$data['ReturneeID']." "
                ."AND NOT EXISTS ("
                     . "SELECT 1 FROM referrals F "
                     . "WHERE F.ReturneeID = R.ReturneeID "
                     . "AND F.GatekeeperID = P.GatekeeperID "
                     . "AND F.PlaceID = P.PlaceID "
                    . ") "
                ."GROUP BY P.PlaceID, P.GatekeeperID "
                ."ORDER BY Count(0) ";
            $query = $this->db->query($sql);
            $row = $query->result_array();
        }
        if($row){
            //$data['ContactID'] = $row[0]['ContactID'];
            $data['PlaceID'] = $row[0]['PlaceID'];
            $data['GatekeeperID'] = $row[0]['GatekeeperID'];
            // Least used contact with best match found - Generate a Referral
//            $sql = "INSERT INTO referrals (ReturneeID, SponsorID, ContactID, GatekeeperID, Status) "
//                ."SELECT R.ReturneeID, R.SponsorID, C.ContactID, C.GatekeeperID, 'New Referral' "
//                ."FROM returnees R, contacts C "
//                ."WHERE R.ReturneeID = '".$data['ReturneeID']."' "
//                ."AND C.ContactID = '".$data['ContactID']."' ";
            $sql = "INSERT INTO referrals (ReturneeID, SponsorID, PlaceID, GatekeeperID, Status) "
                ."SELECT R.ReturneeID, R.SponsorID, P.PlaceID, P.GatekeeperID, 'New Referral' "
                ."FROM returnees R, gatekeeperplaces P "
                ."WHERE R.ReturneeID = '".$data['ReturneeID']."' "
                ."AND P.PlaceID = '".$data['PlaceID']."' ";
            $query = $this->db->query($sql);
            $this->Email_model->NewReferral($data);          
            $this->Email_model->Referred($data);          
            $data['NextPage'] = $this->websiteRoot.'myreturnees';
            $data['Message'] = 'Contact found and referral request created.';
            // Used by Ajax Call
            $data['Result'] = "<b>Today!</b>";
        } else {
            //echo 'No City Match';
            // No contacts found - Update Returnee record and email Sponsor 
            $sql = "UPDATE returnees SET Status = 'No Referral' "
               ."WHERE ReturneeID = ? ";
            $this->db->query($sql, array($data['ReturneeID']));
            $sql = "INSERT INTO referrals (ReturneeID, SponsorID, Status) "
                ."SELECT R.ReturneeID, R.SponsorID, 'No Referral' "
                ."FROM returnees R "
                ."WHERE R.ReturneeID = '".$data['ReturneeID']."' "  ;
            $query = $this->db->query($sql);
            $data = $this->Email_model->NoReferral($data);          
            $data['NextPage'] = $this->websiteRoot.'myreturnees';
            $data['Message'] = 'No appropriate contacts on file.';
            // Used by Ajax Call
            $data['Result'] = '<b style="color:red;">Failed!</b>';
        }
        // CITY WATCH - Code added to ensure that CityWatch Gatekeepers
        // are only notified ONCE for each returnee. 
         $sql = "SELECT C.CityWatchID, C.GatekeeperID, R.ReturneeID, R.SponsorID "
            ."FROM citywatch C , returnees R "
            ."WHERE R.Country = C.Country "
            ."AND R.Province = C.Province "
            ."AND R.City = C.City "
            ."AND R.ReturneeID = ".$data['ReturneeID']." "
            ."AND NOT EXISTS ("
                 . "SELECT 1 FROM referrals F "
                 . "WHERE F.ReturneeID = R.ReturneeID "
                 . "AND F.GatekeeperID = C.GatekeeperID "
                 . "AND F.CityWatchID = C.CityWatchID "
            . ") ";
            $query = $this->db->query($sql);
            $row = $query->result_array();
            foreach($row as $watch){
                $data['GatekeeperID'] = $watch['GatekeeperID'];
                $data['CityWatchID'] = $watch['CityWatchID'];
                $sql = "INSERT INTO referrals (ReturneeID, SponsorID, CityWatchID, GatekeeperID, Status) "
                    ."SELECT R.ReturneeID, R.SponsorID, C.CityWatchID, C.GatekeeperID, 'CityWatch' "
                    ."FROM returnees R, citywatch C "
                    ."WHERE R.ReturneeID = '".$watch['ReturneeID']."' "
                        ."AND C.CityWatchID = '".$watch['CityWatchID']."' ";
                $query = $this->db->query($sql);
                $this->Email_model->CityWatchReferral($data);          
            }
        return($data);
    }

    public function MyReferrals($data){ 
        $data = $this->Location_model->SelectLocations($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"ReferralID DESC"); 
        $data['NewStatus'] = (isset($data['NewStatus'])?$data['NewStatus']:""); 
	$data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
	if($data['PageMode'] == "Update"){ 
            if(!$data['MemberID']=='' and !$data['NewStatus']==''){ 
            //    if($data['NewStatus']=="Delete"){ 
            //        $sql = "DELETE FROM referrals WHERE ReferralID = ? "; 
            //        $query = $this->db->query($sql, array($data['ListMemberID'])); 
	    //	}else{ 
                    $sql = "UPDATE referrals SET Status = ? "
                        ."WHERE GatekeeperID = ?  AND ReferralID = ? ";
                    $query = $this->db->query($sql, array($data['NewStatus'],
                    $data['MemberID'],
                    $data['ContactID'])); 
            //	}    
            }
        }
        $sql = "SELECT L.ReferralID, L.GatekeeperID, L.ContactID, L.SponsorID, "
            ."L.ReturneeID, L.Country, L.Province, L.City, L.District, "
            ."L.ReturneeAlias, L.Status, L.Updated, "
            ."L.RespondedDate, L.RespondedCode, "
            ."L.DeclinedDate, L.DeclinedCode, "
            ."L.AcceptedDate, L.AcceptedCode, "
            ."L.ConnectedDate, L.ConnectedCode, "
            ."L.ConfirmedDate, L.ConfirmedCode, "
            ."L.ConcernedDate, L.ConcernedCode, "
            ."CONCAT(L.ReturnMonth,' ',L.ReturnYear) as Returning "
            ."FROM referralclicklinks L, months M "   
            ."WHERE L.ReturnMonth = M.Mon AND L.GatekeeperID = ? "
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
        if(isset($data['District']) and !$data['District'] == ''){
            $sql.="AND L.District = '".$data['District']."' ";
        }
     //   if(isset($data['ReturnYear']) and !$data['ReturnYear'] == ''){
     //       $sql.="AND R.ReturnYear = '".$data['ReturnYear']."' ";
     //   }
//        if(isset($data['Returning']) and !$data['Returning'] == ''){
//            $sql.="AND CONCAT(R.ReturnMonth,' ',R.ReturnYear) = '".$data['Returning']."' ";
//        }
 //       if(isset($data['NewStatus']) and !$data['NewStatus'] == ''){
 //           $sql.="AND ifnull(P.Status,L.Status) = '".$data['NewStatus']."' ";
 //       }
        $sql.="ORDER BY ".$data['ListOrder']; 
	$query = $this->db->query($sql, array($data['MemberID'])); 
	$results = array(); 
	foreach ($query->result_array() as $row){ 
            $results[] = $row; 
	} 
        $data['NextPage'] = 'gatekeeper/myreferrals';
        $data['results'] = $results; 
        $sql = "SELECT Status FROM referralstatus ORDER BY ListOrder ";
        $query = $this->db->query($sql);
        $data['Statuses'] = $query->result_array();
        // Get Ordered Status List
        $data['PageMode'] ='List';
        return($data); 	
    }   
public function CityReferrals($data){ 
        $data = $this->Location_model->SelectLocations($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"Country, Province, City, District"); 
        $data['NewStatus'] = (isset($data['NewStatus'])?$data['NewStatus']:""); 
	$data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
	if($data['PageMode'] == "Update"){ 
            if(!$data['MemberID']=='' and !$data['NewStatus']==''){ 
            //    if($data['NewStatus']=="Delete"){ 
            //        $sql = "DELETE FROM referrals WHERE ReferralID = ? "; 
            //        $query = $this->db->query($sql, array($data['ListMemberID'])); 
	    //	}else{ 
                    $sql = "UPDATE referrals SET Status = ? "
                        ."WHERE GatekeeperID = ?  AND ReferralID = ? ";
                    $query = $this->db->query($sql, array($data['NewStatus'],
                    $data['MemberID'],
                    $data['ContactID'])); 
            //	}    
            }
        }
        $sql = "SELECT L.ReferralID, L.GatekeeperID, L.ContactID, L.SponsorID, "
            ."L.ReturneeID, L.Country, L.Province, L.City, L.District, "
            ."L.ReturneeAlias, L.Status, L.Updated, "
            ."L.RespondedDate, L.RespondedCode, "
            ."L.DeclinedDate, L.DeclinedCode, "
            ."L.AcceptedDate, L.AcceptedCode, "
            ."L.ConnectedDate, L.ConnectedCode, "
            ."L.ConfirmedDate, L.ConfirmedCode, "
            ."L.ConcernedDate, L.ConcernedCode, "
            ."CONCAT(L.ReturnMonth,' ',L.ReturnYear) as Returning "
            ."FROM referralclicklinks L, months M "   
            ."WHERE L.ReturnMonth = M.Mon AND L.GatekeeperID = ? "
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
        if(isset($data['District']) and !$data['District'] == ''){
            $sql.="AND L.District = '".$data['District']."' ";
        }
     //   if(isset($data['ReturnYear']) and !$data['ReturnYear'] == ''){
     //       $sql.="AND R.ReturnYear = '".$data['ReturnYear']."' ";
     //   }
//        if(isset($data['Returning']) and !$data['Returning'] == ''){
//            $sql.="AND CONCAT(R.ReturnMonth,' ',R.ReturnYear) = '".$data['Returning']."' ";
//        }
 //       if(isset($data['NewStatus']) and !$data['NewStatus'] == ''){
 //           $sql.="AND ifnull(P.Status,L.Status) = '".$data['NewStatus']."' ";
 //       }
        $sql.="ORDER BY ".$data['ListOrder']; 
	$query = $this->db->query($sql, array($data['MemberID'])); 
	$results = array(); 
	foreach ($query->result_array() as $row){ 
            $results[] = $row; 
	} 
        $data['NextPage'] = 'citywatch/cityreferrals';
        $data['results'] = $results; 
        $sql = "SELECT Status FROM referralstatus ORDER BY ListOrder ";
        $query = $this->db->query($sql);
        $data['Statuses'] = $query->result_array();
        // Get Ordered Status List
        $data['PageMode'] ='List';
        return($data); 	
    }   

    public function AllReferrals($data){ 
        $data = $this->Location_model->SelectLocations($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"ReferralID DESC"); 
        $data['NewStatus'] = (isset($data['NewStatus'])?$data['NewStatus']:""); 
	$data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
	if($data['PageMode'] == "Update"){ 
            if(!$data['MemberID']=='' and !$data['NewStatus']==''){ 
            //    if($data['NewStatus']=="Delete"){ 
            //        $sql = "DELETE FROM referrals WHERE ReferralID = ? "; 
            //        $query = $this->db->query($sql, array($data['ListMemberID'])); 
	    //	}else{ 
                    $sql = "UPDATE referrals SET Status = ? "
                        ."WHERE ReferralID = ? ";
                    $query = $this->db->query($sql, array($data['NewStatus'],
                    $data['ContactID'])); 
            //	}    
            }
        }
        $sql = "SELECT L.ReferralID, L.GatekeeperID, L.ContactID, L.SponsorID, "
            ."CONCAT(G.FirstName,' ',G.LastName) as Gatekeeper, "
            ."CONCAT(S.FirstName,' ',S.LastName) as Sponsor, "
            ."L.ReturneeID, L.Country, L.Province, L.City, L.District, "
            ."L.ReturneeAlias, L.Status, L.Updated, "
            ."L.RespondedDate, L.RespondedCode, "
            ."L.DeclinedDate, L.DeclinedCode, "
            ."L.AcceptedDate, L.AcceptedCode, "
            ."L.ConnectedDate, L.ConnectedCode, "
            ."L.ConfirmedDate, L.ConfirmedCode, "
            ."L.ConcernedDate, L.ConcernedCode, "
            ."CONCAT(L.ReturnMonth,' ',L.ReturnYear) as Returning "
            ."FROM referralclicklinks L, members G, members S, months M "   
            ."WHERE NOT L.Status = 'Deleted' "
            ."AND L.ReturnMonth = M.Mon "
            ."AND L.GatekeeperID = G.MemberID "
            ."AND L.SponsorID = S.MemberID ";
        if(isset($data['Country']) and !$data['Country'] == ''){
            $sql.="AND L.Country = '".$data['Country']."' ";
        }
        if(isset($data['Province']) and !$data['Province'] == ''){
            $sql.="AND L.Province = '".$data['Province']."' ";
        } 
        if(isset($data['City']) and !$data['City'] == ''){
            $sql.="AND L.City = '".$data['City']."'";
        }
        if(isset($data['District']) and !$data['District'] == ''){
            $sql.="AND L.District = '".$data['District']."' ";
        }
     //   if(isset($data['ReturnYear']) and !$data['ReturnYear'] == ''){
     //       $sql.="AND L.ReturnYear = '".$data['ReturnYear']."' ";
     //   }
        if(isset($data['Returning']) and !$data['Returning'] == ''){
            $sql.="AND CONCAT(L.ReturnMonth,' ',L.ReturnYear) = '".$data['Returning']."' ";
        }
        if(isset($data['NewStatus']) and !$data['NewStatus'] == ''){
            $sql.="AND L.Status = '".$data['NewStatus']."' ";
        }
        $sql.="ORDER BY ".$data['ListOrder']; 
	$query = $this->db->query($sql); 
	$results = array(); 
	foreach ($query->result_array() as $row){ 
            $results[] = $row; 
	} 
        $data['NextPage'] = 'sysadmin/allreferrals';
        $data['results'] = $results; 
        $sql = "SELECT Status FROM referralstatus ORDER BY ListOrder ";
        $query = $this->db->query($sql);
        $data['Statuses'] = $query->result_array();
        // Get Ordered Status List
        $data['PageMode'] ='List';
        return($data); 	
    }   
}
