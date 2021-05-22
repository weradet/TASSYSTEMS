<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
    * Da_timestamp
    *โมเดลสำหรับ insert Update Deleteเท่านั้น
    * @author Weradet Nopsombun 62160110
    * @update Date 2564-04-13
*/
include_once 'tas_model.php';
class Da_timestamp extends tas_model
{
    public $tsm_id;
    public $tsm_date;
    public $tsm_timestamp;
    public $tsm_timestamp_out;
    public $tsm_status_del;
    public $tsm_edit_status;
    public $emp_id;

    public function __construct()
    {
        parent::__construct();
    }


    /*
    * Function : insert_timestamp
    * get all insert data timestamp
    * @input -
    * @author Weradet Nopsombun 62160085
    * @Create Date 2564-04-21
    */
    public function insert_timestamp($emp_id)
    {
        $sql = "INSERT INTO {$this->db_name}.tas_timestamp(tsm_date,tsm_timestamp,emp_id) 
        VALUES (?, ?, ?)";

        $this->db->query($sql, array($this->tsm_date, $this->tsm_timestamp, $emp_id));
    }

    /*
    * Function : insert_timestamp_out
    * insert data timestamp only out  (foget timestamp)
    * @input -
    * @author Weradet Nopsombun 62160085
    * @Create Date 2564-04-21
    */
    public function insert_timestamp_out($emp_id)
    {

        $sql = "INSERT INTO {$this->db_name}.tas_timestamp(tsm_date,tsm_timestamp_out,emp_id) 
        VALUES (?, ?, ?)";

        $this->db->query($sql, array($this->tsm_date, $this->tsm_timestamp_out, $emp_id));
    }


    /*
    * Function : update_timeout
    * update data timestamp out 
    * @input -
    * @author Weradet Nopsombun 62160085
    * @Create Date 2564-04-21
    */
    public function update_timeout($emp_id)
    {
        $sql = "UPDATE {$this->db_name}.tas_timestamp SET tsm_timestamp_out = ?  
        WHERE tsm_date = ? AND emp_id = '$emp_id'";
        $this->db->query($sql, array($this->tsm_timestamp_out, $this->tsm_date));
    }


    /*
    * Function : update_timeout
    * update data timestamp out  when data has been deleteted
    * @input -
    * @author Weradet Nopsombun 62160085
    * @Create Date 2564-04-21
    */
    public function update_timeout_del($emp_id)
    {
        $sql = "UPDATE {$this->db_name}.tas_timestamp SET tsm_timestamp_out = ?, tsm_timestamp = ?, 
         tsm_status_del = ?
        WHERE tsm_date = ? AND emp_id =  '$emp_id'";

        $this->db->query($sql, array($this->tsm_timestamp_out, NULL, 0, $this->tsm_date));
    }

    /*
    * Function : update_timestamp
    * update data timestamp when data has been deleteted
    * @input -
    * @author Weradet Nopsombun 62160085
    * @Create Date 2564-04-21
    */
    public function update_timestamp_del($emp_id)
    {
        $sql = "UPDATE {$this->db_name}.tas_timestamp SET tsm_timestamp = ?, tsm_timestamp_out = ?, 
         tsm_status_del = ?
        WHERE tsm_date = ? AND emp_id =  '$emp_id'";

        $this->db->query($sql, array($this->tsm_timestamp, NULL, 0, $this->tsm_date));
    }
}