<?php

/*
    * Workstatus_output_ajax
    * load database to view
    * @author Natdanai Intasorn 62160150
    * @Create Date 2564-04-21
*/

defined('BASEPATH') or exit('No direct script access allowed');
require dirname(__FILE__) . '/../TAS_controller.php';
class Workstatus_output_ajax extends TAS_controller
{
    /*
    * __construct
    * Load file model "M_tas_workstatus"  
    * Load file helper "mydate_helper"  
    * Use function Set_Time_Zone for file helper
    *@input -
    *@output-
    *@author Natdanai Intasorn 62160150
    *@Create Date 2564-04-26
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_tas_workstatus', 'mws');
        $this->load->model('Da_workstatus', 'dws');
        $this->load->helper('mydate_helper.php');
        Set_Time_Zone();
    }

    /*
    * show_list
    * show page view
    *@input -
    *@output-
    *@author Natdanai Intasorn 62160150
    *@Create Date 2564-04-26
    */

    public function show_list()
    {
        $this->output('Workstatus/v_workstatus_ajax');
    }

    /*
    * get_emp_timestamp
    * show workstatus table
    *@input date_today วันที่ปัจจุบัน
    *@output json ข้อมูลการลงเวลา
    *@author Natdanai Intasorn 62160150
    *@Create Date 2564-04-26
    */

    public function get_emp_timestamp()
    {
        $date_today = get_date_today();
        $data['json_emp'] = $this->mws->get_table_by($date_today)->result();

        echo json_encode($data);
    }

    /*
    * show_table_by_date
    * show workstatus table by input date
    *@input date_today วันที่ และ ไอดี พนักงาน ที่ input เข้ามา
    *@output json ข้อมูลการลงเวลา
    *@author Natdanai Intasorn 62160150
    *@Create Date 2564-04-30
    */

    public function show_table_by_date()
    {

        $date_search = $this->input->post('date_search'); // รับค่าที่userกรอกไป input
        $num = $this->input->post('emp_id');

        if ($num != "") {
            $emp_id = "emp_code = " . $num;
        } else {
            $emp_id = true;
        }
        if($date_search != ''){
            $date_sql = "tsm_date = str_to_date('".$date_search."','%Y-%m-%d')" ;
        }else{
            $date_sql = true ;
        }
        // var_dump($date_sql);
        $data['json_date'] = $this->mws->get_search_by($date_sql, $emp_id)->result();

        echo json_encode($data);
    }

    /*
    * show_edit
    * show table edit
    *@input tsm_id
    *@output json ข้อมูลของ tsm_id
    *@author Natdanai Intasorn 62160150
    *@Create Date 2564-04-30
    */
    public function show_edit()
    {
        $tsm_id = $this->input->post('tsm_id');
        $data['json_emp'] = $this->mws->get_stamp_by($tsm_id)->result();

        echo json_encode($data);
    }

    /*
    * update_and_insert_timestamp
    * update and insert
    *@input tsm_id, tsm_timestamp, tsm_timestamp_out, ots_admin_note, ots_admin_sig, ots_old_timestamp, ots_old_time_out
    *@output ข้อความแสดง success 
    *@author Natdanai Intasorn 62160150
    *@Create Date 2564-05-04
    */
    public function update_and_insert_timestamp()
    {
        $this->dws->tsm_id = $this->input->post('tsm_id');
        $this->dws->tsm_timestamp = $this->input->post('new_timestamp');
        $this->dws->tsm_timestamp_out = $this->input->post('new_timestamp_out');
        $this->dws->ots_admin_note = $this->input->post('edit_note');
        $this->dws->ots_admin_sig = $this->input->post('admin');
        $this->dws->ots_old_timestamp = $this->input->post('tsm_timestamp');
        $this->dws->ots_old_time_out = $this->input->post('tsm_timestamp_out');

        $this->dws->insert_old_timestamp();
        $this->dws->update_timestamp();

        $data['json_massage'] = 'success : update_timestamp';
        echo json_encode($data);
    }

    /*
    * delete
    * เปลี่ยนสถานะ ที่ฟังก์ชั่น delete_timestamp
    *@input tsm_id
    *@output ข้อความแสดง success 
    *@author Mattaneeya Phosrisuk 62160334
    *@Create Date 2564-05-06
    */
    public function delete()
    {
        $this->dws->tsm_id = $this->input->post('tsm_id');
        $this->dws->delete_timestamp();

        $data['json_message'] = 'success : delete';


        echo json_encode($data);
    }

    /*
    * show_restore_timestamp
    * ทำการ Query ที่ Function : get_restore_timestamp
    *@output JSON Data
    *@author Natdanai Intasorn 62160150
    *@Create Date 2564-05-10
    */
    public function show_restore_timestamp()
    {
        $data['json_re'] = $this->mws->get_restore_timestamp()->result();

        echo json_encode($data);
    }

    /*
    * restore
    * เปลี่ยนสถานะ ที่ฟังก์ชั่น update_status_del
    *@input tsm_id
    *@output ข้อความแสดง success 
    *@author Natdanai Intasorn 62160150
    *@Create Date 2564-05-10
    */
    public function restore()
    {
        $this->dws->tsm_id = $this->input->post('tsm_id');
        $this->dws->restore_status_del();

        $data['json_message'] = 'success : delete';
        echo json_encode($data);
    }
    
    /*
    * show_old_timestamp
    * Show table history form old_timestamp
    *@input tsm_id
    *@output JSON data 
    *@author Natdanai Intasorn 62160150
    *@Create Date 2564-05-12
    */
    public function show_old_timestamp()
    {
        $tsm_id = $this->input->post('tsm_id');
        $data['json_re'] = $this->mws->get_old_timestamp($tsm_id)->result();

        echo json_encode($data);
    }

    
}

