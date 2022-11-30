<?php
session_start();

$bahnhoefe = array(
    array("AachenHauptbahnhof", 50.76763697947344, 6.0909034446067825),
    array("AachenRotheErde", 50.77018640899706, 6.116490727116905),
    array("Dueren", 50.80930664580822, 6.48204588509695),
    array("KoelnHauptbahnhof", 50.943288440980105, 6.958548054110135),
    array("KoelnEhrenfeld", 50.95172918094622, 6.91836526945143),
);

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <link rel="stylesheet" href="static/css/index.css">
    <script async defer src="static/js/tarif_handler.js"></script>
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
        <div class="text">
            Bitte wählen sie ein Tarif aus
        </div>
    </div>

    <div class="hauptfunktion">
        <div class="hauptfunktion-innen">
            <form action="test.php" method="post">
                <div class="radio-btn">
                    <input type="radio" class="radio" name="tarif" id="Einzelticket" value="Einzelticket">
                    <label for="Einzelticket" class="normaltarif">Einzelticket</label>

                    <input type="radio" class="radio" name="tarif" id="Viererticket" value="Viererticket">
                    <label for="Viererticket" class="normaltarif">Viererticket</label>

                    <input type="radio" class="radio" name="tarif" id="5erGruppenticket" value="5erGruppenticket">
                    <label for="5erGruppenticket" class="gruppenticket">5er Gruppenticket</label>

                    <input type="radio" class="radio" name="tarif" id="10erGruppenticket" value="10erGruppenticket">
                    <label for="10erGruppenticket" class="gruppenticket"> 10er Gruppenticket</label>

                    <input type="submit" id="weiter" class="button-disabled" value="Weiter" disabled>
                </div>
            </form>
        </div>
    </div>

    <div class="navigation">
        <div class="navigation-innen">
            <form action="test.php" method="post">
                <input type="submit" class="Abbrechen" name="Abbrechen" id="Abbrechen" value="Abbrechen">
                <input type="submit" class="Zurück" name="Zurück" id="Zurück" value="Zurück">
            </form>
        </div>
    </div>
</div>
</body>
<script src="static/js/zeit.js"></script>
</html>
