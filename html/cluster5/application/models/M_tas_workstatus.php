<?php

/*
    * Da_workstatus
    * โมเดลสำหรับ query เท่านั้น
    * @author Natdanai Intasorn 62160150
    * @update Date 2564-04-13
*/

defined('BASEPATH') or exit('No direct script access allowed');

include_once 'Da_workstatus.php';
class M_tas_workstatus extends Da_workstatus
{
    public function __construct()
    {
        parent::__construct();
    }


    /*
    * Function : get_table_by
    * query table form tas_employee left join tas_timestamp where date
    *@parameter $date
    *@author Natdanai Intasorn 62160150
    *@Create Date 2564-04-30
    */

    function get_table_by($date)
    {

        $sql = "SELECT *,
        DATE_FORMAT(tsm_timestamp, '%H:%i') AS Time_in,
        DATE_FORMAT(tsm_timestamp_out, '%H:%i') AS Time_out,
        DATE_FORMAT(TIMEDIFF(tsm_timestamp_out, tsm_timestamp), '%H:%i') AS Working
        FROM  {$this->db_name}.tas_employee
        LEFT JOIN {$this->db_name}.tas_timestamp
        ON tas_employee.emp_id = tas_timestamp.emp_id
        WHERE tsm_date like '$date' and tsm_status_del like '0' and emp_type = '0'";

        $query = $this->db->query($sql);
        return $query;
    }

    /*
    * Function : get_search_by
    * query table form tas_employee left join tas_timestamp where date and employee id
    *@parameter $date, $emp_id
    *@author Natdanai Intasorn 62160150
    *@Create Date 2564-04-30
    */

    function get_search_by($date, $emp_id)
    {

        $sql = "SELECT *,
        DATE_FORMAT(tsm_timestamp, '%H:%i') AS Time_in,
        DATE_FORMAT(tsm_timestamp_out, '%H:%i') AS Time_out,
        DATE_FORMAT(TIMEDIFF(tsm_timestamp_out, tsm_timestamp), '%H:%i') AS Working
        FROM  {$this->db_name}.tas_employee
        LEFT JOIN {$this->db_name}.tas_timestamp
        ON tas_employee.emp_id = tas_timestamp.emp_id
        WHERE $date and $emp_id and tsm_status_del like '0' and emp_type = '0'";

        $query = $this->db->query($sql);
        return $query;
    }

    /*
    * Function : get_stamp_by
    * query table form tas_timestamp left join tas_employee where tsm_id
    *@parameter $tsm_id
    *@author Natdanai Intasorn 62160150
    *@Create Date 2564-04-30
    */
    function get_stamp_by($tsm_id)
    {

        $sql = "SELECT *,
        DATE_FORMAT(tsm_timestamp, '%H:%i') AS Time_in,
        DATE_FORMAT(tsm_timestamp_out, '%H:%i') AS Time_out,
        DATE_FORMAT(TIMEDIFF(tsm_timestamp_out, tsm_timestamp), '%H:%i') AS Working
        FROM  {$this->db_name}.tas_timestamp
        LEFT JOIN {$this->db_name}.tas_employee
        ON tas_employee.emp_id = tas_timestamp.emp_id
        WHERE tsm_id like '$tsm_id' and emp_type = '0'";

        $query = $this->db->query($sql);
        return $query;
    }

    /*
    * Function : get_restore_timestamp
    * query table form tas_timestamp left join tas_employee where tsm_status_del = 1
    *@author Natdanai Intasorn 62160150, Mattaneeya Phosrisuk 62160334
    *@Create Date 2564-05-10
    */
    function get_restore_timestamp()
    {
        $date = get_date_today();
        $sql = "SELECT *,
        DATE_FORMAT(tsm_timestamp, '%H:%i') AS Time_in,
        DATE_FORMAT(tsm_timestamp_out, '%H:%i') AS Time_out,
        DATE_FORMAT(TIMEDIFF(tsm_timestamp_out, tsm_timestamp), '%H:%i') AS Working
        FROM  {$this->db_name}.tas_timestamp
        LEFT JOIN {$this->db_name}.tas_employee
        ON tas_employee.emp_id = tas_timestamp.emp_id
        WHERE tsm_status_del like '1' and emp_type = '0' and tsm_date = '$date'" ;

        $query = $this->db->query($sql);
        return $query;
    }

    
    /*
    * Function : get_old_timestamp
    * query table form tas_old_timestamp  where tsm_id = ?
    *@author Natdanai Intasorn 62160150
    *@Create Date 2564-05-12
    */
    function get_old_timestamp($tsm_id)
    {
        $sql = "SELECT *,
        DATE_FORMAT(ots_old_timestamp, '%H:%i') AS Time_in,
        DATE_FORMAT(ots_old_time_out, '%H:%i') AS Time_out
        FROM  {$this->db_name}.tas_old_timestamp
        WHERE tsm_id like '$tsm_id'";

        $query = $this->db->query($sql);
        return $query;
    }
}
