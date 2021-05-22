<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Da_login.php';

class M_tas_login extends Da_login
{
    public function __construct(){
        parent::__construct();
    }
/*  public $emp_username;
    public $emp_password;
    
    * Function : login
    * Select data from database
    * @input -
    * @author Natsuda Kuhasak 62160085
    * @Create Date 2564-04-20
*/
    function login(){
        $sql = "SELECT * 
                from tas_employee 
                where emp_username = ? AND  emp_password = ? AND emp_type != '1'";

        $query = $this->db->query($sql, array($this->emp_username, $this->emp_password));

        $query_row = $query->num_rows();
        
        if($query_row){
            return $query->row();
        }else{
            return false;
        }
    }
 
}