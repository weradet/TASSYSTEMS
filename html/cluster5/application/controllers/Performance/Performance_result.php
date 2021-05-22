<?php

/*
    * Performance_result
    * load database to view
    *@input -
    *@output-
    * @author Wachiravit Pramjit 62160010
    * @Create Date 2564-04-13
*/
defined('BASEPATH') or exit('No direct script access allowed');
require dirname(__FILE__) . '/../TAS_controller.php';
class Performance_result extends TAS_controller
{
     /*
    * __construct
    * Load file model "M_tas_performance_result"  
    *@input -
    *@output-
    *@author Wachiravit Pramjit 62160010
    *@Create Date 2564-04-13
    */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_tas_performance_result', 'PF');
    }

    /*
    * show_table_all
    * Load file view "v_performance_result" 
    * Load file view "header" 
    * Load file view "javascript" 
    * Load file view "topbar"   
    * Load file view "footer"  
    *@input -
    *@author Wachiravit Pramjit 62160010
    *@Create Date 2564-04-13
    */

    public function index()
    {
        $data['arr_emp'] = $this->PF->Get_emp_all_name()->result();
        $data['CHART'] = $this->PF->get_data_chart()->result();
        $this->output('performance/v_performance_result', $data);
    }
    /*
    * show_table_by_date
    * Load file view "v_performance_result" 
    * Load file view "header" 
    * Load file view "javascript" 
    * Load file view "topbar"   
    * Load file view "footer"  
    *@input date_first,date_secon
    *@author Wachiravit Pramjit 62160010
    *@Create Date 2564-04-13
    */
    public function show_table_by_date()
    {
        if ($this->input->post('submit')) {
            $date_start = $this->input->post('date_first'); // รับค่าที่userกรอกไป input
            $date_end = $this->input->post('date_secon');
            $data['arr_emp'] = $this->PF->Get_emp_by($date_start, $date_end)->result();
            $data['CHART'] = $this->PF->get_data_chart_by($date_start, $date_end)->result();
            $this->output('performance/v_performance_result', $data);
        }
    }
   
	
}