<?php
if (isset($_POST['logout'])) {
    setcookie("fatsecret_session_key", "", time()-3600);
    header("Location:index.php");

}

?>
<html>
<head>
    <title>Healthily- Your Personal Nutrionist</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="css/mainpage.css">
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

</head>
<script>
    function fd() {
        fatsecret.replaceCanvas("food_entries.edit");
    }
    function home() {
        fatsecret.replaceCanvas("home");
    }
    function dc() {
        fatsecret.replaceCanvas("calendar.get_month");
    }
    function ol() {
        /*var aTags = $("td a");
        var searchText = "more...";
        var found=5;

        for (var i = 0; i < aTags.length; i++) {
            if (aTags[i].innerHTML == searchText) {
                found = aTags[i];
                break;
            }
        }
        found.addEventListener("click",function () {
            $('#home').removeClass('active');
            $('#dc').addClass('active');
            // $('dc').click();
        },false);
        console.log(found.text);*/
        var currentTab = null;
        fatsecret.onTabChanged = function(tab_id) {
            if(currentTab) currentTab.style.fontWeight = "normal";
            currentTab = document.getElementById("nav_" + tab_id);
            if(currentTab) currentTab.style.fontWeight = "bold";
            if(tab_id==1){
                $('#home').addClass('active');
                $('#dc').removeClass('active');
                $('#fd').removeClass('active');
            }
            else if(tab_id==2){
                $('#fd').addClass('active');
                $('#dc').removeClass('active');
                $('#home').removeClass('active');
            }
            else if(tab_id==8){
                $('#dc').addClass('active');
                $('#home').removeClass('active');
                $('#fd').removeClass('active');
            }
        }
        $('#fatsecret_appTitle').text('Home');

    }



</script>
<body onload="ol()">
<nav class="navbar navbar-expand-md navbar-dark bg-warning">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand text-success" href="#" style="font-family: 'Arial Black'">Healthily-Your Personal Nutritionist</a>
    <div id="search"></div>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active" id="home">
                <a class="nav-link" href="#" onclick="home();">Home</a>
            </li>
            <li class="nav-item" id="fd">
                <a class="nav-link" href="#" onclick="fd();">Food Diary</a>
            </li>
            <li class="nav-item" id="dc">
                <a class="nav-link" href="#" onclick="dc();">Diet Calendar</a>
            </li>
        </ul>
        <a class="navbar-brand text-white font-weight-bold" href="#" style="font-family: Cambria">Welcome,<?php echo $_COOKIE["fname"];?></a>
        <form method="post">
            <input class=" btn text-danger" type="submit" name="logout"  value="Log Out" style="font-family: 'Arial Black';cursor: pointer">
        </form>

    </div>
</nav>
<script src="http://platform.fatsecret.com/js?key=05048178f74e4a7ebe87a8871411749a&auto_load=false&theme=green&auto_nav=false&auto_template=true"></script>
<script>
    // fatsecret.variables.navOptions = fatsecret.navFeatures.home|fatsecret.navFeatures.food_diary|fatsecret.navFeatures.calendar.get_month;

</script>


<div id="my_div" class="fatsecret_container">
    <div id="search"></div>
    <div id="food_title"></div>
    <div class="row">
        <div class="col-md-6" id="res"></div>
        <div class="col-md-6">
            <div id="foodtitle"></div>
            <div class="row">
                <div class="col-md-6">
                    <div id="nutrition_panel"></div>
                </div>
                <div class="col-md-6">
                    <div id="servingselector"></div>
                    <div id="servingentry"></div>
                </div>
            </div>


        </div>
    </div>
    <div id="testt"></div>

</div>

<script>
    fatsecret.setContainer("my_div");
    fatsecret.setCanvas("home");
    // fatsecret.setCanvas("food_entries.edit");
    // fatsecret.setCanvas("calendar.get_month");

</script>



<script>
    // fatsecret.replaceCanvas("food_entries.edit");
    // $('fatsecret_nav_2').click();
    $('.nav-item').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
    });




</script>
</body>
</html>
