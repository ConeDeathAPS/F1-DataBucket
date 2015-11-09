<?php

class Team extends CI_model
{
	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
		// $this->session->sess_destroy();
	}

	public function get_team_and_drivers_by_id($id)
	{
		return $this->db->query("SELECT teams.name AS team_name, teams.constructorID AS team_id, drivers1.name AS driver1_name, drivers2.name AS driver2_name, drivers1.driverID AS driver1_code, drivers2.driverID AS driver2_code, drivers1.id AS driver1_id, drivers2.id AS driver2_id FROM teams JOIN drivers AS drivers1 ON teams.driver1_id = drivers1.id JOIN drivers AS drivers2 ON teams.driver2_id = drivers2.id WHERE teams.id = " . $id)->row_array();
	}

}