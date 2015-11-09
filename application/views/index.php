<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>F1 DataBucket</title>
	<link rel="stylesheet" href="Style/style_home.css">
	<link rel="stylesheet" type="text/css" href="Materialize/css/materialize.css">
	<script type="text/javascript" src="Materialize/jquery.min.js"></script>
	<script type="text/javascript" src="Materialize/js/materialize.min.js"></script>
	<script type="text/javascript">
	function home()
	{
		$.get("/home/home_index", function(partial_data) {
		$("#main").html(partial_data);
		$("iframe").fadeIn("slow");
		}, "html");	
	};

	$(document).ready(function() {
		home();
	})
	</script>
</head>
<body>
<nav>
	<div class="nav-wrapper z-depth-5">
		<a class="brand-logo center" href="#">F1 DataBucket</a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
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