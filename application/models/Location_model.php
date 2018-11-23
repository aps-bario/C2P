<?php
class Location_model extends CI_Model {
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
        
    public function SelectLocations($data){  
        if(!isset($data['Country'])){ $data['Country'] = 'China'; }
        if(!isset($data['Province'])){ $data['Province'] = ''; }
        if(!isset($data['City'])){ $data['City'] = ''; }
        if(!isset($data['District'])){ $data['District'] = ''; }
        // Countries
        if(!$data['District']=='' AND $data['City']==''){
            $sql = "SELECT City, Province, Country FROM locations "
                ."WHERE Status = 'Active' AND District = ? ";
            $query = $this->db->query($sql, array($data['District']));
            $row = $query->row_array();
            $data['City'] = $row['City'];
            $data['Province'] = $row['Province'];
            $data['Country'] = $row['Country'];
        }
        if(!$data['City']=='' AND $data['Province']==''){
            $sql = "SELECT Province, Country FROM locations "
                ."WHERE Status = 'Active' AND City = ? ";
            $query =   $this->db->query($sql, array($data['City']));
            $row = $query->row_array();
            $data['Province'] = $row['Province'];
            $data['Country'] = $row['Country'];
        }
        $sql = "SELECT DISTINCT Country as Name FROM locations "
            ."WHERE Status = 'Active' AND Country IS NOT NULL ";
        if(isset($data['Province']) AND !$data['Province'] ==''){
            $sql.="AND Province = '".$data['Province']."' ";}
        if(isset($data['City']) AND !$data['City'] ==''){
            $sql.="AND City = '".$data['City']."' ";      }
        if(isset($data['District']) AND !$data['District'] ==''){
            $sql.="AND District = '".$data['District']."' ";}
        $sql.="ORDER BY Country ";
        $query = $this->db->query($sql);
        $Countries = $query->result_array();
        $data['Countries'] = $Countries;
        // Provinces
        $sql = "SELECT DISTINCT Province as Name FROM locations "
            ."WHERE Status = 'Active' AND Province IS NOT NULL ";
        if(isset($data['Country']) AND !$data['Country'] ==''){
            $sql.="AND Country = '".$data['Country']."' ";      }
        if(isset($data['City']) AND !$data['City'] ==''){
            $sql.="AND City = '".$data['City']."' ";      }
        if(isset($data['District']) AND !$data['District'] ==''){
            $sql.="AND District = '".$data['District']."' ";}
        $sql.="ORDER BY Province ";
            $query = $this->db->query($sql);
        $Provinces = $query->result_array();
        $data['Provinces'] = $Provinces;
        // Cities
        $sql = "SELECT DISTINCT City as Name FROM locations "
            ."WHERE Status = 'Active' AND City IS NOT NULL ";
        $query = $this->db->query($sql);
        $Cities = $query->result_array();
        if(isset($data['Country']) AND !$data['Country'] ==''){
          $sql.="AND Country = '".$data['Country']."' ";      }
      if(isset($data['Province']) AND !$data['Province'] ==''){
          $sql.="AND Province = '".$data['Province']."' ";}
      if(isset($data['District']) AND !$data['District'] ==''){
          $sql.="AND District = '".$data['District']."' ";}
      $sql.="ORDER BY City ";
      $query = $this->db->query($sql);
      $Cities = $query->result_array();
      $data['Cities'] = $Cities;
      // Districts
      $sql = "SELECT DISTINCT District as Name FROM locations "
         ."WHERE Status = 'Active' AND District IS NOT NULL ";
      if(isset($data['Country']) AND !$data['Country'] ==''){
          $sql.="AND Country = '".$data['Country']."' ";      }
      if(isset($data['Province']) AND !$data['Province'] ==''){
          $sql.="AND Province = '".$data['Province']."' ";}
      if(isset($data['City']) AND !$data['City'] ==''){
          $sql.="AND City = '".$data['City']."' ";      }
//      if(isset($data['District']) AND !$data['District'] ==''){
//          $sql.="AND District = '".$data['District']."' ";}
      $sql.="ORDER BY District ";   
      $query = $this->db->query($sql);
      $Districts = $query->result_array();
      $data['Districts'] = $Districts;
      // Statistics 
      $sql = "SELECT count(Distinct L.LocationID) AS Locations, "
        ."count(Distinct ContactID) AS Contacts, " 
        ."count(Distinct ChurchNum) AS Churches, "
        ."count(Distinct GroupAlias) AS Groups "
        ."FROM locations L "
        ."LEFT JOIN contacts C on (C.LocationID = L.LocationID) "
        ."LEFT JOIN amitychurches A on (A.Province = L.Province AND A.City = L.City) "
        ."LEFT JOIN groups G on (G.Province = L.Province AND G.City = L.City) "
        ."WHERE L.Status = 'Active' AND L.City IS NOT NULL "; 
      if(isset($data['Country']) AND !$data['Country'] ==''){
          $sql.="AND L.Country = '".$data['Country']."' ";      }
      if(isset($data['Province']) AND !$data['Province'] ==''){
          $sql.="AND L.Province = '".$data['Province']."' ";}
      if(isset($data['City']) AND !$data['City'] ==''){
          $sql.="AND L.City = '".$data['City']."' ";      }
      if(isset($data['District']) AND !$data['District'] ==''){
          $sql.="AND L.District = '".$data['District']."' ";}
      //echo $sql;
      $query = $this->db->query($sql);
      $Stats = $query->row_array();
      $data['Stats'] = $Stats;
      //echo var_dump($data['Cities']);
      return($data);
   }

	public function ListLocations($data){ 
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