<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Teams</title>
	<link rel="stylesheet" href="Style/style_teams.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="Materialize/css/materialize.css">
	<script type="text/javascript" src="Materialize/jquery.min.js"></script>
	<script type="text/javascript" src="Materialize/js/materialize.min.js"></script>
	<script type="text/javascript" src="Materialize/jquery-ui.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$(".dropdown-button").dropdown({
			alignment: 'right',
			constrain_width: false,
			belowOrigin: true
		});
	})
	$(document).on("click", ".team_select", function() {
		$.get("get_team/" + $(this).attr("id"), function(data) {
			$("#content").html(data);
			console.log(data);
		}, 'html');
	})
	</script>
</head>
<body>
<nav>
	<div class="nav-wrapper z-depth-5">
		<a class="brand-logo center" href="#">F1 DataBucket</a>
		<a href="#" class="dropdown-button" data-activates="nav-dropdown"><i class="medium material-icons">reorder</i></a>
		<ul id="nav-dropdown" class="dropdown-content">
			<li><a href="/" class="btn btn-nav">Home</a></li>
			<li><a href="/drivers" class="btn btn-nav">Drivers</a></li>
			<li><a href="/teams" class="btn btn-nav">Teams</a></li>
			<li><a href="/tracks" class="btn btn-nav">Tracks</a></li>
		</ul>
		<ul id="nav-mobile" class="right separate-buttons">
			<li class=""><a class="navi" name="Home" href="/">Home</a></li>
			<li class=""><a class="navi" name="Drivers" href="/drivers">Drivers</a></li>
			<li class="active"><a class="navi" name="Teams" href="/teams">Teams</a></li>
			<li class=""><a class="navi" name="Tracks" href="/tracks">Tracks</a></li>
		</ul>
	</div>
</nav>

<ul id="slide-out" class="side-nav">
	<li><a id="1" class="team_select" href="#!">Mercedes AMG Petronas</a></li>
	<li><a id="2" class="team_select" href="#!">Scuderia Ferrari</a></li>
	<li><a id="3" class="team_select" href="#!">Williams Martini Racing</a></li>
	<li><a id="4" class="team_select" href="#!">Infiniti Red Bull Racing</a></li>
	<li><a id="5" class="team_select" href="#!">Lotus F1 Team</a></li>
	<li><a id="6" class="team_select" href="#!">Scuderia Toro Rosso</a></li>
	<li><a id="7" class="team_select" href="#!">Sahara Force India</a></li>
	<li><a id="8" class="team_select" href="#!">Sauber F1 Team</a></li>
	<li><a id="9" class="team_select" href="#!">McLaren Honda</a></li>
	<li><a id="10" class="team_select" href="#!0">Manor Marussia F1 Team</a></li>
</ul>

<div id="content">
</div>
</body>
</html>
