<!--
    * Class : Da_login
    * For insert update delete
    * @author Natsuda Kuhasak 62160085
    * @Create Date 2564-04-20
-->
<?php
defined('BASEPATH') or exit('No direct script access allowed');

include_once 'tas_model.php';
class Da_login extends tas_model
{
    public $emp_username;
    public $emp_password;

    public function __construct(){
       parent::__construct();
    }
}

?>