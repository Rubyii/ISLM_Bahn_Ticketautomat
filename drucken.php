<?php
session_start();
//var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <title>Ticket drucken</title>
    <link rel="stylesheet" href="static/css/drucken.css">
    <script async defer src="static/js/pageloader.js"></script>
    <script async defer src="static/js/keinRechtsclick.js"></script>
    <script async defer src="static/js/keinZurueck.js"></script>
</head>
<body>


<!--Flügel links-->
<div  class="rechteck"></div>
<div  class="dreieckleft"></div>
<div  class="dreieckright"></div>

<div  class="rechteck" style="margin-top: 150px; background-color:#ed8c08"></div>
<div  class="dreieckleft" style="margin-top: 150px"></div>
<div  class="dreieckright"style="margin-top: 150px"></div>

<div  class="rechteck" style="margin-top: 300px" ></div>
<div  class="dreieckleft" style="margin-top: 300px"></div>
<div  class="dreieckright" style="margin-top: 300px"></div>

<div  class="rechteck" style="top:125px;right:0px;"></div>
<div  class="dreieckleft"style="top:124px;right:0px;transform: scaleY(-1);"></div>
<div  class="dreieckright"style="top:124px;right:0px;transform: scaleY(-1);"></div>

<!--Flügel rechts-->
<div  class="rechteck" style="margin-top: 150px; background-color:#ed8c08;top:125px;right:0px;"></div>
<div  class="dreieckleft" style="margin-top: 150px;top:124px;right:0px;transform: scaleY(-1);"></div>
<div  class="dreieckright"style="margin-top: 150px;top:124px;right:0px;transform: scaleY(-1);"></div>

<div  class="rechteck" style="margin-top: 300px;top:125px;right:0px;" ></div>
<div  class="dreieckleft" style="margin-top: 300px;top:124px;right:0px;transform: scaleY(-1);"></div>
<div  class="dreieckright" style="margin-top: 300px;top:124px;right:0px;transform: scaleY(-1);"></div>


<div class="grid-container">
    <div class="ueberschrift">
        <img alt="ISLM-Bahn" class="logo" src="static/images/ISLM_Logo2009.png">
        <div id="uhrzeitdatum" class="uhrzeitdatum">
            <div id="uhrzeit"></div>
            <div id="datum"></div>
        </div>
    </div>
    <div class="hinweistext">
        <div class="hinweistext-innen">
            <!-- Start -->
            <!-- Bitte nur innerhalb der div arbeiten -->






            <!-- Ende -->
        </div>
    </div>

    <div class="hauptfunktion">
        <div class="hauptfunktion-innen">
            <!-- Start -->
            <!-- Bitte nur innerhalb der div arbeiten -->

            <object data="ISLM_Ticket.pdf#toolbar=0" width="1150" height="540px"></object>




            <!-- Ende -->
        </div>
    </div>

    <div class="navigation">
        <div class="navigation-innen">
            <!-- Start -->
            <!-- Bitte nur innerhalb der div arbeiten -->


            <form action="static/php/abbrechen_uebersicht.php" method="post">
                <input type="submit" class="input" value="<?php echo $_SESSION['language']['drucken']?>">
            </form>

            <!-- Ende -->
        </div>
    </div>
</div>

<!--Page Load-->


<div class="loadingscreen" id="loader-container" >
    <div class="loadingscreen" id="loader"></div>
    <div class="loadingscreen" id="loading-text"><?php echo $_SESSION['language']['laedt']?></div>
</div>
<!--Page Load-->

</body>
<script src="static/js/zeit.js"></script>
</html>
