<style type="text/css">
.bar {
    background-color: rgba(255, 0, 0, .6);
    margin: 2px 0;
}
.graph_labels {
    color: white;
}
</style>
<script type="text/javascript">
var data = [];
$(document).ready(function() {
    $("#info_container").fadeIn('slow');       
    //materialize dropdown initialization
    $('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrain_width: true,
      hover: false,
      gutter: 0,
      belowOrigin: true
    });
})

//==========================BEGIN API REQUEST AND DATA STORAGE=======================//
//this function gets only the required data, whether it be points, positions, or wins based upon the parameter passed in
function get_history(input) {
    var finished = false;
    //grab the driver code from db            
    var driver_id = $("#driver_name").html();          
    //for each year, get driver results and add them into the object
    //ajax must be synchronous, otherwise you get missing data or data in the wrong order
    $.ajaxSetup({async:false});
    //for each year between 2004 and 2015, request info for the selected driver from the Ergast API
    for (var year = 2004; year < 2016; year++) {
        var object = {};
        var start = new Date().getTime();
        $.get("http://ergast.com/api/f1/" + year +"/drivers/" + driver_id + "/driverstandings.json", function(driver_standings) {
            console.log("Request", year - 2003, "of 12 returned in", new Date().getTime() - start, "milliseconds.");
            //store data
            if (driver_standings.MRData.StandingsTable.StandingsLists[0]) {
                //fill the data object with the necessary information
                object.position = driver_standings.MRData.StandingsTable.StandingsLists[0].DriverStandings[0].position;
                object.points = driver_standings.MRData.StandingsTable.StandingsLists[0].DriverStandings[0].points;
                object.wins = driver_standings.MRData.StandingsTable.StandingsLists[0].DriverStandings[0].wins;
                // console.log("Pushing data for", driver_standings.MRData.StandingsTable.season);
                //push the filled object into the data array
                data.push(object);
            } else {
                //if the driver did not race, then store 0s for that year
                object.position = "0";
                object.points = "0";
                object.wins = "0";
                // console.log("Pushing 0s for", driver_standings.MRData.StandingsTable.season);
                data.push(object);
            }
        }, "json");
    }
    if (data.length == 12) {
        // console.log("Finished with requests", data);
        console.log("Done!");        
        parseData(input, data);
    } 
}    
//==========================END API REQUEST AND DATA STORAGE=======================//
//=================================BEGIN DATA PARSE================================//
function parseData(category, data) {
    //stop the window.setInterval function
    // console.log("Data from API", data);
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
        // console.log("Final data", final_data);
        return drawGraph(category, final_data);
    }
}
//=================================END DATA PARSE================================//
//============================BEGIN FUNCTION TO DRAW GRAPH=========================//
//this function uses the provided array of data to draw a bar graph
function drawGraph(graph_type, data) { 
    $("#progress_indicators").hide();
    //format the graph_type string
    var name = "";
    var chars = graph_type.split("");
    // console.log(chars);
    chars[0] = chars[0].toUpperCase();
    for (each in chars) {
        name += chars[each];
    }

    Charter.get_styling({
        bar_color: "rgba(255, 0, 0, .6)",
        chart_background: "#3c3c3c",
        label_background: "#3c3c3c",
        header_color: "white",
        chart_name: name,
        x_axis_labels: ["2004", "2005", "2006", "2007", "2008", "2009", "2010", "2011", "2012", "2013", "2014", "2015"],
        y_axis_labels: [],
        bar_label_color: "white",
        border_color: "black",
        easing: "none"
    });
    Charter.draw_chart("driver_graph", data, 353, 800);  
    $.ajaxSetup({async:true});
}
//============================END FUNCTION TO DRAW GRAPH============================//
//============================BEGIN GRAPH INITIALIZATION============================//
//this function begins the API/graphing cascade
$(document).on("click", ".graph_control", function() {
    var option = $(this).attr("id");
    //draw a graph with the data supplied by get_history which will take the option as a parameter
    
    if ($("#chart_container").html() != undefined) {
        console.log("Option changed...");
        parseData(option, data);
    } else {
        $("#progress_indicators").show(function() {
            get_history(option);               
        }); 
    }
});
//===============================END GRAPH INITIALIZATION===========================//
</script>

<?php 
if (isset($driver_info)) {
?>
<div id="info_container" hidden>
    <h4 id="driver_name" hidden><?= $driver_info['driverID'] ?></h4>
    <img class="driver_pic" src="/imgs/driver_pics/<?= $driver_info['id']; ?>.jpg" alt="Driver picture">
    <div id="driver_information">
        <h3>Date of birth</h3>
        <p><?= $driver_info['DOB']; ?></p>
        <h3>Country of origin</h3>
        <p><?= $driver_info['nationality']; ?></p>
        <h3>Interesting facts</h3>
        <p><?= $driver_info['interesting']; ?></p>
        <a class='dropdown-button btn' href='#' data-activates='data_select'>Graph Data</a>
        <ul id='data_select' class='dropdown-content'>
            <li><a class="graph_control" id="wins" href="#!">Race Wins</a></li>
            <li><a class="graph_control" id="points" href="#!">WDC Points</a></li>
            <li><a class="graph_control" id="position" href="#!">WDC Postion</a></li>
        </ul>        

    </div>
    <div id="driver_graph">
        <h4 id="progress_indicators" hidden>Getting driver data... <i class="fa fa-spinner fa-spin"></i></h4>         
    </div>
</div>
    <?php
} ?>