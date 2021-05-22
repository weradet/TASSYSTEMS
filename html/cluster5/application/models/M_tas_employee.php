<?php
/*
* M_tas_employee
* Model for manage employee 
*extend Da_employee.php
*@author Weradet Nopsombun 62160110
*@create date 2564-04-13
*/
defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Da_employee.php';
class M_tas_employee extends Da_employee
{
  public function __construct()
  {
    parent::__construct();
  }



  /*
    *Get_emp_ajax_by_emp_code
    *get data employee form database
    *@input emp_code
    *@insert tsm_id tsm_timestamp
    *@author Weradet Nopsombun 62160110
    *@Create Date 2564-04-13
    */

  function get_emp_ajax_by_emp_code($emp_code)
  {

    $sql = "SELECT * from tas_employee where emp_code = '$emp_code' 
    AND emp_type = 0"; ///  

    $query = $this->db->query($sql);

    $row = $query->num_rows(); /////
    if ($row) {
      return $query;
    }
  }

  /*
    *get_emp
    *get data employee form database
    *@input -
    *@insert -
    *@author Thanisron thumsawanit 62160088
    *@Create Date 2564-05-11
    */
  public function get_emp()
  {
    $sql = "SELECT *  FROM {$this->db_name}.tas_employee
            WHERE emp_type != 1
            ORDER BY emp_code ASC ";

    return $this->db->query($sql);
  }
  /*
    *get_emp_by
    *get data employee by id form database
    *@input -
    *@insert -
    *@author Ponprapai Atsawanurak 62160102
    *@Create Date 2564-05-11
    */
  public function get_emp_by($emp_code)
  {
    $sql = "SELECT * FROM {$this->db_name}.tas_employee
            WHERE emp_code like '$emp_code'";

    $query = $this->db->query($sql);
    return $query;
  }



  public function checkuser($emp_code)
  {
    $sql = "SELECT * FROM {$this->db_name}.tas_employee
            WHERE emp_code = '$emp_code' AND emp_type = 0";

    $query = $this->db->query($sql);
    return $query;
  }

  /*
    *get_last_id
    *get last employee id form database
    *@input -
    *@insert -
    *@author Thanisron thumsawanit 62160088
    *@Create Date 2564-05-11
    */
  public function get_last_id()
  {
    $sql = "SELECT MAX(emp_code)+1 AS last  FROM tas_employee";
    $query = $this->db->query($sql);
    return $query;
  }
}
