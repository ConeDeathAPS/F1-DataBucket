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
// jQuery.ajaxSetup({async:true});
var getStats;
$(document).ready(function() {
    $("img").fadeIn("slow");
    $("h1").fadeIn("slow");
    //materialize dropdown initialization
    $('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrain_width: true,
      hover: false,
      gutter: 0,
      belowOrigin: true
    });
//==========================BEGIN API REQUEST AND DATA STORAGE=======================//
//this function gets only the required data, whether it be points, positions, or wins based upon the parameter passed in
function get_history(input) {
    $(".wdc_points").fadeOut("fast");
    var finished = false;
    //grab the driver code from db            
    var driver_id = $("#driver_name").html();          
    //create object for storage of data like {position: **, poinst: **, wins: **}
    var data = [];
    //for each year, get driver results and add them into the object
    var year = 2004;
    getStats = window.setInterval(function() {
        var count = 1;
        if (year < 2016 && count === 1) {
            var object = {};
            $.get("http://ergast.com/api/f1/" + year +"/drivers/" + driver_id + "/driverstandings.json", function(driver_standings) {
                //store data
                if (driver_standings.MRData.StandingsTable.StandingsLists[0] != undefined && count === 1) {
                    count = 0;
                    object.position = driver_standings.MRData.StandingsTable.StandingsLists[0].DriverStandings[0].position;
                    object.points = driver_standings.MRData.StandingsTable.StandingsLists[0].DriverStandings[0].points;
                    object.wins = driver_standings.MRData.StandingsTable.StandingsLists[0].DriverStandings[0].wins;
                    console.log("Pushing year", year);
                    data.push(object);
                    driver_standings = undefined;
                } else {
                    count = 0;
                    object.position = "0";
                    object.points = "0";
                    object.wins = "0";
                    console.log("Pushing year", year);
                    data.push(object);
                    driver_standings = undefined;
                }
                year++;
                return true;
            }, "json");
        } else if (!finished) {
            finished = true;
            console.log("Finished with requests", data);
            console.log("Done!");        
            parseData(input, data);
        }   
    }, 400);
}    
//==========================END API REQUEST AND DATA STORAGE=======================//
function parseData(category, data) {
    //stop the window.setInterval function
    clearInterval(getStats);  
    console.log("Data from API", data);
    var final_data = [];
    if (category === "position" && final_data[0] === undefined) {
        for (i = 0; i < data.length; i++) {
            final_data.push(data[i].position);
        }
        console.log(final_data);
        return drawGraph(category, final_data);
    } else if (category === "points" && final_data[0] === undefined) {
        for (i = 0; i < data.length; i++) {
            final_data.push(data[i].points);
        }
        console.log(final_data);
        return drawGraph(category, final_data);
    } else if (category === "wins" && final_data[0] === undefined) {
        for (i = 0; i < data.length; i++) {
            final_data.push(data[i].wins);
        }
        console.log("Final data", final_data);
        return drawGraph(category, final_data);
    }
}
//============================BEGIN FUNCTION TO DRAW GRAPH=========================//
//this function uses the provided array of data to draw a bar graph
function drawGraph(graph_type, data) { 
        //sort asynchronous AJAX requests
        // console.log(data);
        Charter.get_styling({
            bar_color: "rgba(255, 0, 0, .6)",
            chart_background: "#3c3c3c",
            label_background: "#3c3c3c",
            chart_name: graph_type,
            x_axis_labels: ["2004", "2005", "2006", "2007", "2008", "2009", "2010", "2011", "2012", "2013", "2014", "2015"],
            y_axis_labels: [],
            bar_label_color: "white",
            border_color: "black",
            bar_easing: "none"
        });
        Charter.draw_chart("wdc_points", data, 400, 800);  
}
//============================END FUNCTION TO DRAW GRAPH============================//
//============================BEGIN GRAPH DATA SELECTION============================//
//this function calls both the get_history and draw_graph functions
    $(document).on("click", ".graph_control", function() {
        //get the options selected
        // console.log("1");
        var option = $(this).attr("id");
        // console.log(option);
        //draw a graph with the data supplied by get_history which will take the option as a parameter
        get_history(option);
    });
//===============================END GRAPH DATA SELECTION===========================//
})
</script>

<?php 
if (isset($driver_info)) {
?>
    <h4 id="driver_name" hidden><?= $driver_info['driverID'] ?></h3>
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
    <div id="wdc_points">
        <div class="progress">
            <div class="determinate"></div>
        </div>
    </div>
    <?php
} ?>