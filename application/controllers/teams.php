<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teams extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
		// $this->session->sess_destroy();
	}

	public function index()
	{
		$this->load->view("Partials/teams");
	}

	public function get_team_and_drivers($id)
	{
		$this->load->model("team");
		$data = $this->team->get_team_and_drivers_by_id($id);
		$this->load->view('Partials/team_content', array('data' => $data));
		// var_dump($data);
		// die();
	}


}