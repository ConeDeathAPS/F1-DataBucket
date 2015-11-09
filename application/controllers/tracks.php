<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tracks extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
		// $this->session->sess_destroy();
	}

	public function index()
	{
		$this->load->view("Partials/tracks");
	}

	public function new_track()
	{
		$this->load->model("Track");

		$track_data = $this->input->post();
		// var_dump($track_data);
		// die();
		$this->Track->insert_track($track_data);
		redirect("/home/add_new");
	}

	public function get_track_by_id($id)
	{
		$this->load->Model("Track");
		$track_info = $this->Track->get_track($id);
		// var_dump($track_info);
		// die();
		$this->load->view("Partials/track_content", array("track_info" => $track_info));
	}

	public function get_track_laps($id)
	{
		$this->load->Model("Track");
		
	}

}