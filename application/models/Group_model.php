<?php
class Group_model extends CI_Model {
    private $websiteURL  = 'https://www.cwisw.org.uk/';
    private $websiteRoot = 'gatekeeper/';
    private $websiteName = 'C2P - helping to connect Chinese Christians going home';
    private $websiteAdmin = 'C2P Admin';
    private $websiteEmail = 'aps@lifespeak.co.uk';

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Location_model');
    }
    public function MyGroups($data){ 
        $data = $this->Location_model->SelectLocations($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"Country, Province, City, District"); 
        $data['NewStatus'] = (isset($data['NewStatus'])?$data['NewStatus']:""); 
        $data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
        //echo var_dump($data);
	if($data['PageMode'] == "Update"){ 
            if(!$data['MemberID']=='' and !$data['NewStatus']==''){ 
                if($data['NewStatus']=="Delete"){ 
                    $sql = "DELETE FROM groups WHERE GroupID = ? "; 
                    $query = $this->db->query($sql, array($data['GroupID']));
		}else{ 
                    $sql = "UPDATE groups SET Status = ? "
                        ."WHERE MemberID = ?  AND GroupID = ? ";
                    $query = $this->db->query($sql, array($data['NewStatus'],
                    $data['MemberID'],
                    $data['GroupID'])); 
		} 
            }
        }
        $sql = "SELECT DISTINCT GroupID, GatekeeperID, Country, Province, City, "
            ."District, GroupAlias, Status "
            ."FROM groups WHERE GatekeeperID = ? ";
        if(isset($data['Country']) and !$data['Country'] == ''){
            $sql.="AND Country = '".$data['Country']."' ";
        }
        if(isset($data['Province']) and !$data['Province'] == ''){
            $sql.="AND Province = '".$data['Province']."' ";
        } 
        if(isset($data['City']) and !$data['City'] == ''){
            $sql.="AND City = '".$data['City']."'";
        }
        if(isset($data['District']) and !$data['District'] == ''){
            $sql.="AND District = '".$data['District']."' ";
        }
        if(isset($data['NewStatus']) and !$data['NewStatus'] == ''){
            $sql.="AND Status = '".$data['NewStatus']."' ";
        }
        $sql.="ORDER BY ".$data['ListOrder']; 
	$query = $this->db->query($sql, array($data['MemberID'])); 
        //echo $sql;
        //echo $data['ListOrder'];
	$results = array(); 
	foreach ($query->result_array() as $row){ 
            $results[] = $row; 
	} 
        $data['NextPage'] = 'gatekeeper/mygroups';
        $data['results'] = $results; 
        $data['PageMode'] ='List';
        return($data); 	
    }
    public function AllGroups($data){ 
        $data = $this->Location_model->SelectLocations($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"Country, Province, City, District"); 
        $data['NewStatus'] = (isset($data['NewStatus'])?$data['NewStatus']:""); 
        $data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
        //echo var_dump($data);
	if($data['PageMode'] == "Update"){ 
            if(!$data['MemberID']=='' and !$data['NewStatus']==''){ 
                if($data['NewStatus']=="Delete"){ 
                    $sql = "DELETE FROM groups WHERE GroupID = ? "; 
                    $query = $this->db->query($sql, array($data['GroupID']));
		}else{ 
                    $sql = "UPDATE groups SET Status = ? "
                        ."WHERE GroupID = ? ";
                    $query = $this->db->query($sql, array($data['NewStatus'],
                    $data['GroupID'])); 
		} 
            }
        }
        $sql = "SELECT DISTINCT GroupID, GatekeeperID, Country, Province, City, "
            ."District, GroupAlias, Status "
            ."FROM groups WHERE TRUE ";
        if(isset($data['Country']) and !$data['Country'] == ''){
            $sql.="AND Country = '".$data['Country']."' ";
        }
        if(isset($data['Province']) and !$data['Province'] == ''){
            $sql.="AND Province = '".$data['Province']."' ";
        } 
        if(isset($data['City']) and !$data['City'] == ''){
            $sql.="AND City = '".$data['City']."'";
        }
        if(isset($data['District']) and !$data['District'] == ''){
            $sql.="AND District = '".$data['District']."' ";
        }
        if(isset($data['NewStatus']) and !$data['NewStatus'] == ''){
            $sql.="AND Status = '".$data['NewStatus']."' ";
        }
        $sql.="ORDER BY ".$data['ListOrder']; 
	$query = $this->db->query($sql); 
        //echo $sql;
        //echo $data['ListOrder'];
	$results = array(); 
	foreach ($query->result_array() as $row){ 
            $results[] = $row; 
	} 
        $data['NextPage'] = 'sysadmin/allgroups';
        $data['results'] = $results; 
        $data['PageMode'] ='List';
        return($data); 	
    }
    
    public function NewGroups($data){ 
        $data = $this->Location_model->SelectLocations($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"Country, Province, City, District"); 
        $data['NewStatus'] = (isset($data['NewStatus'])?$data['NewStatus']:""); 
	$data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
        //echo var_dump($data);
	if($data['PageMode'] == "Add" and !$data['MemberID']=='' 
            and !$data['Country']=='' and !$data['Province']=='' and !$data['City']==''){ 
            $sql = "INSERT INTO groups (MemberID, Country, Province, City, District, Status) "
               ."VALUES (?,?,?,?,?,'Active') "; 
            $query = $this->db->query($sql, array($data['MemberID'],
                $data['Country'],$data['Province'],$data['City'],$data['District']));
        }
        $sql = "SELECT DISTINCT Country, Province, City, District "
            ."FROM locations L WHERE NOT EXISTS (SELECT 1 FROM groups C "
            ."WHERE C.Country = L.Country AND L.Province = C.Province "
            ."AND C.City = L.City AND IFNULL(C.District,'#') = IFNULL(L.District,'#') "
            ."AND C.MemberID = ? ) ";
        if(isset($data['Country']) and !$data['Country'] == ''){
            $sql.="AND L.Country = '".$data['Country']."'";
        }
        if(isset($data['Province']) and !$data['Province'] == ''){
            $sql.="AND L.Province = '".$data['Province']."'";
        } 
        if(isset($data['City']) and !$data['City'] == ''){
            $sql.="AND L.City = '".$data['City']."'";
        }
        if(isset($data['District']) and !$data['District'] == ''){
            $sql.="AND L.District = '".$data['District']."'";
        }
        $sql.="ORDER BY ".$data['ListOrder'];
	$query = $this->db->query($sql, array($data['MemberID'])); 
        $results = array(); 
	foreach ($query->result_array() as $row){ 
            $results[] = $row; 
	} 
        $data['NextPage'] = 'gatekeeper/newgroups';
        $data['results'] = $results; 
        $data['PageMode'] ='List';
        return($data); 	
    }
 }
