<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Drivers</title>
	<link rel="stylesheet" href="Style/style_drivers.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="Materialize/css/materialize.css">
	<script type="text/javascript" src="Materialize/jquery.min.js"></script>
	<script type="text/javascript" src="Charter/Charter.js"></script>
	<script type="text/javascript" src="Materialize/js/materialize.min.js"></script>
	<script
	<script type="text/javascript">
	$(document).ready(function() {
        $("img").fadeIn("slow");
        $("h1").fadeIn("slow");
	})
	$(document).on("click", ".driver_select", function() {
		$("#background").fadeOut("slow");
		$("h1").fadeOut("slow");
		var driver = $(this).attr("id");
		// console.log(driver);
		$.get("get_driver/" + driver, function(driver_data) {
			// console.log(driver_data);
			$("#content").html(driver_data);
		}, "html");
		$(".dropdown-button").dropdown({
			alignment: 'right',
			constrain_width: false,
			belowOrigin: true
		});
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
			<li class="active"><a class="navi" name="Drivers" href="/drivers">Drivers</a></li>
			<li class=""><a class="navi" name="Teams" href="/teams">Teams</a></li>
			<li class=""><a class="navi" name="Tracks" href="/tracks">Tracks</a></li>
		</ul>
	</div>
</nav>
<ul id="slide-out" class="side-nav">
    <li><a class="driver_select" id="1" href="#">Lewis Hamilton</a></li>
    <li><a class="driver_select" id="2" href="#">Nico Rosberg</a></li>
    <li><a class="driver_select" id="3" href="#">Sebastian Vettel</a></li>
    <li><a class="driver_select" id="4" href="#">Kimi Raikkonen</a></li>
    <li><a class="driver_select" id="5" href="#">Felipe Massa</a></li>
    <li><a class="driver_select" id="6" href="#">Valttieri Bottas</a></li>
    <li><a class="driver_select" id="7" href="#">Daniil Kvyat</a></li>
    <li><a class="driver_select" id="8" href="#">Daniel Ricciardo</a></li>
    <li><a class="driver_select" id="9" href="#">Romain Grosjean</a></li>
    <li><a class="driver_select" id="10" href="#">Max Verstappen</a></li>
    <li><a class="driver_select" id="11" href="#">Sergio Perez</a></li>
    <li><a class="driver_select" id="12" href="#">Nico Hulkenberg</a></li>
    <li><a class="driver_select" id="13" href="#">Felipe Nasr</a></li>
    <li><a class="driver_select" id="14" href="#">Pastor Maldonado</a></li>
    <li><a class="driver_select" id="15" href="#">Fernando Alonso</a></li>
    <li><a class="driver_select" id="16" href="#">Carlos Sainz</a></li>
    <li><a class="driver_select" id="17" href="#">Marcus Ericsson</a></li>
    <li><a class="driver_select" id="18" href="#">Jenson Button</a></li>
    <li><a class="driver_select" id="19" href="#">Roberto Merhi</a></li>
    <li><a class="driver_select" id="20" href="#">Will Stevens</a></li>
</ul>
<div id="content">
    <img id="background" src="imgs/Sparks_Radillon.jpg" alt="Sparks_Radillon-background" hidden>
</div>
</body>
</html>