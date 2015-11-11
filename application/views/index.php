<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>F1 DataBucket</title>
	<link rel="stylesheet" href="Style/style_home.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="Materialize/css/materialize.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="Materialize/js/materialize.min.js"></script>
	<script type="text/javascript">
	function home()
	{
		$.get("/home/home_index", function(partial_data) {
		$("#main").html(partial_data);
		}, "html");	
	};

	$(document).ready(function() {
		home();
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
		<a href="#" class="dropdown-button" data-activates="nav-dropdown"><i class="fa fa-bars fa-2"></i></a>
		<ul id="nav-dropdown" class="dropdown-content">
			<li><a href="/" class="btn btn-nav">Home</a></li>
			<li><a href="/drivers" class="btn btn-nav">Drivers</a></li>
			<li><a href="/teams" class="btn btn-nav">Teams</a></li>
			<li><a href="/tracks" class="btn btn-nav">Tracks</a></li>
		</ul>
		<ul id="nav-mobile" class="right separate-buttons">
			<li class="active"><a class="navi" name="Home" href="/">Home</a></li>
			<li class=""><a class="navi" name="Drivers" href="/drivers">Drivers</a></li>
			<li class=""><a class="navi" name="Teams" href="/teams">Teams</a></li>
			<li class=""><a class="navi" name="Tracks" href="/tracks">Tracks</a></li>
		</ul>
	</div>
</nav>
<div id="main">
	
</div>
</body>
</html>