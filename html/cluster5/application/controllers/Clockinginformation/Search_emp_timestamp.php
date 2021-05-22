<?php
/*
    * Search_emp_timestamp
    * load database to view
    * @author Thanisorn thumsawanit 62160088 
    * @update Date 2564-05-04
*/
defined('BASEPATH') or exit('No direct script access allowed');
require dirname(__FILE__) . '/../TAS_controller.php';
class Search_emp_timestamp extends TAS_controller
{

    /*
    * __construct
    * Load file model "M_tas_clocking"  
    * Load helper "mydate_helper.php"
    *@input -
    *@author Thanisorn thumsawanit 62160088 
    *@Create Date 2564-04-19
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('mydate_helper.php');
    }

    /*
    * table_by_date_show
    * Load file view "v_clocking_information" 
    *@input date_start,date_end
    *output ข้อมูลการลงเวลางาน (๋JSON)
    *@author Thanisorn thumsawanit 62160088
    *@Create Date 2564-04-19
    */
    public function table_by_date_show()
    {
        $date_start = $this->input->post('date_start'); // รับค่าที่userกรอกไป input
        $date_end = $this->input->post('date_end');
        $this->load->model('M_tas_clocking', 'mtc');
        $num = $this->input->post('emp_id');
        if ($num != "") {
            $emp_id = "emp_code = " . $num;
        } else {
            $emp_id = true;
        }
        if ($date_start != '' && $date_end != '') {
            $date_sql = "tsm_date between str_to_date('" . $date_start . "','%Y-%m-%d') AND '" . $date_end . "'";
        } else {
            $date_sql = true;
        }
        $data['arr_clocking'] = $this->mtc->get_clocking_by_date($date_sql, $emp_id)->result();
        //$this->output('clocking_information/v_clocking_information', $data);
        echo json_encode($data);
    } //แสดงข้อมูลในตาราง ที่ค้นหาด้วยข้อมูลวันที่ที่กรอกเข้าไป

    public function index()
    {
        $this->output('clocking_information/v_clocking_information');
    }
}