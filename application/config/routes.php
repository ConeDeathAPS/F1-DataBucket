<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "home";
$route['driver/(:num)'] = "drivers/get_driver/$1";
$route['get_track/(:num)'] = "tracks/get_track_by_id/$1";
$route['get_driver/(:num)'] = "drivers/get_driver/$1";
$route['get_team/(:num)'] = "teams/get_team_and_drivers/$1";

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */