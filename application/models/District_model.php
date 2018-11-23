<?php
class District_model extends CI_Model {
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
        
    public function SelectDistricts($data){  
        if(!isset($data['Country'])){ $data['Country'] = 'China'; }
        if(!isset($data['Province'])){ $data['Province'] = ''; }
        if(!isset($data['City'])){ $data['City'] = ''; }
        if(!isset($data['District'])){ $data['District'] = ''; }
        if(!isset($data['Postcode'])){ $data['Postcode'] = ''; }
        // Search provided data for district matches
        if(!$data['Province']==''){
            $sql = "SELECT Country FROM districts "
                ."WHERE Province = ? ";
            $query =   $this->db->query($sql, array($data['Province']));
            $row = $query->row_array();
            if($row){
                $data['Country'] = $row['Country'];
            }
        }
        if(!$data['City']==''){
            $sql = "SELECT Province, Country FROM districts "
                ."WHERE City = ? ";
            $query =   $this->db->query($sql, array($data['City']));
            $row = $query->row_array();
            if($row){
                $data['Province'] = $row['Province'];
                $data['Country'] = $row['Country'];
            }
        }
        // District names are not unique so cannot by used without the City 
        if(!$data['District']=='' AND !$data['City']==''){
            $sql = "SELECT City, Province, Country, Postcode FROM districts "
                ."WHERE District = ? AND City = ? ";
            $query = $this->db->query($sql, array($data['District'], $data['City']));
            $row = $query->row_array();
            if($row){
                $data['Country'] = $row['Country'];
                $data['Province'] = $row['Province'];
                $data['Postcode'] = $row['Postcode'];
            }
        }
        // Only try to use Postcode if District is not provided
        if(!$data['Postcode']=='' AND !$data['Country']=='' AND $data['District']==''){
            $sql = "SELECT Country, Province, City, District FROM districts "
                ."WHERE Country = ? AND Postcode LIKE '".trim($data['Postcode'])."%' ";
            $query =   $this->db->query($sql, array($data['Country']));
            $row = $query->row_array();
            if($row){
                $data['Country'] = $row['Country'];
                $data['Province'] = $row['Province'];
                $data['City'] = $row['City'];
                $data['District'] = $row['District'];
                
            }
        }
        // Countries
        $sql = "SELECT DISTINCT Country as Name FROM districts "
            ."WHERE Country IS NOT NULL ";
        if(isset($data['Province']) AND !$data['Province'] ==''){
            $sql.="AND Province = '".$data['Province']."' ";}
        if(isset($data['City']) AND !$data['City'] ==''){
            $sql.="AND City = '".$data['City']."' ";      }
        if(isset($data['District']) AND !$data['District'] ==''){
            $sql.="AND District = '".$data['District']."' ";}
        if(isset($data['Postcode']) AND !$data['Postcode'] ==''){
          $sql.="AND Postcode LIKE '".trim($data['Postcode'])."%' ";}
        $sql.="ORDER BY Country ";
        $query = $this->db->query($sql);
        $Countries = $query->result_array();
        $data['Countries'] = $Countries;
        // Provinces
        $sql = "SELECT DISTINCT Province as Name FROM districts "
            ."WHERE Province IS NOT NULL ";
        if(isset($data['Country']) AND !$data['Country'] ==''){
            $sql.="AND Country = '".$data['Country']."' ";      }
        if(isset($data['City']) AND !$data['City'] ==''){
            $sql.="AND City = '".$data['City']."' ";      }
        if(isset($data['District']) AND !$data['District'] ==''){
            $sql.="AND District = '".$data['District']."' ";}
        if(isset($data['Postcode']) AND !$data['Postcode'] ==''){
          $sql.="AND Postcode LIKE '".trim($data['Postcode'])."%' ";}
        $sql.="ORDER BY Province ";
            $query = $this->db->query($sql);
        $Provinces = $query->result_array();
        $data['Provinces'] = $Provinces;
        // Cities
        $sql = "SELECT DISTINCT City as Name FROM districts "
            ."WHERE City IS NOT NULL ";
        $query = $this->db->query($sql);
        $Cities = $query->result_array();
        if(isset($data['Country']) AND !$data['Country'] ==''){
          $sql.="AND Country = '".$data['Country']."' ";      }
      if(isset($data['Province']) AND !$data['Province'] ==''){
          $sql.="AND Province = '".$data['Province']."' ";}
      if(isset($data['District']) AND !$data['District'] ==''){
          $sql.="AND District = '".$data['District']."' ";}
      if(isset($data['Postcode']) AND !$data['Postcode'] ==''){
          $sql.="AND Postcode LIKE '".trim($data['Postcode'])."%' ";}
      $sql.="ORDER BY City ";
      $query = $this->db->query($sql);
      $Cities = $query->result_array();
      $data['Cities'] = $Cities;
      // Postcodes
      $sql = "SELECT DISTINCT Postcode as Name FROM districts "
         ."WHERE Postcode IS NOT NULL ";
      if(isset($data['Country']) AND !$data['Country'] ==''){
          $sql.="AND Country = '".$data['Country']."' ";      }
      if(isset($data['Province']) AND !$data['Province'] ==''){
          $sql.="AND Province = '".$data['Province']."' ";}
      if(isset($data['City']) AND !$data['City'] ==''){
          $sql.="AND City = '".$data['City']."' ";}
      if(isset($data['District']) AND !$data['District'] ==''){
          $sql.="AND District = '".$data['District']."' ";}
      $sql.="ORDER BY Postcode ";   
      $query = $this->db->query($sql);
      $Postcodes = $query->result_array();
      $data['Postcodes'] = $Postcodes;
      // Districts
      $sql = "SELECT DISTINCT District as Name FROM districts "
         ."WHERE District IS NOT NULL ";
      if(isset($data['Country']) AND !$data['Country'] ==''){
          $sql.="AND Country = '".$data['Country']."' ";      }
      if(isset($data['Province']) AND !$data['Province'] ==''){
          $sql.="AND Province = '".$data['Province']."' ";}
      if(isset($data['City']) AND !$data['City'] ==''){
          $sql.="AND City = '".$data['City']."' ";}
      if(isset($data['Postcode']) AND !$data['Postcode'] ==''){
          $sql.="AND Postcode LIKE '".trim($data['Postcode'])."%' ";}
      $sql.="ORDER BY District ";   
      $query = $this->db->query($sql);
      $Districts = $query->result_array();
      $data['Districts'] = $Districts;
      return($data);
   }
   
      
    public function DistrictStats($data){  
      // Statistics 
      $sql = "SELECT count(Distinct D.DistrictID) AS Dist, "
        ."count(Distinct PlaceID) AS Plac, " 
        ."count(Distinct ContactID) AS Cont, " 
        ."count(Distinct ChurchNum) AS Chur, "
        ."count(Distinct GroupAlias) AS Grou "
        ."FROM districts D "
        ."LEFT JOIN gatekeeperplaces P on (P.Province LIKE D.Province AND P.City LIKE D.City) "
        ."LEFT JOIN contacts C on (C.Province LIKE D.Province AND C.City LIKE D.City) "
        ."LEFT JOIN amitychurches A on (A.Province = D.Province AND A.City = D.City) "
        ."LEFT JOIN groups G on (G.Province = D.Province AND G.City = D.City) "
        ."WHERE D.City IS NOT NULL "; 
      if(isset($data['Country']) AND !$data['Country'] ==''){
          $sql.="AND D.Country = '".$data['Country']."' ";      }
      if(isset($data['Province']) AND !$data['Province'] ==''){
          $sql.="AND D.Province = '".$data['Province']."' ";}
      if(isset($data['City']) AND !$data['City'] ==''){
          $sql.="AND D.City = '".$data['City']."' ";      }
      if(isset($data['District']) AND !$data['District'] ==''){
          $sql.="AND D.District = '".$data['District']."' ";}
      if(isset($data['Postcode']) AND !$data['Postcode'] ==''){
          $sql.="AND D.Postcode = '".$data['Postcode']."' ";}
      //echo $sql;
      $query = $this->db->query($sql);
      $Stats = $query->row_array();
      $data['Stats'] = $Stats;
      return($data);
   }

    public function ListDistricts($data){ 
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"DistrictID"); 
        $data['NewStatus'] = (isset($data['NewStatus'])?$data['NewStatus']:""); 
        $data['ListMemberID'] = (isset($data['ListMemberID'])?$data['ListMemberID']:""); 
        if($data['PageMode'] == "Update"){ 
            if(!$data['ListMemberID']=='' and !$data['NewStatus']==''){ 
                if($data['NewStatus']=="Delete"){ 
                    $sql = "DELETE FROM districts WHERE MemberID = ? "; 
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