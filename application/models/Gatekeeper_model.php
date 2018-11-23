<?php
class Gatekeeper_model extends CI_Model {
    private $websiteURL  = 'https://www.connecting2people.net/';
    private $websiteRoot = 'c2p/';
    private $websiteName = 'A network of people helping Christians returning home';
    private $websiteAdmin = 'C2P Admin';
    private $websiteEmail = 'aps@lifespeak.co.uk';


    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
   
   public function SelectGatekeepers($data){
       
        $sql = "SELECT MemberID, Email, FirstName, LastName, Status, "
                ."CONCAT(FirstName,' ',LastName) as Name "
                ."FROM members "
                ."WHERE Status in ('SysAdmin','CityWatch','Gatekeeper') "
                ."AND MemberID in ("
                ."   SELECT DISTINCT GatekeeperID FROM gatekeeperplaces "
                .") "
                ."ORDER BY LastName, FirstName "; 
            $query = $this->db->query($sql); 
            $results = array(); 
            foreach ($query->result_array() as $row){ 
                $results[] = $row; 
            } 
            $data['Gatekeepers'] = $results; 
            $data['PageMode'] ='List'; 
       return($data);
   }

    public function Location_List($data){ 
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"LocationID"); 
        $data['NewStatus'] = (isset($data['NewStatus'])?$data['NewStatus']:""); 
    	$data['ListMemberID'] = (isset($data['ListMemberID'])?$data['ListMemberID']:""); 
	if($data['PageMode'] == "Update"){ 
            if(!$data['ListMemberID']=='' and !$data['NewStatus']==''){ 
		if($data['NewStatus']=="Delete"){ 
                    $sql = "DELETE FROM locations WHERE MemberID = ? "; 
                    $query = $this->db->query($sql, array($data['ListMemberID'])); 
		}else{ 
                    $sql = "UPDATE members SET Status = ? WHERE MemberID = ? "; 
                    $query = $this->db->query($sql, array($data['NewStatus'],$data['ListMemberID'])); 
                    
                }  
            } 
            $sql = "SELECT MemberID, Email, FirstName, LastName, Status, Updated, LastVisited "
                ."FROM members ORDER BY ? "; 
            $query = $this->db->query($sql, array($data['ListOrder'])); 
            $results = array(); 
            foreach ($query->result_array() as $row){ 
                $results[] = $row; 
            } 
            $data['results'] = $results; 
            $data['PageMode'] ='List'; 
            return($data); 		
	}
    }
 }
