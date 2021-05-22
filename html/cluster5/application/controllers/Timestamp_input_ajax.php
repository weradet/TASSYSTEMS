<?php
defined('BASEPATH') or exit('No direct script access allowed');
    /*
    *Timestamp_input
    *Timestamp insert to database 
    * @author Weradet Nopsombun 62160110
    * @Create Date 2564-04-13
    */
class Timestamp_input_ajax extends CI_Controller
{
    /*
    * Class construct
    *call helper, call Model "M_tas_timestamp" Nickname tats
    *@input -
    *@insert -
    *@author Weradet Nopsombun 62160110
    *@Create Date 2564-04-13
    */

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('mydate_helper.php');
        //$this->load->Date_helper();
        Set_Time_Zone();
    }

    /*
    * index
    *
    *@input -
    *@insert -
    *@author Weradet Nopsombun 62160110
    *@Create Date 2564-04-13
    */
    public function index()
    {
        $this->load->view('templete/header');
        $this->load->view('templete/javascript');
        $this->load->view('timestamp/v_timestamp');
        $this->load->view('templete/footer');
    }

    /*
    *check_time_stamp_today
    *check number of timestamp
    *@input emp_code
    *@insert tsm_id tsm_timestamp
    *@author Weradet Nopsombun 62160110
    *@Create Date 2564-04-13
    *@Update Date 2564-05-09
    */
    public function check_time_stamp_today()
    {

        $this->load->model('M_tas_timestamp', 'tats');

        $date_today = get_date_today();

        $emp_code = $this->input->post('emp_code');

        $result = $this->tats->get_timestamp_by_id($date_today, $emp_code);

        $tsm_row = $result->row(); //row of employee

        if ($tsm_row && $tsm_row->tsm_status_del == "1") { //clocking is delelte 
            echo 1; //clocking is delelte 
        } else if ($tsm_row && $tsm_row->tsm_status_del == "0") {
            echo 2; //clocking is not delelte 
        } else {
            echo 0; //never clocking in today
        }
    } //Get_timestamp



    /*
    * update_timestamp_out
    *Insert Timestamp into database
    *@input emp_code
    *@insert tsm_id tsm_timestamp
    *@author Weradet Nopsombun 62160110
    *@Create Date 2564-04-13
    *@Update Date 2564-05-10
    */

    public function update_timestamp_out()
    {

        // first call function load model
        // next step call function helper mydate_helper
        // and get input form ajax v_timestamp
        // set attribute in Da_timestamp.php and make function Model 

        $this->load->model('M_tas_timestamp', 'tats');

        $date_today = get_date_today();
        $time_now = get_time_now();

        $emp_code = $this->input->post('emp_code'); // รับค่า input


        $data = $this->tats->get_by_id($emp_code);
        $data_rows = $data->row();
        // set attribute file Da_timestamp.php
        $this->tats->tsm_date = $date_today;
        $this->tats->tsm_timestamp_out = $time_now;

        $this->tats->update_timeout($data_rows->emp_id);
        // display sweet alert
        $this->display_timeout_swal_json_data($emp_code);
    }



    /*
    * update_timestamp_out_del
    *update Timestamp into database when status_del has delete
    *@input emp_code
    *@insert tsm_id tsm_timestamp
    *@author Weradet Nopsombun 62160110
    *@Create Date 2564-05-09
    */

    public function update_timestamp_out_del()
    {

        // first call function load model
        // next step call function helper mydate_helper
        // and get input form ajax v_timestamp
        // set attribute in Da_timestamp.php and make function Model 

        $this->load->model('M_tas_timestamp', 'tats');

        $date_today = get_date_today();
        $time_now = get_time_now();

        $emp_code = $this->input->post('emp_code'); // รับค่า input

        $data = $this->tats->get_by_id($emp_code);
        $data_rows = $data->row();
        // set attribute file Da_timestamp.php
        $this->tats->tsm_date = $date_today;
        $this->tats->tsm_timestamp_out = $time_now;

        $this->tats->update_timeout_del($data_rows->emp_id);
        // display sweet alert
        $this->display_timeout_swal_json_data($emp_code);
    }



    /*
    * insert_timestamp
    *Insert Timestamp into database
    *@input emp_code
    *@insert tsm_id tsm_timestamp
    *@author Weradet Nopsombun 62160110
    *@Create Date 2564-04-13
    *@Update Date 2564-05-10
     */

    public function insert_timestamp()
    {

        //   first call function load model
        // next step call function helper mydate_helper
        // and get input form ajax v_timestamp
        // set attribute in Da_timestamp.php and make function Model 

        $this->load->model('M_tas_timestamp', 'tats');

        $date_today = get_date_today();
        $time_now = get_time_now();

        $emp_code = $this->input->post('emp_code'); // รับค่า input

        $data = $this->tats->get_by_id($emp_code);
        $data_rows = $data->row();


        $this->tats->tsm_date = $date_today;  // 
        $this->tats->tsm_timestamp = $time_now;

        $this->tats->insert_timestamp($data_rows->emp_id);
        // display sweet alert
        $this->display_timestamp_swal_json_data($emp_code);
    }


    /*
    * update_timestamp_del
    *Insert Timestamp into database when data havebeen deleteted
    *@input emp_code
    *@insert tsm_id tsm_timestamp
    *@author Weradet Nopsombun 62160110
    *@Create Date 2564-04-13
    *@Update Date 2564-05-10
     */

    public function update_timestamp_del()
    {

        //   first call function load model
        // next step call function helper mydate_helper
        // and get input form ajax v_timestamp
        // set attribute in Da_timestamp.php and make function Model 

        $this->load->model('M_tas_timestamp', 'tats');

        $date_today = get_date_today();
        $time_now = get_time_now();

        $emp_code = $this->input->post('emp_code'); //input

        $data = $this->tats->get_by_id($emp_code);
        $data_rows = $data->row();

        $this->tats->tsm_date = $date_today;  
        $this->tats->tsm_timestamp = $time_now;

        $this->tats->update_timestamp_del($data_rows->emp_id);


        // display sweet alert
        $this->display_timestamp_swal_json_data($emp_code);
    }

    /*
    *insert_timestamp_out
    *Insert Timestamp out  into database
    *@input emp_code
    *@insert tsm_id tsm_timestamp
    *@author Weradet Nopsombun 62160110
    *@Create Date 2564-04-13
    *@Update Date 2564-05-10
    */

    public function insert_timestamp_out()
    {

        // first call function load model
        // next step call function helper mydate_helper
        // and get input form ajax v_timestamp
        // set attribute in Da_timestamp.php and make function Model 

        $this->load->model('M_tas_timestamp', 'tats');

        $date_today = get_date_today();
        $time_now = get_time_now();

        $emp_code = $this->input->post('emp_code'); 

        $data = $this->tats->get_by_id($emp_code);
        $data_rows = $data->row();

        $this->tats->tsm_date = $date_today;
        $this->tats->tsm_timestamp_out = $time_now;

        $this->tats->insert_timestamp_out($data_rows->emp_id);

        $this->display_timeout_swal_json_data($emp_code);
    }


    /*
    *get_timestamp_list_today_ajax
    *get data timestamp and create table
    *@input -
    *@insert tsm_id tsm_timestamp
    *@author Weradet Nopsombun 62160110
    *@Create Date 2564-04-13
    */
    public function get_timestamp_list_today_ajax()
    {
        $this->load->model('M_tas_timestamp', 'tats');

        $date_today = get_date_today();

        $data['json_timestamp'] = $this->tats->get_timestamp_all_today($date_today)->result();

        $data['json_message'] = 'success: get_timestamp_list_today_ajax';

        echo json_encode($data);
    }



    /*
    * get_employee_by_emp_code
    *Insert Timestamp into database
    *@input emp_code
    *@insert tsm_id tsm_timestamp
    *@author Weradet Nopsombun 62160110
    *@Create Date 2564-04-13
    */

    public function get_employee_by_emp_code($emp_code)
    {

        $this->load->model('M_tas_employee', 'tams');

        $employee_sql = $this->tams->get_emp_ajax_by_emp_code($emp_code);

        $row = $employee_sql->row(); //แถวของพนักงาน

        // var_dump($row);

        $employee = array();

        $emp_firstname = $row->emp_firstname;
        $emp_lastname = $row->emp_lastname;

        $employee['emp_firstname'] =  $emp_firstname;
        $employee['emp_lastname'] =  $emp_lastname;

        return $employee;
    }



    /*
    * Search_employee_ajax
    *Insert Timestamp into database
    *@input emp_code
    *@insert tsm_id tsm_timestamp
    *@author Weradet Nopsombun 62160110
    *@Create Date 2564-04-27
    */

    public function search_employee_ajax()
    {
        $emp_code = $this->input->post('emp_code');

        $this->load->model('M_tas_employee', 'mtem');

        $result = $this->mtem->get_emp_ajax_by_emp_code($emp_code);

        if ($result) {
            echo "1";
        } else {
            echo "2";
        }
    }


    /*
    * display_timeout_swal_json_data
    *display data in sweet alert
    *@input emp_code
    *@insert tsm_id tsm_timestamp
    *@author Weradet Nopsombun 62160110
    *@Create Date 2564-05-09
    */

    function display_timeout_swal_json_data($emp_code)
    {

        $arr_employee = $this->get_employee_by_emp_code($emp_code);

        $arr_response = array();
        $arr_response["arr_employee"] = $arr_employee;


        $time_out = array();
        $time_out = array("tsm_timestamp_out" => $this->tats->tsm_timestamp_out);

        $arr_response['time_out'] =  $time_out;


        $this->output->set_content_type('application/json')->set_output(json_encode($arr_response));
    }


    /*
    * display_timestamp_swal_json_data
    *display data in sweet alert
    *@input emp_code
    *@insert tsm_id tsm_timestamp
    *@author Weradet Nopsombun 62160110
    *@Create Date 2564-05-10
    */

    function display_timestamp_swal_json_data($emp_code)
    {
        $arr_employee = $this->get_employee_by_emp_code($emp_code);

        $arr_response = array();
        $arr_response["arr_employee"] = $arr_employee;

        $time_out = array("tsm_timestamp" => $this->tats->tsm_timestamp);
        $arr_response['time_out'] =  $time_out;

        $this->output->set_content_type('application/json')->set_output(json_encode($arr_response));
    }
}//class