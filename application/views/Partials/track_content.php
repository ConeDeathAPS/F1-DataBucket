<script type="text/javascript">
var get_function;
//================USE API TO GET FASTEST LAPS===============//
function get_track_laps()
{
	//prepare object formatting
	var data = {
		years: [],
		times: [],
		drivers: []
	};
	track = "<?= $track_info['name']; ?>";
	//looping through years to get lap records
	//HTTP requests must be synchronous, otherwise years will be out of order or there will be duplicates. Unfortunately this also makes the requests very slow. Working on a solution...
	jQuery.ajaxSetup({async:false});
	var year = 2004;
	get_function = window.setInterval(function() {
		console.log("Entering get function", year);
		if (year < 2016) {
			$.get("http://ergast.com/api/f1/" + year + "/circuits/" + track + "/fastest/1/results.json", function(lap_data) {
				//push laptimes/years into the object
				if (lap_data.MRData.RaceTable.Races[0]) {
					data.times.push(lap_data.MRData.RaceTable.Races[0].Results[0].FastestLap.Time.time);
					data.years.push(lap_data.MRData.RaceTable.Races[0].season);
					data.drivers.push(lap_data.MRData.RaceTable.Races[0].Results[0].Driver.givenName + ' ' + lap_data.MRData.RaceTable.Races[0].Results[0].Driver.familyName);					
				} else {
					data.times.push("No Race");
					data.years.push(year);
					data.drivers.push("No Race");
				}
				$(".determinate").css({width: "+=100%"});
				year++;
				console.log(data);
			}, "json");
		} else {
			console.log("Done getting laps");
			if ($("#laps").html()) {
				draw_laps(data);				
			}
			clearInterval(get_function);
			return true;
		}
	}, 50);
}
//===================END F1 API GET FUNCTION=================//
function draw_laps(data) {
	console.log("Drawing fastest laps");
	var track_data = data;
	console.log("track_data", track_data);
	$(".progress").hide();
	for (i = 0; i < track_data.times.length; i++) {
		$("#laps").append("<li>" + track_data.years[i] + " -- " + track_data.times[i] + " -- " + track_data.drivers[i] + "</li>");
	}
}

$(document).ready(function() {
	$('.modal-trigger').leanModal();

	//call the draw laps function with get_track_laps as a callback
	get_track_laps();
})
</script>
<!--=======================================BEGIN HTML CONTENT==================================-->
<img id="background" src="imgs/track_pics/<?= $track_info['id']; ?>.jpg" alt="Track picture">

<div id="information" style="padding:15px; background-color:rgba(0, 0, 0, .7);, color:white; position:absolute; top:5%; left:1%; width:700px;">
	<h2 style="color:white; display:inline-block;">Track Information</h2>
	<button data-target="layout_modal" class="btn modal-trigger" name="pop_out" style="display:inline-block; margin-bottom:28px; margin-left:63px;">Layout</button>
	<p style="color: white;"><?= $track_info['info']; ?></p>
	<h3 style="color: white;">Fastest Laps</h3>
	<ul id="laps" style="color: white;">
		<div class="progress">
	        <div class="determinate" style="width: 0%"></div>
	    </div>
	</ul>
</div>

<div id="layout_modal" class="modal">
	<div class="modal-content">
	  	<h4>Track Layout</h4>
	  	<img id="layout" src="imgs/track_pics/<?= $track_info['id']; ?>_layout.png" style="width: 1000px; height:612px">
	</div>
	<div class="modal-footer">
	  	<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Done</a>
	</div>
</div>


<div id="map" style="height:650px; width:700px;position:absolute!important; left:50%; top:5%;"> 

</div>
<!--=======================================END HTML CONTENT==================================-->
<!--======================================BEGIN GOOGLE API===================================-->
<script type="text/javascript">
	var map;
    function initMap() {	
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: <?= $track_info['lat']; ?>, lng: <?= $track_info['longi']; ?>},
        zoom: 15
      });
    }
</script>
<script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWKimov_HnSOGsSoEyP0RUvcV4HVNTzXg&callback=initMap">
</script>
<!--======================================END GOOGLE API===================================-->