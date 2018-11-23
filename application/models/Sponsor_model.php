<?php
class Sponsor_model extends CI_Model {
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
 }
