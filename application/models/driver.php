<?php 

class Driver extends CI_model
{
	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
		// $this->session->sess_destroy();
	}

	public function insert_driver($driver_data)
	{
		$query = "INSERT INTO drivers (name, short_bio, interesting, nationality, DOB, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
		$values = array(
						"name" => $driver_data['driver_name'],
						"short_bio" => $driver_data['bio'],
						"interesting" => $driver_data['facts'],
						"nationality" => $driver_data['origin'],
						"DOB" => $driver_data['DOB']
						);
		return $this->db->query($query, $values);
	}

	public function get_driver_by_id($id)
	{
		return $this->db->query("SELECT * FROM drivers WHERE id = " . $id)->row_array();
	}

}