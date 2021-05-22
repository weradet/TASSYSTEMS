<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
    * Da_timestamp
    *โมเดลสำหรับ insert Update Deleteเท่านั้น
    * @author Weradet Nopsombun 62160110
    * @update Date 2564-04-13
*/
include_once 'tas_model.php';
class Da_employee extends tas_model
{
    public $emp_id;
    public $emp_code;
    public $emp_firstname;
    public $emp_lastname;
    public $emp_type;
    public $emp_username;
    public $emp_password;

    public function __construct()
    {
        parent::__construct();
    }

    /*
    * Function : get_by_id
    * get employee by id
    *@input -
     *@author Thanisorn thumsawanit 62160088
    *@Create Date 2564-05-10
    */
    public function get_by_id()
    {
        $sql = "SELECT * FROM {$this->db_name}.tas_employee 
        WHERE emp_id = ?";
        return $this->db->query($sql, array($this->emp_id));
    }
    /*
    * Function : Add_employee
    * get employee by id
    *@input $emp_code, $emp_firstname, $emp_lastname
     *@author Thanisorn thumsawanit 62160088
    *@Create Date 2564-05-10
    */
    function Add_employee($emp_code, $emp_firstname, $emp_lastname)
    {
        $query = "INSERT INTO `tas_employee`( `emp_code`, `emp_firstname`, `emp_lastname`) 
		VALUES ('$emp_code','$emp_firstname','$emp_lastname')";
        $this->db->query($query);
    }

    /*
    * Function : update_employee
    * update employee in table tas_employee
    *@input -
     *@author Ponprapai Atsawanurak 62160102
    *@Create Date 2564-05-10
    */

    public function update_employee()
    {
        $sql = "UPDATE {$this->db_name}.tas_employee 
            SET emp_firstname =?,emp_lastname=?,emp_username=?,emp_password=?
            WHERE emp_code= ?";

        $this->db->query($sql, array(
            $this->emp_firstname, $this->emp_lastname, $this->emp_username, $this->emp_password, $this->emp_code
        ));
    }

    /*
    * Function : delete_employee
    * Change status delete employee in table tas_employee
    * @input -
    * @author Preechaya Choosrithong 62160157
    * @Create Date 2564-05-10
    */

    public function delete_employee()
    {
        $sql = "UPDATE {$this->db_name}.tas_employee 
                SET emp_type = 1
                WHERE emp_code = ?";

        $this->db->query($sql, array(
            $this->emp_code
        ));
    }
}
