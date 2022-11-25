<?php

$startort = "Köln"; // AUSLESEN
$zielort = "Berlin"; // AUSLESEN

$klasse = 2; // AUSLESEN

$ticketart = "Gruppenticket"; // AUSLESEN
$isAboTicket = false;

$anzErwachsene = 4; // AUSLESEN
$anzKind = 0; // AUSLESEN
$anzSenior = 2; // AUSLESEN
$anzErmaessigt = 0; // AUSLESEN

$preisPPErwachsene = 10; //AUSLESEN
$preisPPKind = 6; //AUSLESEN
$preisPPSenior = 9; //AUSLESEN
$preisPPErmaessigt = 8; //AUSLESEN

$preisGesamt = 150; // AUSLESEN

if ($ticketart == "Tagesticket" || $ticketart == "Monatsticket" || $ticketart == "Jahresticket") {
    $isAboTicket = true;
}


?>



<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Startseite</title>
    <link rel="stylesheet" href="static/css/index.css">
    <style>

    </style>
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
                    <button class="button-gruen" type="button" onclick="location.href='U00'">Ändern</button>
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


                    ?>
                    <button class="button-gruen" type="button" onclick="location.href='TARIFE'">Ändern</button>
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
                <div><em style="position: absolute; left: 500px; font-weight: bold">Preis: <?php echo $preisGesamt?>€</em></div>

            </div>

        </div>






    </div>

    <div class="navigation">
        <div class="navigation-innen">
            <form method="post" action="STARTSEITE">
                <input type="submit" class="button-orange" value="Abbrechen">
            </form>
            <button class="button-orange" style="left: 300px; position: relative" type="button" onclick="location.href='TARIFE'">Zurück</button>
            <button class="button-gruen" style="left: 240px; position: relative" type="button" onclick="location.href='BEZAHLEN'">Weiter</button>
        </div>
    </div>
</div>



</body>
<script src="static/js/zeit.js"></script>
</html>
