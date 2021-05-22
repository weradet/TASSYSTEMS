<?php

/*
    * Performance_result_ajax
    * load database to view
    * @author Wachiravit Pramjit 62160010
    * @Create Date 2564-04-26
*/
defined('BASEPATH') or exit('No direct script access allowed');
require dirname(__FILE__) . '/../TAS_controller.php';
class Performance_result_ajax extends TAS_controller
{
    /*
    * __construct
    * Load file model "M_tas_performance_result"  
    *@input -
    *@output-
    *@author Wachiravit Pramjit 62160010
    *@Create Date 2564-04-26
    */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_tas_performance_result', 'PF');
    }

    /*
    * index
    * show page view
    *@input -
    *@output-
    *@author Wachiravit Pramjit 62160010
    *@Create Date 2564-04-26
    */


    public function index()
    {
        $this->output('performance/v_performance_result_ajax');
    }


    /*
    * show_table_by_date
    * return data make table
    *@input date_first,date_secon
    *@output ข้อมูลลงเวลาในแต่ละช่วง (json)
    *@author Wachiravit Pramjit 62160010
    *@Create Date 2564-04-26
    */
    public function show_table_by_date()
    {

        $date_start = $this->input->post('date_first'); // รับค่าที่userกรอกไป input
        $date_end = $this->input->post('date_secon');
        $num = $this->input->post('emp_id');

        if($num != ""){
            $emp_id = "emp_code = ".$num;
        }else{
            $emp_id = true;
        }
        if($date_start != '' &&  $date_end != ''){
            $date_sql = "tsm_date between str_to_date('".$date_start."','%Y-%m-%d') AND '". $date_end."'" ;
        }else{
            $date_sql = true ;
        }
        
        $data['arr_emp'] = $this->PF->get_emp_by($date_sql, $emp_id)->result();
        // var_dump($data);
        // echo json_encode($data);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

     /*
    * get_data_chart 
    * return data make chart
    *@input date_first,date_secon,emp_id
    *@output ข้อมูลลงเวลาในแต่ละช่วงเพื่อนำไปสร้าง chart (json)
    *@author Wachiravit Pramjit 62160010
    *@Create Date 2564-04-30
    */
    public function get_data_chart()
    {
        $date_start = $this->input->post('date_first'); // รับค่าที่userกรอกไป input
        $date_end = $this->input->post('date_secon');
        $num = $this->input->post('emp_id');
        // '621600'
        if($num != ""){
            $emp_id = "emp_code = ".$num;
        }else{
            $emp_id = true;
        }
        if($date_start != '' &&  $date_end != ''){
            $date_sql = "tsm_date between str_to_date('".$date_start."','%Y-%m-%d') AND '". $date_end."'" ;
        }else{
            $date_sql = true ;
        }
        echo $num;
        $data['CHART'] = $this->PF->get_data_chart($date_sql, $emp_id)->result();
        // var_dump($data);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

     /*
    * export_excel 
    * export file excel
    *@input date_first,date_secon,emp_id
    *@output ไฟล์ excel
    *@author Wachiravit Pramjit 62160010
    *@Create Date 2564-04-26
    */

    public function export_excel($date_start,$date_end,$emp_id)
    {
        if($date_start != 'true' &&  $date_end != 'true'){
            $date_sql = "tsm_date between str_to_date('".$date_start."','%Y-%m-%d') AND '". $date_end."'" ;
        }else if($date_end == 'true'){
            $date_sql = true ;
        }
        if($emp_id != 'true'){
            $emp_id = 'emp_code = '.$emp_id;
        }else{
            $emp_id = true;
        }
        
        $data = $this->PF->get_emp_by($date_sql,$emp_id)->result_array();

        $arr = ['Employee ID','Firstname','Lastname','Work Time','Late','No Time Stamp in','No Time Stamp out'];
        $filename = "Report.xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attanchment; filename=\"$filename\"");
        $header = false;
        foreach ($data as $row) {
            if ($header == false) {
                if($date_start != 'true' &&  $date_end != 'true'){
                    echo "Performance Result ".$date_start.' - '.$date_end."\n";
                }else{
                    echo "Performance Result All Date"."\n";
                }
                echo implode("\t", $arr) . "\n";
                $header = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
        exit();
    }

}
