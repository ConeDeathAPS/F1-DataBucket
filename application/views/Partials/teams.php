<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Teams</title>
	<link rel="stylesheet" href="Style/style_teams.css">
	<link rel="stylesheet" type="text/css" href="Materialize/css/materialize.css">
	<script type="text/javascript" src="Materialize/jquery.min.js"></script>
	<script type="text/javascript" src="Materialize/js/materialize.min.js"></script>
	<script type="text/javascript" src="Materialize/jquery-ui.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {

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
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li><a href="/">Home</a></li>
			<li><a href="/drivers">Driver</a></li>
			<li class="active"><a href="/teams">Team</a></li>
			<li><a href="/tracks">Track</a></li>
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
	<h1 id="banner">Choose a team...</h1>
</div>
</body>
</html>
