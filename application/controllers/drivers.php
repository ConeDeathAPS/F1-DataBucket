<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Drivers extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
		// $this->session->sess_destroy();
	}

	public function index()
	{
		$this->load->view("Partials/drivers");
		$this->load->view("Partials/drivers_info");
	}

	public function new_driver()
	{
		$this->load->model("driver");

		$driver_data = $this->input->post();
		// var_dump($driver_data);
		// die();
		$this->driver->insert_driver($driver_data);
		redirect("/home/add_new");
	}

	public function get_driver($id)
	{
		$this->load->model("driver");

		$driver_info = $this->driver->get_driver_by_id($id);
		
		// var_dump($driver_info);
		// die();

		$this->load->view("Partials/drivers_info", array("driver_info" => $driver_info));
	}

}