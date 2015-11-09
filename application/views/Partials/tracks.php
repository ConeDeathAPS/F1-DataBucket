<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tracks</title>
    <link rel="stylesheet" href="Style/style_tracks.css">
    <link rel="stylesheet" type="text/css" href="Materialize/css/materialize.css">
    <script type="text/javascript" src="Materialize/jquery.min.js"></script>
    <script type="text/javascript" src="Materialize/js/materialize.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("h1").fadeIn("slow");
        $("#background").fadeIn("slow");
        $.get("http://ergast.com/api/f1/drivers", function(driver_data) {

        })
    })
    $(document).on("click", ".tclick", function() {
    console.log("Clicked");
    var id = $(this).attr("id");
    $(".active").removeClass("active");
    $(this).parent().addClass("active");   
    $("h1").fadeOut("slow")
    $("#information").fadeOut("slow");
    $("#map").fadeOut("slow");
    $("#background").fadeOut("slow", function() {      
        $.get("/get_track/" + id, function(track_data) {
            // console.log(track_data);
            $("#content").html(track_data);
            }, "html");
        });
    })    
</script>
</head>
<body>
<nav>
    <div class="nav-wrapper z-depth-5">
        <a class="brand-logo center" href="#">F1 DataBucket</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li class=""><a class="navi" name="Home" href="/">Home</a></li>
            <li class=""><a class="navi" name="Drivers" href="/drivers">Drivers</a></li>
            <li class=""><a class="navi" name="Teams" href="/teams">Teams</a></li>
            <li class="active"><a class="navi" name="Tracks" href="/tracks">Tracks</a></li>
        </ul>
    </div>
</nav>
<ul id="slide-out" class="side-nav">
    <li class=""><a class="tclick" id="1" href="#">Melbourne</a></li>
    <li class=""><a class="tclick" id="2" href="#">Sepang</a></li>
    <li class=""><a class="tclick" id="3" href="#">Shanghai</a></li>
    <li class=""><a class="tclick" id="4" href="#">Bahrain</a></li>
    <li class=""><a class="tclick" id="5" href="#">Catalunya</a></li>
    <li class=""><a class="tclick" id="6" href="#">Monaco</a></li>
    <li class=""><a class="tclick" id="7" href="#">Circuit Gilles-Villeneuve</a></li>
    <li class=""><a class="tclick" id="8" href="#">Red Bull Ring</a></li>
    <li class=""><a class="tclick" id="9" href="#">Silverstone Circuit</a></li>
    <li class=""><a class="tclick" id="10" href="#">Hungaroring</a></li>
    <li class=""><a class="tclick" id="11" href="#">Spa-Francorchamps</a></li>
    <li class=""><a class="tclick" id="12" href="#">Monza</a></li>
    <li class=""><a class="tclick" id="13" href="#">Marina Bay</a></li>
    <li class=""><a class="tclick" id="14" href="#">Suzuka</a></li>
    <li class=""><a class="tclick" id="15" href="#">Sochi Autodrom</a></li>
    <li class=""><a class="tclick" id="16" href="#">Circuit of the Americas</a></li>
    <li class=""><a class="tclick" id="17" href="#">Sao Paolo</a></li>
    <li class=""><a class="tclick" id="18" href="#">Yas Marina Circuit</a></li>
</ul>

<div id="content">
        <img id="background" src="imgs/Merc_Wide.jpg" alt="Spa-Francorchamps-background" hidden>
        <h1 hidden>Choose a track.</h1>
</div>
</body>
</html>