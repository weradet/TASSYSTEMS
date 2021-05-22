<?php
defined('BASEPATH') or exit('No direct script access allowed');
require dirname(__FILE__) . '/../TAS_controller.php';
class Employees_list extends TAS_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_tas_employee', 'mte');
    }

    public function employees_list_show()
    {
        $data['arr_emp'] = $this->mte->get_emp()->result();
        echo json_encode($data);
    }
    public function index()
    {
        $this->output('employees_Management/v_employees_management');
    }

    public function insert_employees()
    {
        $this->load->model('Da_employee', 'dep');
        $emp_code = $this->input->post('emp_code');
        $emp_firstname = $this->input->post('emp_firstname');
        $emp_lastname = $this->input->post('emp_lastname');
        $this->dep->Add_employee($emp_code, $emp_firstname, $emp_lastname);
        echo json_encode(array("statusCode" => 200));
    }

    /*
    * show_edit
    * return data show edit
    * @input emp_code
    * @output data employee
    * @author Ponprapai Atsawanurak 62160102
    * @Create Date 2564-05-10
    */

    public function show_edit()
    {
        $emp_id = $this->input->post('emp_code');
        $this->load->model('M_tas_employee', 'mte');
        $data['json_emp'] = $this->mte->get_emp_by($emp_id)->row();

        echo json_encode($data);
    }

    /*
    * update_employee
    * return data date
    * @input  data old
    * @output New data
    * @author Ponprapai Atsawanurak 62160102
    * @Create Date 2564-05-10
    */

    public function update_employee()
    {
        $this->load->model('Da_employee', 'dep');
        $this->dep->emp_code = $this->input->post('emp_code');
        $this->dep->emp_firstname = $this->input->post('firstname');
        $this->dep->emp_lastname = $this->input->post('lastname');
        $this->dep->emp_username = $this->input->post('user_id');
        $this->dep->emp_password = $this->input->post('password');
        $delete_user = $this->input->post('delete_user');
        $check = $this->input->post('check_pass');
        if ($check == 'false') {
            $this->dep->emp_password = $this->input->post('password');
        } else {
            $this->dep->emp_password =  md5($this->input->post('password'));
        }
        if ($delete_user == 'true') {
            $this->dep->emp_username = null;
            $this->dep->emp_password = null;
        }

        $this->dep->update_employee();

        $data['json_massage'] = 'success : update_edit';
        echo json_encode($data);
    }

    /*
    * Position
    * Position Management
    * @author Preechaya Choosrithong 62160157
    * @Update Date 2562-05-11
    */

    public function delete_employee()
    {
        $this->load->model('Da_employee', 'del');
        // $this->load->model('M_tas_timestamp', 'mtts');
        $this->del->emp_code = $this->input->post('emp_code');
        // $result_id = $this->mtts->get_by_id($this->del->emp_code)->row();

        $this->del->delete_employee();

        $data['json_message'] = 'success : delete';
        echo json_encode($data);
    }

    public function max_id_show()
    {
        $this->load->model('M_tas_employee', 'mte');
        $data = $this->mte->get_last_id()->row();
        echo json_encode($data);
    }

    public function checkuser_available()
    {
        $emp_code = $this->input->post('id');

        $this->load->model('M_tas_employee', 'mte');  //load database
        $result = $this->mte->checkuser($emp_code)->row(); //function in model


        // var_dump($result);

        if ($result) {
            echo 1;
        } else{
            echo 2;
        }
    }



    public function get_user()
    {
        $this->load->model('M_tas_employee', 'mte');
        $user = $this->input->post('User_old_id');
        $pass = $this->input->post('old_pass');
        $pass = md5($pass);
        if ($this->mte->get_old_user($user, $pass)->row()) {
            $data['user'] = $this->mte->get_old_user($user, $pass)->result();
        } else {
            $data['user'] = false;
        }
        echo json_encode($data);
    }
}