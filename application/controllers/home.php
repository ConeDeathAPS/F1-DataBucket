<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
		// $this->session->sess_destroy();
	}

	public function index()
	{
		$this->load->view("index");
	}
	public function home_index()
	{
		$this->load->view("Partials/index_partial");
	}
	public function add_new()
	{
		$this->load->view("driver_info");
	}
}