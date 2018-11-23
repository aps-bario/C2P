<?php
class Amity_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Location_model');
    }
    public function AllChurches($data){ 
        $data = $this->Location_model->SelectLocations($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"Country, Province, City, District"); 
        $data['NewStatus'] = (isset($data['NewStatus'])?$data['NewStatus']:""); 
        $data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
        //echo var_dump($data);
	if($data['PageMode'] == "Update"){ 
            if(!$data['MemberID']=='' and !$data['NewStatus']==''){ 
                if($data['NewStatus']=="Delete"){ 
                    $sql = "DELETE FROM amitychurches WHERE ChurchNum = ? "; 
                    $query = $this->db->query($sql, array($data['GroupID']));
		}else{ 
                    $sql = "UPDATE amitychurches SET Status = ? "
                        ."WHERE ChurchNum = ? ";
                    $query = $this->db->query($sql, array($data['NewStatus'],
                    $data['GroupID'])); 
		} 
            }
        }
        $sql = "SELECT DISTINCT ChurchName, ChurchNum, Country, Province, City, "
            ."District "
            ."FROM amitychurches WHERE TRUE ";
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
	$query = $this->db->query($sql); 
        //echo $sql;
        //echo $data['ListOrder'];
	$results = array(); 
	foreach ($query->result_array() as $row){ 
            $results[] = $row; 
	} 
        $data['NextPage'] = 'sysadmin/allchurches';
        $data['results'] = $results; 
        $data['PageMode'] ='List';
        return($data); 	
    }
    
    public function AmitySpider($data){
        return($data);  
    }
    
    
 }
 
 
