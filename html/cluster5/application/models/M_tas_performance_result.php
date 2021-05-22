<?php
defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Da_performance_result.php';
/*
    * M_tas_performance_result
    * query Performace result
    * @author Wachiravit Pramjit 62160010
    * @Create Date 2564-04-19
*/
class M_tas_performance_result extends Da_performance_result
{
  /*
    * __construct
    * load helper
    * @input -
    * @output-
    * @author Wachiravit Pramjit 62160010
    * @Create Date 2564-04-19
*/
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('mydate_helper.php');
  }

  /*
    * get_emp_by
    * query Performace result
    * @input date_start, date_end, emp_id
    * @output emp_code,emp_firstname,emp_lastname,Work_Time,No_Time_Stamp_Out,Late,No_Time_Stamp
    * @author Wachiravit Pramjit 62160010
    * @Create Date 2564-04-13
*/

  function get_emp_by($date,$emp_id)
  {
    $sql = "SELECT emp_code,emp_firstname,emp_lastname,
    COUNT(case when tsm_timestamp or tsm_timestamp_out is not null then 1 end ) as Work_Time,
    COUNT(case when tsm_timestamp > '08:00:00' then 1  end) as Late ,
    COUNT(case when tsm_timestamp and tsm_timestamp_out is null then 1  end ) as No_Time_Stamp_Out,
    COUNT(case when tsm_timestamp_out and tsm_timestamp is null then 0  end ) as No_Time_Stamp,
    COUNT(case when tsm_timestamp_out < '17:00:00' then 1  end) as Leave_early
    From  {$this->db_name}.tas_employee
        left JOIN {$this->db_name}.tas_timestamp 
        ON tas_employee.emp_id = tas_timestamp.emp_id
        where tsm_status_del = 0  AND $date and $emp_id
        Group by emp_code ";
    $query = $this->db->query($sql);
    return $query;
  }
  /*
    * get_data_chart
    * query Performace result สำหรับสร้าง chart
    * @input date
    * @output tsm_date,tsm_timestamp,tsm_timestamp_out,Work_Time,No_Time_Stamp_Out,Late,No_Time_Stamp
    * @author Wachiravit Pramjit 62160010
    * @Create Date 2564-04-21
*/
  function get_data_chart($date)
  {
    $sql = "SELECT tsm_date,tsm_timestamp,tsm_timestamp_out,
    COUNT(case when tsm_timestamp or tsm_timestamp_out is not null then 1 end ) as Work_Time,
    COUNT(case when tsm_timestamp > '08:00:00' then 1  end) as Late ,
    COUNT(case when tsm_timestamp and tsm_timestamp_out is null then 1  end ) as No_Time_Stamp_Out,
    COUNT(case when tsm_timestamp_out and tsm_timestamp is null then 0  end ) as No_Time_Stamp,
    COUNT(case when tsm_timestamp_out < '17:00:00' then 1  end) as Leave_early
    From  {$this->db_name}.tas_employee
        left JOIN {$this->db_name}.tas_timestamp 
        ON tas_employee.emp_id = tas_timestamp.emp_id
        where tsm_status_del = 0 AND $date 
        Group by tsm_date ";
    $query = $this->db->query($sql);
    return $query;
  }
}