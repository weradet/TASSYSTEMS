<?php

   function Set_Time_Zone(){
        date_default_timezone_set('Asia/Bangkok');
   }

   function get_date_today(){
         return date("Y-m-d");
    }

    function get_time_now(){
         return date("H:i");
    }

    function get_date_mouth(){
         return date("Y-m");
    }
    

?>