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
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVx2QBmwxDzm52voQ6qwjaOgjQS32JXEE&libraries=places&callback=initAutocomplete"></script>
</head>
<body>
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
                <label for="Einzelticket" >Einzelticket</label>

                <input type="radio" class="radio" name="tarif" id="Viererticket" value="Viererticket">
                <label for="Viererticket" >Viererticket</label>

                <input type="radio" class="radio" name="tarif" id="5erGruppenticket" value="5erGruppenticket">
                <label for="5erGruppenticket" >5er Gruppenticket</label>

                <input type="radio" class="radio" name="tarif" id="10erGruppenticket" value="10erGruppenticket">
                <label for="10erGruppenticket" > 10er Gruppenticket</label>
                </div>

                <input type="submit" class="input" value="Weiter">
            </form>
        </div>
    </div>

    <div class="navigation">
        <div class="navigation-innen">

        </div>
    </div>
</div>
</body>
<script src="static/js/zeit.js"></script>
</html>
