<?php
include_once 'Da_timestamp.php';
class M_tas_timestamp extends Da_timestamp
{

    public function __construct()
    {
        parent::__construct();
    }

    /*
    * Function : get_timestamp_all_today
    * get all data timestamp only today 
    * @input -
    * @author Weradet Nopsombun 62160085
    * @Create Date 2564-04-21
    */


    public function get_timestamp_all_today($today)
    {

        $sql = "SELECT  
        DATE_FORMAT(tas_timestamp.tsm_timestamp, '%H:%i') as tsm_timestamp,  
        DATE_FORMAT(tas_timestamp.tsm_timestamp_out, '%H:%i') as tsm_timestamp_out,
        tas_employee.emp_code, tas_employee.emp_firstname, tas_employee.emp_lastname  
        
        From  {$this->db_name}.tas_timestamp
        LEFT JOIN {$this->db_name}.tas_employee
        ON tas_timestamp.emp_id = tas_employee.emp_id
        WHERE tsm_date = '$today' And tsm_status_del = 0
        Order by tsm_timestamp_out DESC, tsm_timestamp DESC
        ";

        $query = $this->db->query($sql);


        return $query;
    }


    /*
    * Function : get_timestamp_by_id
    * get all data timestamp by employee code
    * @input -
    * @author Weradet Nopsombun 62160085
    * @Create Date 2564-04-21
    */

    public function get_timestamp_by_id($today, $emp_code)
    {
        $sql = "SELECT * From  {$this->db_name}.tas_timestamp
         LEFT JOIN  {$this->db_name}.tas_employee
         ON tas_timestamp.emp_id = tas_employee.emp_id
         WHERE tsm_date = '$today' AND tas_employee.emp_code = '$emp_code' ";

        $query = $this->db->query($sql);
        return $query;
    }



     /*
    * Function : get_timestamp_by_id
    * get all data timestamp by employee code to show dashboard table
    * @input -
    * @author Weradet Nopsombun 62160085
    * @Create Date 2564-04-21
    */
    function get_timestamp_data_today()
    {
        $sql = "SELECT tsm_date , 
          COUNT(case when tsm_timestamp or tsm_timestamp_out is not null then 1 end ) as Work_Time,
          COUNT(case when tsm_timestamp > '08:00:00' then 1 end) as Late , 
          COUNT(case when tsm_timestamp_out < '17:00:00' then 1 end) as Live_early, 
          COUNT(case when tsm_timestamp is null then 1 end ) as NotSigingin, 
          COUNT(case when tsm_timestamp_out is null then 1 end ) as NotSignigout 
          FROM {$this->db_name}.tas_timestamp 
          where 
          (tas_timestamp.tsm_date >= ( CURDATE() - INTERVAL 15 DAY ) AND tas_timestamp.tsm_date < CURDATE() )
            AND tas_timestamp.tsm_status_del = 0     
             GROUP BY tsm_date";

        $query = $this->db->query($sql);
        return $query;
    }


     /*
    * Function : get_data_card_today
    * get all data timestamp by employee code
    * @input -
    * @author Weradet Nopsombun 62160085
    * @Create Date 2564-04-21
    */
    function get_data_card_today($date_today){
        $sql = "SELECT 
        COUNT(case when tsm_timestamp or tsm_timestamp_out is not null then 1 end ) as Work_Time,
        COUNT(case when tsm_timestamp > '08:00:00' then 1  end) as Late ,
        COUNT(case when tsm_timestamp is not null then 1  end ) as TodaySigingin,
        COUNT(case when tsm_timestamp_out is not null then 0  end ) as Time_Stamp_out
    
        FROM tas_timestamp
             where tas_timestamp.tsm_date = '$date_today' AND tas_timestamp.tsm_status_del = 0";

        $query = $this->db->query($sql);
        return $query;
    }

    /*
    * Function : get_by_id
    * get all data timestamp by employee code
    * @input -
    * @author Sjita Maneechot 62160114
    * @Create Date 2564-05-10
    */
    
    function get_by_id($emp_code){
        
        $sql = "SELECT emp_id
                FROM tas_employee
                WHERE emp_code = '$emp_code' ";

        $query = $this->db->query($sql);
        return $query;   
          
    }
    
}