<?php
class SysAdmin_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
    
    public function DatabaseCleanup($data){
        // Remove Referee Records where Member no longer exists
        $sql = "DELETE FROM `referees` "
            ."WHERE MemberID not in (Select MemberID from members) ";
        $this->db->query($sql);
        
        // Remove referrals where returnee no longer exists
        $sql = "DELETE FROM referrals F "
            ."WHERE NOT EXISTS ("
            ."  SELECT 1 FROM returnees R "
            ."  WHERE R.ReturneeID = F.ReturneeID "
            .")";
        $this->db->query($sql);
        
        // Remove referralprogress where referrals no longer exists
        $sql = "DELETE FROM referralprogress P "
            ."WHERE NOT EXISTS ("
            ."  SELECT 1 FROM referrals F "
            ."  WHERE P.ReferralID = F.ReferralID "
            .")";
        $this->db->query($sql);
        // Remove clicklinks where referrals no longer exists
        $sql = "DELETE FROM clicklinks C "
            ."WHERE NOT EXISTS ("
            ."  SELECT 1 FROM referrals F "
            ."  WHERE C.ModelID = F.ReferralID "
            .") AND C.Model = 'Referral' ";
        $this->db->query($sql);
        
        return($data);
    }  
    
    // Build MemberTree table.
    public function BuildMemberTree($data){
        // Clear previous tree structure
        $sql = "DELETE FROM membertree";
        $this->db->query($sql);
        $sql = "INSERT INTO membertree (MemberID, ParentID, LeftCount, RightCount, TreeLevel) "
            ."VALUES (?,?,?,?,?) ";
        $query = $this->db->query($sql, array(0,0,1,0,0));        
        // Start at MemberID 0 
        $Counter = $this->ParentChildren(0,1);
        // Update Right Counter
        $sql = "UPDATE membertree SET RightCount = ? WHERE MemberID = ? ";
        $query = $this->db->query($sql, array(++$Counter, 0));
        return($data);
    }          
    // Build MemberTree table.
    public function BuildRefereeTree($data){
        // Clear previous tree structure
        $sql = "DELETE FROM refereetree";
        $this->db->query($sql);
        $sql = "INSERT INTO refereetree (MemberID, ParentID, LeftCount, RightCount, TreeLevel) "
            ."VALUES (?,?,?,?,?) ";
        $query = $this->db->query($sql, array(0,0,1,0,0));        
        // Start at MemberID 0 
        $Counter = $this->RefereeChildren(0,1);
        // Update Right Counter
        $sql = "UPDATE membertree SET RightCount = ? WHERE MemberID = ? ";
        $query = $this->db->query($sql, array(++$Counter, 0));
        return($data);
    }    
    private function ParentChildren($ParentID,$Counter){
        static $TreeLevel = 0;
        //$TreeLevel++;
        if($ParentID==0){
            $sql = "SELECT MemberID FROM members "
                ."WHERE ParentID = ? "
                ."ORDER BY MemberID ASC ";
        } else {
            $sql = "SELECT MemberID FROM members "
                ."WHERE ParentID = ? "
                ."ORDER BY LastName, FirstName ";
        }
        $query = $this->db->query($sql, array($ParentID));
	foreach ($query->result_array() as $row){ 
            if($row['MemberID']<>$ParentID){
                if($row['MemberID']==0){
                    $TreeLevel--;
                    return($Counter);
                }
                // Create Tree Record
                $sql = "INSERT INTO membertree (MemberID, ParentID, LeftCount, RightCount, TreeLevel) "
                    ."VALUES (?,?,?,?,?) ";
                $query = $this->db->query($sql, array($row['MemberID'],$ParentID,++$Counter,0,$TreeLevel++));  
                // Process Children 
                $Counter = $this->ParentChildren($row['MemberID'],$Counter);
                // Update Right Counter
                $sql = "UPDATE membertree SET RightCount = ? WHERE MemberID = ? ";
                $query = $this->db->query($sql, array(++$Counter, $row["MemberID"]));  
            }
	}
        $TreeLevel--;
        return($Counter);
    }    
    private function RefereeChildren($ParentID,$Counter){
        static $TreeLevel = 0;
        //$TreeLevel++;
        if($ParentID==0){
            $sql = "SELECT MemberID FROM members "
                ."WHERE ReferenceID = ? "
                ."ORDER BY MemberID ASC ";
        } else {
            $sql = "SELECT MemberID FROM members "
                ."WHERE ReferenceID = ? "
                ."ORDER BY LastName, FirstName ";  
        }
        $query = $this->db->query($sql, array($ParentID));
	foreach ($query->result_array() as $row){ 
            if($row['MemberID']<>$ParentID){
                if($row['MemberID']==0){
                    $TreeLevel--;
                    return($Counter);
                }
                // Create Tree Record
                $sql = "INSERT INTO refereetree (MemberID, ParentID, LeftCount, RightCount, TreeLevel) "
                    ."VALUES (?,?,?,?,?) ";
                $query = $this->db->query($sql, array($row['MemberID'],$ParentID,++$Counter,0,$TreeLevel++));  
                // Process Children 
                $Counter = $this->RefereeChildren($row['MemberID'],$Counter);
                // Update Right Counter
                $sql = "UPDATE refereetree SET RightCount = ? WHERE MemberID = ? ";
                $query = $this->db->query($sql, array(++$Counter, $row["MemberID"]));  
            }
	}
        $TreeLevel--;
        return($Counter);
    }  
    public function GetMemberTree($data){
        $sql = "SELECT m.MemberID, m.FirstName, m.LastName, m.Email, "
           ." m.Mobile, m.Status, mt.TreeLevel "
           ."FROM members m, membertree mt "
           ."WHERE m.MemberID = mt.MemberID "
           ."ORDER BY mt.LeftCount ASC ";
        $query = $this->db->query($sql);
        $results = array();
        foreach ($query->result_array() as $row){
            $results[] = $row;
        }
        $data['results'] = $results;

        $data['NextPage'] = 'sysadmin/membertree';
        $data['results'] = $results; 
        return($data);
    }
    public function GetRefereeTree($data){
        $sql = "SELECT m.MemberID, m.FirstName, m.LastName, m.Email, "
           ." m.Mobile, m.Status, mt.TreeLevel "
           ."FROM members m, refereetree mt "
           ."WHERE m.MemberID = mt.MemberID "
           ."ORDER BY mt.LeftCount ASC ";
        $query = $this->db->query($sql);
        $results = array();
        foreach ($query->result_array() as $row){
            $results[] = $row;
        }
        $data['results'] = $results;

        $data['NextPage'] = 'sysadmin/refereetree';
        $data['results'] = $results; 
        return($data);
    }    
    
 }

