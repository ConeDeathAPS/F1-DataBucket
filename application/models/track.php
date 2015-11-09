<?php 

class Track extends CI_model
{
	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
		// $this->session->sess_destroy();
	}

	public function insert_track($track_data)
	{
		$query = "INSERT INTO tracks (name, info, fastest_lap, fastest_driver_id, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())";
		$values = array(
						"name" => $track_data['track_name'],
						"info" => $track_data['track_info'],
						"fastest_lap" => $track_data['fastest_lap'],
						"fastest_driver_id" => $track_data['fastest_driver']
						);
		return $this->db->query($query, $values);
	}

	public function get_track($id)
	{
		echo "Getting track in model" . $id;
		return $this->db->query("SELECT * FROM tracks WHERE id = " . $id)->row_array();
	}

}