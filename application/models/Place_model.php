<?php
class Place_model extends CI_Model {
    private $websiteURL  = 'https://www.connecting2people.net/';
    private $websiteRoot = 'c2p/';
    private $websiteName = 'A network of people helping Christians returning home';
    private $websiteAdmin = 'C2P Admin';
    private $websiteEmail = 'aps@lifespeak.co.uk';

    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('District_model');
        $this->load->model('Gatekeeper_model');
    }
   
    public function MyPlaces($data){ 
        $data = $this->District_model->SelectDistricts($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"Country, Province, City, District"); 
	$data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
        $data['GatekeeperID'] = (isset($data['GatekeeperID'])?$data['GatekeeperID']:$data['MemberID']);
        $data['PlaceID'] = (isset($data['PlaceID'])?$data['PlaceID']:"");
        //echo var_dump($data);
	if($data['PageMode'] == "Save"){ 
            $data = $this->MyPlacesSave($data); 
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
  

        $sql.="ORDER BY ".$data['ListOrder']; 
	$query = $this->db->query($sql, array($data['MemberID'])); 
	$results = array(); 
	foreach ($query->result_array() as $row){ 
            $results[] = $row; 
	}
        if(count($results)==1){
            $data['PlaceID'] = $results[0]['PlaceID'];
            $data['Country'] = $results[0]['Country'];
            $data['Province'] = $results[0]['Province'];
            $data['City'] = $results[0]['City'];
            $data['Postcode'] = $results[0]['Postcode'];
            $data['District'] = $results[0]['District'];
            $data['Returnee'] = $results[0]['Returnee'];
            $data['Contact'] = $results[0]['Contact'];
            $data['Fellowship'] = $results[0]['Fellowship'];
            $data['Church'] = $results[0]['Church'];
            $data['Nearby'] = $results[0]['Nearby'];
            $data['Reminder'] = $results[0]['Reminder'];
            $data['Message'] = 'Single place identified ['.$data['PlaceID'].']';
        }    
        $data['NextPage'] = 'gatekeeper/myplaces';
        $data['results'] = $results; 
        $data['PageMode'] ='List';
        return($data); 	
    }
    
    public function MyPlacesSave($data){ 
        if(!$data['GatekeeperID']=='' and !$data['PlaceID']==''){
            $data['Message'] = 'Record Found.';
            if($data['Returnee']=='N' and $data['Contact']=='N' 
                and $data['Fellowship']=='N' and $data['Church']=='N'
                and $data['Nearby']=='N' and $data['Reminder'] ==''){
                $sql = "DELETE FROM gatekeeperplaces "
                    ."WHERE PlaceID = ? "; 
                $query = $this->db->query($sql, array($data['PlaceID']));
                $data['Message'] = 'Record Deleted.';
            }else{ 
                $sql = "UPDATE gatekeeperplaces SET "
                    ."Returnee = ?, Contact = ?, Fellowship = ?, Church = ?, "
                    ."Nearby = ?,  Reminder = ? "
                    ."WHERE GatekeeperID = ?  AND PlaceID = ? ";
                $query = $this->db->query($sql, array(
                    $data['Returnee'], $data['Contact'],
                    $data['Fellowship'], $data['Church'],
                    $data['Nearby'], $data['Reminder'], 
                    $data['GatekeeperID'], $data['PlaceID']));
                $data['Message'] = 'Record Updated.';
            } 
        } else if(!$data['MemberID']=='' and !$data['Country']=='' and
                !$data['Province']=='' and !$data['City']==''){
            $sql = "DELETE FROM gatekeeperplaces "
                ."WHERE GatekeeperID = ? ";
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
            $query = $this->db->query($sql, array($data['MemberID'])); 
            $sql = "INSERT INTO gatekeeperplaces (GatekeeperID, "
                ."Country, Province, City, Postcode, District, "
                ."Returnee, Contact, Fellowship, Church, Nearby, Reminder) "
                ."Values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $query = $this->db->query($sql, array(
                $data['MemberID'], $data['Country'],
                $data['Province'], $data['City'],
                $data['Postcode'], $data['District'],
                $data['Returnee'], $data['Contact'],
                $data['Fellowship'], $data['Church'],
                $data['Nearby'], $data['Reminder']));
            $data['Message'] = 'Record Inserted.';
        }
        return($data);
    }
    

    public function AllPlaces($data){ 
        $data = $this->District_model->SelectDistricts($data);
        $data = $this->Gatekeeper_model->SelectGatekeepers($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"Country, Province, City, District"); 
        $data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:"");
        $data['GatekeeperID'] = (isset($data['GatekeeperID'])?$data['GatekeeperID']:"");
        $data['PlaceID'] = (isset($data['PlaceID'])?$data['PlaceID']:"");
      
        //echo var_dump($data);
	if($data['PageMode'] == "Update"){ 
            if(!$data['MemberID']=='' and !$data['NewStatus']==''){ 
                if($data['NewStatus']=="Delete"){ 
                    $sql = "DELETE FROM gatekeeperplaces WHERE PlaceID = ? "; 
                    $query = $this->db->query($sql, array($data['PlaceID']));
		}else{ 
                    $sql = "UPDATE gatekeeperplaces SET "
                        ."Returnee = ?, Contact = ?, Fellowship = ?, Church = ?, "
                        ."Nearby = ?,  Reminder = ? "
                        ."WHERE PlaceID = ? ";
                    $query = $this->db->query($sql, array(
                        $data['Returnee'], $data['Contact'],
                        $data['Fellowship'], $data['Church'],
                        $data['Nearby'], $data['Reminder'],
                        $data['PlaceID'])); 
		} 
            }
        }
        $sql = "SELECT DISTINCT P.PlaceID, P.GatekeeperID, "
            ."P.Country, P.Province, P.City, P.Postcode, P.District, "
            ."CONCAT(G.FirstName,' ',G.LastName) as Gatekeeper, "
            ."P.Returnee, P.Contact, P.Fellowship, P.Church, P.Nearby "
            ."FROM gatekeeperplaces P "
            ."INNER JOIN members G ON (G.MemberID = P.GatekeeperID) " 
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
        if(isset($data['Postcode']) and !$data['Postcode'] == ''){
            $sql.="AND Postcode = '".$data['Postcode']."'";
        }
        if(isset($data['District']) and !$data['District'] == ''){
            $sql.="AND District = '".$data['District']."' ";
        }
         if(isset($data['Gatekeeper']) and !$data['Gatekeeper'] == ''){
            $sql.="AND CONCAT(G.FirstName,' ',G.LastName) = '".$data['Gatekeeper']."' ";
        }
        
        if(isset($data['Returnee']) and !$data['Returnee'] == ''){
            $sql.="AND Returnee = 'Y' ";
        }
        if(isset($data['Contact']) and !$data['Contact'] == ''){
            $sql.="AND Contact = 'Y' ";
        }
        if(isset($data['Fellowship']) and !$data['Fellowship'] == ''){
            $sql.="AND Fellowship = 'Y' ";
        }
        if(isset($data['Church']) and !$data['Church'] == ''){
            $sql.="AND Church = 'Y' ";
        }
        if(isset($data['Nearby']) and !$data['Nearby'] == ''){
            $sql.="AND Nearby = 'Y' ";
        }
  
        $sql.="ORDER BY ".$data['ListOrder']; 
	$query = $this->db->query($sql); 
        //echo $sql;
        //echo $data['ListOrder'];
	$results = array(); 
	foreach ($query->result_array() as $row){ 
            $results[] = $row; 
	} 
        $data['NextPage'] = 'sysadmin/allplaces';
        $data['results'] = $results; 
        $data['PageMode'] ='List';
        return($data); 	
    }
  /*  
    public function MyPlacesSave($data){ 
    //    $data = $this->District_model->SelectDistricts($data);
        $data['PageMode'] = (isset($data['PageMode'])?$data['PageMode']:"List"); 
        $data['ListOrder'] = (isset($data['ListOrder'])?$data['ListOrder']:"Country, Province, City, District"); 
        $data['MemberID'] = (isset($data['MemberID'])?$data['MemberID']:""); 
//        $data['GatekeeperID'] = (isset($data['GatekeeperID'])?$data['GatekeeperID']:"");
//        $data['PlaceID'] = (isset($data['PlaceID'])?$data['PlaceID']:"");
      //echo var_dump($data);
	if($data['PageMode'] == "Add" and !$data['MemberID']=='' 
            and !$data['Country']=='' and !$data['Province']=='' and !$data['City']==''){ 
            $sql = "INSERT INTO gatekeeperplaces (GatekeeperID, "
               ."Country, Province, City, Postcode, District, "
               ."Returnee, Contact, Fellowship, Church, Nearby, Reminder) "
               ."VALUES (?,?,?,?,?,?,?,?,?,?,?) "; 
            $query = $this->db->query($sql, array($data['MemberID'],
                $data['Country'],$data['Province'],$data['City'],$data['Postcode'],$data['District'],
                $data['Returnee'],$data['Contact'],$data['Fellowship'],$data['Church'],$data['Reminder']));
        }
        $sql = "SELECT DISTINCT Country, Province, City, Postcode, District, "
            ."FROM Districts D WHERE NOT EXISTS ("
                ."SELECT 1 FROM gatekeeperplaces P "
                ."WHERE D.Country = P.Country AND D.Province = P.Province AND D.City = P.City "
                ."AND IFNULL(D.Postcode,'#') = IFNULL(P.Postcode,'#') "
                ."AND IFNULL(D.District,'#') = IFNULL(P.District,'#') "
                ."AND P.GatekeeperID = ? ) ";
        if(isset($data['Country']) and !$data['Country'] == ''){
            $sql.="AND D.Country = '".$data['Country']."' ";
        }
        if(isset($data['Province']) and !$data['Province'] == ''){
            $sql.="AND D.Province = '".$data['Province']."' ";
        } 
        if(isset($data['City']) and !$data['City'] == ''){
            $sql.="AND D.City = '".$data['City']."' ";
        }
        if(isset($data['Postcode']) and !$data['Postcode'] == ''){
            $sql.="AND D.Postcode = '".$data['Postcode']."' ";
        }
        if(isset($data['District']) and !$data['District'] == ''){
            $sql.="AND D.District = '".$data['District']."' ";
        }
        $sql.="ORDER BY ".$data['ListOrder'];
	$query = $this->db->query($sql, array($data['MemberID'])); 
        $results = array(); 
	foreach ($query->result_array() as $row){ 
            $results[] = $row; 
	} 
        $data['NextPage'] = 'gatekeeper/myplaces';
        $data['results'] = $results; 
        $data['PageMode'] ='List';
        return($data); 	
    }
    */
 }
