<?php
/*
    * Dashboad
    * show dashboard and get dashboard i
    * @author Weradet Nopsombun 62160110
    * @update Date 2564-05-01
*/
defined('BASEPATH') or exit('No direct script access allowed');
require dirname(__FILE__) . '/../TAS_controller.php';
class Dashboard extends TAS_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('mydate_helper.php');
        Set_Time_Zone();
        $this->load->model('M_tas_timestamp', 'tats');
    }

    /*
    *index
    *output view
    *@input 
    *@insert
    *@author Weradet Nopsombun 62160110
    *@Create Date 2564-04-13
    */

    public function index()
    {
        $this->output('Dashboard/v_dashboard');
    }


      /*
    * Function : show_table_timestamp_ajax
    * get data to display table
    * @input -
    * @author Sjita Maneechot 62160114
    * @Create Date 2564-05-02
    */

    public function show_table_timestamp_ajax()
    {
        $this->load->model('M_tas_timestamp', 'stts');


        //$date_today = get_date_today();

        $data['json_member'] = $this->stts->get_timestamp_data_today()->result();
        $data['json_message'] = 'success : show_table_timestamp_ajax';
        //var_dump($data['arr_emp']);
        echo json_encode($data);
    }



    public function chart_dashboard()
    {
        $this->load->model('M_tas_timestamp', 'dashboard');
        $data['CHART'] = $this->dashboard->get_timestamp_data_today()->result();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
        // var_dump($data);
    }


    /*
    *get_data_card_dashboard_ajax
    *output data in card
    *@input 
    *@insert
    *@author Weradet Nopsombun 62160110
    *@Create Date 2564-05-01
    */
    public function get_data_card_dashboard_ajax()
    {

        $this->load->model('M_tas_timestamp', 'dashboard');

        $date_today = get_date_today();

        $data = $this->dashboard->get_data_card_today($date_today)->result();

        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}