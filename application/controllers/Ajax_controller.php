<?php
class ajax_controller extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('html');
        $this->load->helper('url');
        date_default_timezone_set('Europe/London');
    }
   
    private function getdata(){
        $this->load->model('Ajax_model');    
        $data = array('Email'=>null, 'FirstName'=>null, 'LastName'=>null, 
            'Password'=>null, 'Confirm'=>null, 'Reminder'=>null, 
            'Mobile'=>null, 'Account'=>null, 'Chk'=>null, 'NextPage'=>null,  
            'LoginMessage'=>null, 'EmailError'=>null, 'Style'=>'mobile',
            'MemberID'=>null, 'Message'=>null, 'Status'=>null);
        $data['Email'] = $this->session->userdata('Email');
        $data['Mobile'] = $this->session->userdata('Mobile');
        $data['Status'] = $this->session->userdata('Status');
        $data['FirstName'] = $this->session->userdata('FirstName');
        $data['LastName'] = $this->session->userdata('LastName');
        $data['Account'] = $this->session->userdata('Account');
        $data['MemberID'] = $this->session->userdata('MemberID');
        foreach($_GET as $key=>$value){$data[$key] = $value;}
        foreach($_POST as $key=>$value){$data[$key] = $value;}
        foreach($_REQUEST as $key=>$value){$data[$key] = $value;}
        return($data);
    }
    
    private function AjaxSecurityCheck() {
        foreach($_SERVER as $key=>$value){$data[$key] = $value;}
//        session_start();
        $AjaxOkay = false;
        //Check that this is an ajax request and not a direct call
      //  $RequestType = isset($_SERVER['HTTP_X_REQUESTED_WITH'])?$_SERVER['HTTP_X_REQUESTED_WITH']:'XMLHttpRequest'; 
        if(true){
        //if(isset($data['HTTP_X_REQUESTED_WITH']) && $data['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
            // Check that the call has been made from a recognised domain
            $SafeDomains = [
                'https://www.connecting2people.net',
                'http://www.cross-culturalcoaching.com'];
            $CallDomain = 'https://www.connecting2people.net';
            if(isset($_SERVER['HTTP_REFERER'])){
                $CallDomain = $data['HTTP_REFERER'];
            }
            if(isset($CallDomain) && strlen($CallDomain)>8){
                $pos = strpos($CallDomain,"/",8);
                $CallDomain = substr($CallDomain,0,$pos);
            }
            $CallDomain = strtolower($CallDomain);
            if(isset($CallDomain) && in_array($CallDomain,$SafeDomains)){
                // Check that the active session has logged in
                $Status = $this->session->userdata('Status');
                if(isset($Status) && !$Status==''){
                    $AjaxOkay = true;
                }
                //HTTP_REFERER verification - Not used
                //if($_POST['token'] == $_SESSION['token']) {
                //    $AjaxOkay = true;
                //}
            } else {
                echo 'Calling domain is '.$CallDomain;
            }
        }
        return($AjaxOkay);
    }
    
    public function Code($fn){
        if($this->AjaxSecurityCheck()){
            $data = $this->getdata();
            switch(strtolower($fn)):
            case 'getcountryoptions':   $this->Ajax_model->GetCountryOptions($data); break;
            case 'getprovinceoptions':  $this->Ajax_model->GetProvinceOptions($data); break;
            case 'getcityoptions':      $this->Ajax_model->GetCityOptions($data); break;
            case 'getpostcodeoptions':  $this->Ajax_model->GetPostcodeOptions($data); break;
            case 'getdistrictoptions':  $this->Ajax_model->GetDistrictOptions($data); break;
//            case 'getmyplaceslistitems':  $this->Ajax_model->GetMyPlacesListItems($data); break;
            case 'getplacecountry':     $this->Ajax_model->GetPlaceCountry($data); break;
            case 'getplaceprovince':    $this->Ajax_model->GetPlaceProvince($data); break;
            case 'getplacecity':        $this->Ajax_model->GetPlaceCity($data); break;
            case 'getplacepostcode':    $this->Ajax_model->GetPlacePostcode($data); break;
            case 'getplacedistrict':    $this->Ajax_model->GetPlaceDistrict($data); break;
            case 'getmyplacesselect':   $this->Ajax_model->GetMyPlacesSelect($data); break;
            case 'getmyplacesradiolist':$this->Ajax_model->GetMyPlacesRadioList($data); break;
            case 'getmyplacesfieldset': $this->Ajax_model->GetMyPlacesFieldSet($data); break;
            case 'getmyplacedetails':   $this->Ajax_model->GetMyPlaceDetails($data); break;
            case 'setmyplacedetails':   $this->Ajax_model->SetMyPlaceDetails($data); break;
            case 'processclicklink':    $this->Ajax_model->ProcessClickLink($data); break;
            case 'newreferralcheck':    $this->Ajax_model->NewReferralCheck($data); break;
            endswitch;
        }
    }
}
        