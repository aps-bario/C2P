<?php
class Location_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function List_Locations($data){ 
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
					$query = $this->db->query($sql, array(
                                            $data['NewStatus'],
                                            $data['ListMemberID'])); 
                                        
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