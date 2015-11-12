<script type="text/javascript" src="Charter/Charter.js"></script>
<script type="text/javascript">
var data = [];

function getHistory(category) {
	var constructor = "<?= $data['team_id'] ?>";
	// console.log(constructor);
	console.log("In getHistory");
	$.ajaxSetup({async:false});
	for (var year = 1990; year < 2016; year++) {
		var object = {};
		var start = new Date().getTime();
		$.get("http://ergast.com/api/f1/" + year + "/constructors/" + constructor + "/constructorStandings.json", function(response) {
            console.log("Request", year - 1989, "of 26 returned in", new Date().getTime() - start, "milliseconds.");
			if (response.MRData.StandingsTable.StandingsLists.length === 1) {
				object.points = response.MRData.StandingsTable.StandingsLists[0].ConstructorStandings[0].points;
				object.position = response.MRData.StandingsTable.StandingsLists[0].ConstructorStandings[0].position;
				object.wins = response.MRData.StandingsTable.StandingsLists[0].ConstructorStandings[0].wins;
			} else {
				object.points = 0;
				object.position = 0;
				object.wins = 0;
			}	
			data.push(object);			
		}, 'json');	
		// console.log(data);
	}
	if (data.length === 26) {
		return parseData(category, data);
	}			
}

//use the category to parse through the initial data object and pull out the necessary information
function parseData(category, data) {

	var final_data = [];
	if (category === "position" && final_data[0] === undefined) {
		for (i = 0; i < data.length; i++) {
			final_data.push(data[i].position);
		}
		// console.log(final_data);
		return drawGraph(category, final_data);
	} else if (category === "points" && final_data[0] === undefined) {
		for (i = 0; i < data.length; i++) {
			final_data.push(data[i].points);
		}
		// console.log(final_data);
		return drawGraph(category, final_data);
	} else if (category === "wins" && final_data[0] === undefined) {
		for (i = 0; i < data.length; i++) {
			final_data.push(data[i].wins);
		}
		// console.log(final_data);
		return drawGraph(category, final_data);
	}
}

function drawGraph(graph_type, data_parsed) {

    var name = "";
    var chars = graph_type.split("");
    // console.log(chars);
    chars[0] = chars[0].toUpperCase();
    for (each in chars) {
        name += chars[each];
    }

    Charter.get_styling({
        bar_color: "rgba(255, 0, 0, .6)",
        chart_background: "none",
        label_background: "none",
        label_color: "white",
        header_color: "white",
        chart_name: name,
        x_axis_labels: ["1990", "1991", "1992", "1993", "1994", "1995", "1996", "1997", "1998", "1999", "2000", "2001", "2002", "2003", "2004", "2005", "2006", "2007", "2008", "2009", "2010", "2011", "2012", "2013", "2014", "2015"],
        y_axis_labels: [],
        bar_label_color: "white",
        border_color: "black",
        bar_easing: "none"
    });
    Charter.draw_chart("constructor_graph", data_parsed, 400, 1575);
}

//when a graph button is clicked, begin the process of making API requests and parsing/charting the data
$(document).on("click", ".btn", function() {
	$(".progress").show();
	var category = $(this).attr("id");
	if ($("#chart_container").html() === undefined) {
		$("#progress_indicators").show();
		getHistory(category);			
	} else {
		parseData(category, data);
	}
});
</script>
<link rel="stylesheet" href="Style/style_team_content.css">
<div class="team_info">
	<div class="main_content">
		<h1><?= $data['team_name']; ?></h1>
		<img src="/imgs/<?= $data['team_id']; ?>.jpg" alt="Constructor car" id="car">
	</div>
	<ul class="graph_getters">
		<li><button id="position" class="btn">WCC Standings</button></li>
		<li><button id="points" class="btn">WCC Points</button></li>		
		<li><button id="wins" class="btn">Race Wins</button></li>
	</ul>
	<div id="drivers">
		<h4><?= $data['driver1_name']; ?></h4>
		<h4><?= $data['driver2_name']; ?></h4>
	</div>
	<div id="constructor_graph">
        <div id="progress_indicators" hidden>
            <h4>Getting driver data...<span id="percent"></span>%</h4>
            <div class="progress">
                <div class="determinate"></div>
            </div>            
        </div>
	</div>

</div>