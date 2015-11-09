<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="Materialize/css/materialize.css">
	<script type="text/javascript" src="Materialize/jquery.min.js"></script>
	<script type="text/javascript" src="Materialize/js/materialize.min.js"></script>
	<style type="text/css">
	textarea {
		width: 300px;
		height: 150px;
	}
	form {
		width: 500px;
	}
	body {
		padding: 20px;
	}
	* {
		margin: 5px;
	}

	</style>
</head>
<body>
<form action="/Tracks/new_track" method="post">
<h2>New Track</h2>
	<p>Name: <input type="text" name="track_name"></p>
	<p>Info: <textarea name="track_info"></textarea></p>
	<p>Fastest Lap: <input type="text" name="fastest_lap"></p>
	<p>Fastest Driver: <input type="number" name="fastest_driver"></p>
	<input type="submit">
</form>
<form action="/Drivers/new_driver" method="post">
	<h2>New Driver</h2>
	<p>Name: <input type="text" name="driver_name"></p>
	<p>Bio: <textarea name="bio"></textarea></p>
	<p>Facts: <textarea name="facts"></textarea></p>
	<p>Nationality: <input type="text" name="origin"></p>
	<p>DOB: <input type="date" name="DOB"></p>
	<input type="submit">
</form>
</body>
</html>