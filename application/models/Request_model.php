<?php
class Request_model extends CI_Model {
    public function __construct(){
        parent::__construct();
	$this->load->database();
        $this->load->library('session');
    }

   public function MyRequests($data){
      $data['GuestEmail'] = (isset($_REQUEST['GuestEmail'])?$_REQUEST['GuestEmail']:$data['UserEmail']);
      $data['GuestID'] = (isset($_REQUEST['GuestID'])?$_REQUEST['GuestID']:0);
      if(!isset($data['GuestID']) OR $data['GuestID'] == 0){
         $sql = "SELECT GuestID FROM guests "
            ."WHERE LOWER(GuestEmail) = ? ";
         $query = $this->db->query($sql, array(strtolower($data['GuestEmail'])));
         $row = $query->row_array();
         if(count($row)>0){
            $data['GuestID'] = $row['GuestID'];
         }
      }
      $data['RequestType'] = (isset($_REQUEST['RequestType'])?$_REQUEST['RequestType']:'');
      $data['RequestStatus'] = (isset($_REQUEST['RequestStatus'])?$_REQUEST['RequestStatus']:'');
      $sql = "SELECT * FROM requests WHERE GuestID = ? "
         ."AND NOT RequestStatus = 'Cancelled' "
         ."ORDER BY RequestID ";
      $query = $this->db->query($sql, array($data['GuestID']));
      $data['requests'] = $query->result_array();
  //    echo var_dump($data);
  //    echo var_dump($sql);
      return($data);
      
   }
   
   public function ListRequests($data){
      $data['GuestEmail'] = (isset($_REQUEST['GuestEmail'])?$_REQUEST['GuestEmail']:$data['UserEmail']);
      $data['GuestID'] = (isset($_REQUEST['GuestID'])?$_REQUEST['GuestID']:0);
      if(!isset($data['GuestID']) OR $data['GuestID'] == 0){
         $sql = "SELECT GuestID FROM guests WHERE LOWER(GuestEmail) = ? ";
         if(!$data['UserStatus'] == 'Admin') {
            $sql .= "AND !RequestStatus = 'Cancelled' ";
         }
         $query = $this->db->query($sql, array(strtolower($data['GuestEmail'])));
         $row = $query->row_array();
         if(count($row)>0){
            $data['GuestID'] = $row['GuestID'];
         }
      }
      $data['RequestType'] = (isset($_REQUEST['RequestType'])?$_REQUEST['RequestType']:'');
      $data['RequestStatus'] = (isset($_REQUEST['RequestStatus'])?$_REQUEST['RequestStatus']:'');
      $sql = "SELECT G.FirstName, upper(G.LastName) LastName, G.Gender, G.AgeRange, R.* "
         ."FROM requests R, guests G "
         ."WHERE R.GuestID = G.GuestID "; 
      if(!$data['UserStatus'] == 'Admin' AND !$data['GuestID'] = ''){
         $sql .= "AND GuestID = ".$data['GuestID']." ";
      }
      if(!$data['RequestType']==''){
         $sql .= "AND RequestType = '".$data['RequestType']."' ";
      }
      if(!$data['RequestStatus']==''){
         $sql .= "AND RequestStatus = '".$data['RequestStatus']."' ";
      } else {
         $sql .= "AND NOT RequestStatus = 'Cancelled' ";
      }
      $sql .= "ORDER BY RequestID ";
      $query = $this->db->query($sql, array($data['GuestID']));
      $data['requests'] = $query->result_array();
      //  echo var_dump($data);
      return($data);
      
   }

   
     public function SetRequest($data){
      $data['RequestID'] = (isset($_REQUEST['RequestID'])?$_REQUEST['RequestID']:'0');
      $data['GuestID'] = (isset($_REQUEST['GuestID'])?$_REQUEST['GuestID']:'0');
      $data['GuestEmail'] = (isset($_REQUEST['GuestEmail'])?$_REQUEST['GuestEmail']:$data['UserEmail']);
      $data['RequestType'] = (isset($_REQUEST['RequestType'])?$_REQUEST['RequestType']:'Meal');
      $data['RequestStatus'] = (isset($_REQUEST['RequestStatus'])?$_REQUEST['RequestStatus']:'Pending');
      $data['RequestDetails'] = (isset($_REQUEST['RequestDetails'])?$_REQUEST['RequestDetails']:'');
      $data['OnlyOne'] = (isset($_REQUEST['OnlyOne'])?$_REQUEST['OnlyOne']:'0');
      $data['SameSex'] = (isset($_REQUEST['SameSex'])?$_REQUEST['SameSex']:'0');
      $data['Kids'] = (isset($_REQUEST['Kids'])?$_REQUEST['Kids']:'0');
      $data['Pets'] = (isset($_REQUEST['Pets'])?$_REQUEST['Pets']:'0');
      $data['Vegetarian'] = (isset($_REQUEST['Vegetarian'])?$_REQUEST['Vegetarian']:'0');
      $data['Smoker'] = (isset($_REQUEST['Smoker'])?$_REQUEST['Smoker']:'0');

//      $sql = "SELECT * FROM requests ";
//      $query = $this->db->query($sql);
//      $row = $query->row_array();
//      if($row){
//         foreach($row as $field=>$value){
//            $data[$field] = (isset($_REQUEST[$field])?$_REQUEST[$field]:NULL);
//         }
 //     }
      // A Guest may only update the profile for their own email address
//      if(!$data['UserEmail']==''){
//         $data['GuestEmail'] = $data['UserEmail'];
//      }
//  echo var_dump($data);
      return($data);
   }

   public function SaveRequest($data){
      $sql = "SELECT 1 FROM requests WHERE RequestID = ? ";
      $query = $this->db->query($sql, array($data['RequestID']));
      $row = $query->row_array();
      if($row and $data['RequestID']>0){
         // Update the existing record
         $sql = "UPDATE requests SET "
            ."GuestID = '".$data['GuestID']."', "
            ."GuestEmail = '".strtolower($data['GuestEmail'])."', "
            ."RequestType = '".$data['RequestType']."', "
            ."RequestStatus = '".$data['RequestStatus']."', "
            ."RequestDetails = '".$data['RequestDetails']."', "
            ."OnlyOne = '".$data['OnlyOne']."', "
            ."SameSex = '".$data['SameSex']."', "
            ."Kids = '".$data['Kids']."', "
            ."Pets = '".$data['Pets']."', "
            ."Vegetarian = '".$data['Vegetarian']."', "
            ."Smoker = '".$data['Smoker']."', "
            ."Updated = '".date('Y-m-d H:i:s')."' " 
            ."WHERE RequestID = ".$data['RequestID']." ";
         $this->db->query($sql);
      } else {   
         // Insert a new record
         $sql = "INSERT INTO requests ("  
            ."GuestID, GuestEmail, "
            ."RequestType, RequestStatus, RequestDetails, "
            ."OnlyOne, SameSex, Kids, Pets, Vegetarian, Smoker, "     
            ."Created "
            .") VALUES ("      
            ."".$data['GuestID'].",'".strtolower($data['GuestEmail'])."', "
            ."'".$data['RequestType']."','".$data['RequestStatus']."', "
            ."'".$data['RequestDetails']."', "
            ."".$data['OnlyOne'].",".$data['SameSex'].",".$data['Kids'].","
            ."".$data['Pets'].",".$data['Vegetarian'].",".$data['Smoker'].","
            ."'".date('Y-m-d H:i:s')."'"
            .")";
         $this->db->query($sql);
      }
    //  echo $sql;
      return($data);
   }   
   
     public function RequestTypes($data){
      $data['RequestType'] = (isset($_REQUEST['RequestType'])?$_REQUEST['RequestType']:'');
      $data['RequestStatus'] = (isset($_REQUEST['RequestStatus'])?$_REQUEST['RequestStatus']:'');
      $sql = "SELECT RequestType, RequestDesc, RequestList "
         ."FROM requesttypes "
         ."WHERE RequestList > 0 "
         ."ORDER RequestList ";
      $query = $this->db->query($sql);
      $data['RequestTypes'] = $query->result_array();
      return($data);
   }
   public function NewRequestTypes($data){
      $sql = "SELECT RequestType, RequestDesc, RequestList "
         ."FROM requesttypes "
         ."WHERE RequestList > 0 "
         ."AND RequestType NOT IN ("
         ."  SELECT RequestType FROM requests "  
         ."  WHERE RequestStatus = 'Pending' AND GuestID = ? "
         .") "
         ."ORDER BY RequestList ";
      $query = $this->db->query($sql,array($data['GuestID']));
      $data['RequestTypes'] = $query->result_array();
      //  echo var_dump($data['RequestTypes']);
      return($data);
   }
   
   
   public function GetRequest($data){    
      $data['RequestID'] = (isset($_REQUEST['RequestID'])?$_REQUEST['RequestID']:0);
      $sql = "SELECT * FROM requests WHERE RequestID = ? ";
      $query = $this->db->query($sql, array($data['RequestID']));
      $data['request'] = $query->row_array();
      $data['GuestID'] = $data['request']['GuestID'];
      // Pass current profile event filter options to the request
      $sql = "SELECT OnlyOne, SameSex, Kids, Pets, Vegetarian, Smoker "
         ."FROM guests WHERE GuestID = ? ";
      $query = $this->db->query($sql, array($data['GuestID']));
      $row = $query->row_array();
      if($row){
         foreach($row as $field=>$value){
            $data['request'][$field] = $value;
        }
      }
      return($data);
   }
   public function NewRequest($data){    
      $sql = "SELECT * FROM requests ";
      $query = $this->db->query($sql);
      $data['request'] = $query->row_array();
      if(count($data['request'])==0){
         $data['request'] = array('RequestType'=>'','RequestStatus'=>'','RequestDetails'=>'');
      }
      // Pass current profile event filter options to the request
      $sql = "SELECT OnlyOne, SameSex, Kids, Pets, Vegetarian, Smoker "
         ."FROM guests WHERE GuestID = ? ";
      $query = $this->db->query($sql, array($data['GuestID']));
      $row = $query->row_array();
      if($row){
         foreach($row as $field=>$value){
            $data['request'][$field] = $value;
        }
      }
      return($data);
   }

 
   
}
?>