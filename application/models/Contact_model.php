<?php
class Contact_model extends CI_Model {
    private $websiteURL  = 'https://www.cwisw.org.uk/';
    private $websiteRoot = 'member/';
    private $websiteName = 'C2P - helping to connect Chinese Christians going home';
    private $websiteAdmin = 'C2P Admin';
    private $websiteEmail = 'aps@lifespeak.co.uk';

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Location_model');
    }
    public function MyContacts($data){ 
        $data = $this->Location_model->SelectLocations($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"Country, Province, City, District"); 
        $data['NewStatus'] = (isset($data['NewStatus'])?$data['NewStatus']:""); 
	$data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
        //echo var_dump($data);
	if($data['PageMode'] == "Update"){ 
            if(!$data['MemberID']=='' and !$data['NewStatus']==''){ 
                if($data['NewStatus']=="Delete"){ 
                    $sql = "DELETE FROM contacts WHERE ContactID = ? "; 
                    $query = $this->db->query($sql, array($data['ContactID']));
		}else{ 
                    $sql = "UPDATE contacts SET Status = ? "
                        ."WHERE GatekeeperID = ?  AND ContactID = ? ";
                    $query = $this->db->query($sql, array($data['NewStatus'],
                    $data['MemberID'],
                    $data['ContactID'])); 
		} 
            }
        }
        $sql = "SELECT DISTINCT PlaceID, GatekeeperID, "
            ."Country, Province, City, Postcode, District, "
            ."Returnee, Contact, Fellowship, Church, Nearby, Reminder "
            ."FROM gatekeeperplaces WHERE GatekeeperID = ? ";
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
        if(isset($data['Postcode']) and !$data['Postcode'] == ''){
            $sql.="AND Postcode = '".$data['Postcode']."' ";
        }
        if(isset($data['Returnee']) and !$data['Returnee'] == ''){
            $sql.="AND Returnee = 1 ";
        }
        if(isset($data['Contact']) and !$data['Contact'] == ''){
            $sql.="AND Contact = 1 ";
        }
        if(isset($data['Fellowship']) and !$data['Fellowship'] == ''){
            $sql.="AND Fellowship = 1 ";
        }
        if(isset($data['Church']) and !$data['Church'] == ''){
            $sql.="AND Church = 1 ";
        }
        if(isset($data['Nearby']) and !$data['Nearby'] == ''){
            $sql.="AND Nearby = 1 ";
        }
        $sql.="ORDER BY ".$data['ListOrder']; 
	$query = $this->db->query($sql, array($data['MemberID'])); 
        //echo $sql;
        //echo $data['ListOrder'];
	$results = array(); 
	foreach ($query->result_array() as $row){ 
            $results[] = $row; 
	} 
        $data['NextPage'] = 'gatekeeper/myplaces';
        $data['results'] = $results; 
        $data['PageMode'] ='List';
        return($data); 	
    }
    public function AllContacts($data){ 
        $data = $this->Location_model->SelectLocations($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"Country, Province, City, District"); 
        $data['NewStatus'] = (isset($data['NewStatus'])?$data['NewStatus']:""); 
	$data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
        //echo var_dump($data);
	if($data['PageMode'] == "Update"){ 
            if(!$data['MemberID']=='' and !$data['NewStatus']==''){ 
                if($data['NewStatus']=="Delete"){ 
                    $sql = "DELETE FROM contacts WHERE ContactID = ? "; 
                    $query = $this->db->query($sql, array($data['ContactID']));
		}else{ 
                    $sql = "UPDATE contacts SET Status = ? "
                        ."WHERE ContactID = ? ";
                    $query = $this->db->query($sql, array($data['NewStatus'],
                    $data['ContactID'])); 
		} 
            }
        }
        $sql = "SELECT DISTINCT C.ContactID, C.GatekeeperID, C.Country, C.Province, C.City, "
            ."CONCAT(G.FirstName,' ',G.LastName) as Sponsor, "
            ."C.District, C.ContactAlias, C.Status "
            ."FROM contacts C "
            ."INNER JOIN members G ON (G.MemberID = C.GatekeeperID) " 
            ."WHERE TRUE ";
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
        $sql.="ORDER BY ".$data['ListOrder']; 
	$query = $this->db->query($sql, array($data['MemberID'])); 
        //echo $sql;
        //echo $data['ListOrder'];
	$results = array(); 
	foreach ($query->result_array() as $row){ 
            $results[] = $row; 
	} 
        $data['NextPage'] = 'sysadmin/allcontacts';
        $data['results'] = $results; 
        $data['PageMode'] ='List';
        return($data); 	
    }
    
    public function NewContacts($data){ 
        $data = $this->Location_model->SelectLocations($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"Country, Province, City, District"); 
        $data['NewStatus'] = (isset($data['NewStatus'])?$data['NewStatus']:""); 
	$data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
        //echo var_dump($data);
	if($data['PageMode'] == "Add" and !$data['MemberID']=='' 
            and !$data['Country']=='' and !$data['Province']=='' and !$data['City']==''){ 
            $sql = "INSERT INTO contacts (GatekeeperID, Country, Province, City, District, Status) "
               ."VALUES (?,?,?,?,?,'Active') "; 
            $query = $this->db->query($sql, array($data['MemberID'],
                $data['Country'],$data['Province'],$data['City'],$data['District']));
        }
        $sql = "SELECT DISTINCT Country, Province, City, District, "
                . "'' as ContactAlias, '' as Status "
            ."FROM locations L WHERE NOT EXISTS ("
                ."SELECT 1 FROM contacts C "
                ."WHERE C.Country = L.Country AND L.Province = C.Province "
                ."AND C.City = L.City AND IFNULL(C.District,'#') = IFNULL(L.District,'#') "
                ."AND C.GatekeeperID = ? ) ";
        if(isset($data['Country']) and !$data['Country'] == ''){
            $sql.="AND L.Country = '".$data['Country']."' ";
        }
        if(isset($data['Province']) and !$data['Province'] == ''){
            $sql.="AND L.Province = '".$data['Province']."' ";
        } 
        if(isset($data['City']) and !$data['City'] == ''){
            $sql.="AND L.City = '".$data['City']."' ";
        }
        if(isset($data['District']) and !$data['District'] == ''){
            $sql.="AND L.District = '".$data['District']."' ";
        }
        $sql.="ORDER BY ".$data['ListOrder'];
	$query = $this->db->query($sql, array($data['MemberID'])); 
        $results = array(); 
	foreach ($query->result_array() as $row){ 
            $results[] = $row; 
	} 
        $data['NextPage'] = 'gatekeeper/mycontacts';
        $data['results'] = $results; 
        $data['PageMode'] ='List';
        return($data); 	
    }
 }
