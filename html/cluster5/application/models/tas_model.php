<?php
/*
    * tas_Model
    * Main Model
    * @author Weradet Nopsombun 62160110
    * @update Date 2564-05-01
*/
defined('BASEPATH') or exit('No direct script access allowed');
class tas_model extends CI_Model
{
   
    public $db;
    public $db_name;

    public function __construct(){
        $this->db = $this->load->database('default',true);
        $this->db_name = $this->db->database;
    }
}


