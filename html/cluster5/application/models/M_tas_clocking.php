<?php
/*
* clocking information
* query clocking information
* @author Thanisorn thumsawanit 62160088
* @Create Date 2564-04-24
* @update Date 2564-05-04
*/

defined('BASEPATH') or exit('No direct script access allowed');
include_once 'Da_performance_result.php';

class M_tas_clocking extends Da_performance_result
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('mydate_helper.php');
    }
    /*
    * get_clocking_by_date
    * query clocking information
    *@input date_start,date_end,emp_id
    *output clocking information
    *@author Thanisorn thumsawanit 62160088
    *@Create Date 2564-04-19
    */
    function get_clocking_by_date($date, $emp_id)
    {
        $sql = "SELECT *,
        DATE_FORMAT(TIMEDIFF(tsm_timestamp_out, tsm_timestamp), '%H:%i') AS diff,
        DATE_FORMAT(tas_timestamp.tsm_timestamp, '%H:%i') as tsm_timestamp,
        DATE_FORMAT(tas_timestamp.tsm_timestamp_out, '%H:%i') as tsm_timestamp_out
        From  {$this->db_name}.tas_employee
        left JOIN {$this->db_name}.tas_timestamp 
        ON tas_employee.emp_id = tas_timestamp.emp_id
        where tsm_status_del = 0 AND $emp_id AND $date 
        ORDER BY tsm_date";
        $query = $this->db->query($sql);
        return $query;
    } //get date,id,name,timestamp in,timestamp out,working hour by date range 
}