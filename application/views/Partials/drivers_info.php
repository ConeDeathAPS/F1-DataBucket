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
    //grab the driver code from db            
    var driver_id = $("#driver_name").html();          
    //create object for storage of data like 2004: [position, points, wins]
    var data = [];
    //for each year, get driver results and add them into the object
    for (var year = 2004; year <= 2015; year++) {
    //begin .get request passing in year and selected driver
        $.get("http://ergast.com/api/f1/" + year +"/drivers/" + driver_id + "/driverstandings.json", function(driver_standings) {
            //if the driver did not participate in the season for a given year, store 0s.
            if (driver_standings.MRData.StandingsTable.StandingsLists[0]) {
                var object = {[driver_standings.MRData.StandingsTable.season]: driver_standings.MRData.StandingsTable.StandingsLists[0].DriverStandings[0][input]}
                data.push(object);
            } else {
                data.push({[driver_standings.MRData.StandingsTable.season]: '0'});
            }
            if (data.length == 12) {
                draw_graph(data, input);              
            }     
        }, "json");   
    }
}     
function bubblesort_data(data) {
    console.log("In sort function: ", data);
    var swap = true
    while (swap) {
        swap = false;
        for (var i = 0; i < data.length-1; i++) {
            for (var x = i+1; x < data.length; x++) {
                if (Object.keys(data[i])[0] > Object.keys(data[x])[0]) {
                    var temp = data[i];
                    data[i] = data[x];
                    data[x] = data[i];
                    swap = true;
                }
            }
        }               
    }
    return data;
}
//==========================END API REQUEST AND DATA STORAGE=======================//
//============================BEGIN FUNCTION TO DRAW GRAPH=========================//
//this function uses the provided array of data to draw a bar graph
function draw_graph(data, graph_type) {
    if (data) {
        // console.log("5");
        //sort asynchronous AJAX requests
        var sorted_data = bubblesort_data(data);
        console.log(sorted_data);
        var graph_data = [];
        //pull out data from objects
        for (i=0; i < sorted_data.length; i++) {
            for (each in sorted_data[i]) {
                graph_data.push(sorted_data[i][each]);
            }
        }
        // console.log(graph_data);

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
        Charter.draw_chart("wdc_points", graph_data, 400, 800);  
    } 
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
</head>

<div id="content">
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
</div>