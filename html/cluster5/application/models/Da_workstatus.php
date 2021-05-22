<?php

/*
    * Da_Da_workstatus
    *โมเดลสำหรับ insert Update Deleteเท่านั้น
    * @author Natdanai Intasorn 62160150
    * @update Date 2564-04-13
*/ 

defined('BASEPATH') or exit('No direct script access allowed');

include_once 'tas_model.php';
class Da_workstatus extends tas_model
{
    public $tsm_id;
    public $tsm_timestamp;
    public $tsm_timestamp_out;
    public $tsm_edit_status = 1;
    public $ots_admin_note;
    public $ots_admin_sig;
    public $ots_old_timestamp;
    public $ots_old_time_out;
    public $emp_id;
    public $tsm_status_del = 1;


    public function __construct()
    {
        parent::__construct();
    }

/*
    * Function : insert_old_timestamp
    * insert old timestamp
    *@input -
    *@author Natdanai Intasorn 62160150
    *@Create Date 2564-04-30
    */
    public function insert_old_timestamp()
    {
        $sql = "INSERT INTO {$this->db_name}.tas_old_timestamp(
            ots_old_timestamp,
            ots_old_time_out,
            ots_admin_note,
            ots_admin_sig,
            tsm_id
        )
        VALUES(?,?,?,?,?)";

        $this->db->query($sql, array(
            $this->ots_old_timestamp, $this->ots_old_time_out, $this->ots_admin_note,
            $this->ots_admin_sig, $this->tsm_id
        ));
    }

    /*
    * Function : update_timestamp
    * update timestamp in table tas_timestamp
    *@input -
    *@author Natdanai Intasorn 62160150
    *@Create Date 2564-04-30
    */
    public function update_timestamp()
    {
        $sql = "UPDATE {$this->db_name}.tas_timestamp
            SET tsm_timestamp=?,tsm_timestamp_out=?,tsm_edit_status=?
            WHERE tsm_id= ?";

        $this->db->query($sql, array(
            $this->tsm_timestamp, $this->tsm_timestamp_out, $this->tsm_edit_status, $this->tsm_id
        ));
    }

     /*
    * Function : delete_timestamp
    * update tsm_status_del is 1 form table timestamp 
    *@input -
    *@author Mattaneeya Phosrisuk 62160334
    *@Create Date 2564-05-06
    */
    public function delete_timestamp()
    {
        $sql = "UPDATE {$this->db_name}.tas_timestamp
       SET tsm_status_del=?
       WHERE tsm_id = ?";

        $this->db->query($sql, array(
            $this->tsm_status_del, $this->tsm_id
        ));
    }

    /*
    * Function : restore_status_del
    * update tsm_status_del is 0 form table timestamp 
    *@input -
    *@author Natdanai Intasorn 62160150
    *@Create Date 2564-05-10
    */
    public function restore_status_del()
    {
        $sql = "UPDATE {$this->db_name}.tas_timestamp
            SET tsm_status_del=0
            WHERE tsm_id= ?";

        $this->db->query($sql, array(
            $this->tsm_id
        ));
    }
}
