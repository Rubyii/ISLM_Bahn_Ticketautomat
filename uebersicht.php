<?php
session_start();

$startort = "AachenHauptbahnhof"; // AUSLESEN
$zielort = "Dueren"; // AUSLESEN

$klasse = 2; // AUSLESEN

$ticketart = "Einzelticket"; // AUSLESEN
$isAboTicket = false;

$anzErwachsene = 4; // AUSLESEN
$anzKind = 0; // AUSLESEN
$anzSenior = 2; // AUSLESEN
$anzErmaessigt = 0; // AUSLESEN

$preisPPErwachsene = 10; //AUSLESEN
$preisPPKind = 6; //AUSLESEN
$preisPPSenior = 9; //AUSLESEN
$preisPPErmaessigt = 8; //AUSLESEN

$preisGesamt = 58; // AUSLESEN

if ($ticketart == "Tagesticket" || $ticketart == "Monatsticket" || $ticketart == "Jahresticket") {
    $isAboTicket = true;
}


?>



<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Uebersicht</title>
    <link rel="stylesheet" href="static/css/uebersicht.css">
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
            <h3>Bitte überprüfen Sie Ihre Eingaben</h3>


        </div>
    </div>

    <div class="hauptfunktion">


            <div class="inner">
                <?php if (!$isAboTicket): ?>
                <div class="innerinner">
                    <?php
                    if (!$isAboTicket):
                    echo '<p >'.$startort.' - '.$zielort.'</p>';
                    ?>
                    <button class="button-gruen" type="button" onclick="location.href='startseite.php'">Ändern</button>
                    <?php endif ?>

                </div>
                <?php endif ?>
                <div class="innerinner">
                    <?php
                    echo '<p>'.$klasse.'.Klasse'.'</p>';
                    ?>
                    <button class="button-gruen" type="button" onclick="location.href='KLASSE/REISENDE'">Ändern</button>
                </div>
                <div class="innerinner">
                    <?php

                    echo '<p>'.$ticketart.'</p>';

                    if (!$isAboTicket){
                        echo '<button class="button-gruen" type="button" onclick="location.href=';
                        echo "'tarif.php'";
                        echo '">';
                        echo 'Ändern</button>';
                    }else{
                        echo '<button class="button-gruen" type="button" onclick="location.href=';
                        echo "'startseite.php'";
                        echo '">';
                        echo 'Ändern</button>';
                    }

                    ?>

                </div>

            </div>
        <div class="right">
            <div class="innerinner"><p>Anzahl Reisende</p>
                <button class="button-gruen" type="button" onclick="location.href='KLASSE/REISENDE'">Ändern</button>
            </div>


            <div class="rightright">
                <div>
                </div>
                <div>
                    <?php
                    if ($anzErwachsene != 0) {
                        echo '<p>'.$anzErwachsene."x Erwachsene".'</p>';
                    }
                    if ($anzKind != 0) {
                        echo '<p>'.$anzKind."x Kind".'</p>';
                    }
                    if ($anzSenior != 0) {
                        echo '<p>'.$anzSenior."x Senior".'</p>';
                    }
                    if ($anzErmaessigt != 0) {
                        echo '<p>'.$anzErmaessigt."x Ermaessigt".'</p>';
                    }

                    ?>
                </div>
                <div>
                    <?php
                    if ($anzErwachsene != 0) {
                        echo '<p>'."p.P ".$preisPPErwachsene.'€'.'</p>';
                    }
                    if ($anzKind != 0) {
                        echo '<p>'."p.P ".$preisPPKind.'€'.'</p>';
                    }
                    if ($anzSenior != 0) {
                        echo '<p>'."p.P ".$preisPPSenior.'€'.'</p>';
                    }
                    if ($anzErmaessigt != 0) {
                        echo '<p>'."p.P ".$preisPPErmaessigt.'€'.'</p>';
                    }
                    ?>
                </div>
                <div></div>
                <div></div>
                <div><em class="preis">Preis: <?php echo $preisGesamt?>€</em></div>
            </div>

        </div>

    </div>

    <div class="navigation">
        <div class="navigation-innen">
            <form method="post" action="STARTSEITE">
                <input type="submit" class="button-orange" value="Abbrechen">
            </form>
            <button class="button-orange" style="left: 300px; position: relative" type="button" onclick="location.href='TARIFE'">Zurück</button>
            <button class="button-gruen" style="left: 200px; position: relative" type="button" onclick="location.href='BEZAHLEN'">Weiter</button>
        </div>
    </div>
</div>



</body>
<script src="static/js/zeit.js"></script>
</html>
