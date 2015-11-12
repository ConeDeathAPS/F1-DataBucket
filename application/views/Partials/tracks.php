<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tracks</title>
    <link rel="stylesheet" href="Style/style_tracks.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="Materialize/css/materialize.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="Materialize/js/materialize.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("h1").fadeIn("slow");
        $("#background").fadeIn("slow");
        $.get("http://ergast.com/api/f1/drivers", function(driver_data) {

        })
        $(".dropdown-button").dropdown({
            alignment: 'right',
            constrain_width: false,
            belowOrigin: true
        });
        $(".tracks-dropdown-button").dropdown({
            alignment: 'left',
            constrain_width: false,
            belowOrigin: true
        });
    })
    $(document).on("click", ".tclick", function() {
        console.log("Clicked");
        var id = $(this).attr("id");
        $(".active").removeClass("active");
        $(this).parent().addClass("active");   
        $.get("/get_track/" + id, function(track_data) {
            console.log(track_data);
            $("#content").html(track_data);
        }, "html");
    })    
</script>
</head>
<body>
<nav>
    <div class="nav-wrapper z-depth-5">
        <a href="#" class="tracks-dropdown-button" data-activates="tracks-dropdown"><i class="fa fa-globe fa-2"></i></a>    
        <a class="brand-logo center" href="#">F1 DataBucket</a>
        <a href="#" class="dropdown-button" data-activates="nav-dropdown"><i class="fa fa-bars fa-2"></i></a>
        <ul id="nav-dropdown" class="dropdown-content">
            <li><a href="/" class="btn btn-nav">Home</a></li>
            <li><a href="/drivers" class="btn btn-nav">Drivers</a></li>
            <li><a href="/teams" class="btn btn-nav">Teams</a></li>
            <li><a href="/tracks" class="btn btn-nav">Tracks</a></li>
        </ul>
        <ul id="nav-mobile" class="right separate-buttons">
            <li class=""><a class="navi" name="Home" href="/">Home</a></li>
            <li class=""><a class="navi" name="Drivers" href="/drivers">Drivers</a></li>
            <li class=""><a class="navi" name="Teams" href="/teams">Teams</a></li>
            <li class="active"><a class="navi" name="Tracks" href="/tracks">Tracks</a></li>
        </ul>
    </div>
</nav>

<ul id="tracks-dropdown" class="dropdown-content">
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
</div>
</body>
</html>