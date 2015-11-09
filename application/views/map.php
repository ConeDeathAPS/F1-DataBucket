<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<style type="text/css">
	body {
		height: 800px;
		width: 1200px;
	}
</style>
<body>
	
<div id="map" style="height:100%; width:100%;"> 
    Map should be here
</div>
<script type="text/javascript">
        var map;
        function initMap() {	
        	console.log("Got inside the function.");
          map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 24.467, lng: 54.603},
            zoom: 10
          });
        }
</script>
<script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWKimov_HnSOGsSoEyP0RUvcV4HVNTzXg&callback=initMap">
</script>



</body>
</html>