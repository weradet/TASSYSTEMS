<?php
    /*
    * Login_admin
    * Show Login
    * @author Natsuda Kuhasak 62160085
    * @Create Date 2564-04-19
    */
ob_start(); //เรียกเอาต์พุตบัฟเฟอร์ที่จุดเริ่มต้นของ index.php
defined('BASEPATH') or exit('No direct script access allowed');
class Login_admin extends CI_Controller
{
    /*
    * Class : __construct
    * Call helper
    * @input -
    * @author Natsuda Kuhasak 62160085
    * @Create Date 2564-04-19
    */
    public function __construct()
    {
        parent::__construct();
    }
    /*
    * Function : show_login
    * Show Login for Admin
    * @input -
    * @author Natsuda Kuhasak 62160085
    * @Create Date 2564-04-19
    */
    public function index($data = null)
    {
        $this->load->view('templete/header_login');
        $this->load->view('templete/javascript');
        $this->load->view('templete/topbar_login');
        $this->load->view('login/v_login',$data);
        $this->load->view('templete/footer');
    }
    /*
    * Function : input
    * Check numrow in database
    * @input -
    * @author Natsuda Kuhasak 62160085
    * @Create Date 2564-04-21
    */
    function input_login_form()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password'); //รับค่า username & password
        $password = md5($password);
        $this->load->model('M_tas_login', 'login');  //load database

        $this->login->emp_username =  $username;
        $this->login->emp_password = $password;

        $result = $this->login->login(); //function in model

        if ($result) {          
            $emp_username =  $result->emp_username;
            $emp_firstname = $result->emp_firstname;
            $emp_lastname =  $result->emp_lastname;

            $this->set_session($emp_username, $emp_firstname, $emp_lastname);
            redirect("Dashboard/Dashboard");
        } else {
            $data_warning = array();
            $data_warning['warning'] = "Username or password incorrect";

            $this->index($data_warning);
        }
    }
    /*
    * Function : logout
    * Logout and return to firstpage
    * @input -
    * @author Natsuda Kuhasak 62160085
    * @Create Date 2564-04-21
    */
    public function logout()
    {
        $this->remove_session();
        redirect(""); //จะกลับไปหน้า Timestamp
    }
    /*
    * Function : show_session
    * Call all session to show
    * @input -
    * @author Natsuda Kuhasak 62160085
    * @Create Date 2564-04-21
    */
    public function show_session()
    {
        $arr_session = $this->session->all_userdata();

        echo "<pre>";
        print_r($arr_session);
        echo "</pre>";
    }
    /*
    * Function : set_session
    * Set parameter in session
    * @input -
    * @author Natsuda Kuhasak 62160085
    * @Create Date 2564-04-21
    */
    public function set_session($username, $emp_firstname, $emp_lastname)
    {
        $this->session->set_userdata("username", "$username");
        $this->session->set_userdata("Admin_name", "$emp_firstname");
        $this->session->set_userdata("Admin_lastname", "$emp_lastname");
    }
    /*
    * Function : remove_session
    * Remove parameter in session
    * @input -
    * @author Natsuda Kuhasak 62160085
    * @Create Date 2564-04-21
    */
    public function remove_session()
    {
        $this->session->unset_userdata("username");
        $this->session->unset_userdata("Admin_name");
        $this->session->unset_userdata("Admin_lastname");
    }
}
