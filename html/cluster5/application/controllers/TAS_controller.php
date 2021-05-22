<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TAS_controller extends CI_Controller {
    /*
    *TAS_controller
    *Timestamp insert to database 
    * @author Weradet Nopsombun 62160110
    * @Create Date 2564-04-13
    */
	public function __construct()
    {
		parent::__construct();
    } 

	public function index()
	{
		redirect('Timestamp/Timestamp_input_ajax');
	}

	 public function output($view, $data=null)
    {
		$this->load->view('templete/header');
		$this->load->view('templete/javascript');
		$this->load->view('templete/topbar');
		$this->load->view($view, $data);
		$this->load->view('templete/footer');
    }
}

