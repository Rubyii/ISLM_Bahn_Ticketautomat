<?php
session_start();


if (isset($_SESSION['ziel'])){
    $startort = $_SESSION['start'];
    $zielort = $_SESSION['ziel'];
}

if ($_SESSION['klasse'] == "klasse1") $klasse = "1.Klasse";
    else $klasse = "2.Klasse";


$isAboTicket = false;
if(isset($_SESSION['tarif'])) {
    $ticketart = $_SESSION['tarif'];
    if ($ticketart == "Tages Ticket" || $ticketart == "Monats Ticket" || $ticketart == "Jahres Ticket")  $isAboTicket = true;
}


$anzErwachsene = $_SESSION['anzErwachsene'];
$anzKind = $_SESSION['anzKinder'];
$anzSenior = $_SESSION['anzSenioren'];
$anzErmaessigt = $_SESSION['anzErmaessigt'];


$json = file_get_contents('static/json/configuration.json');

$json_data = json_decode($json, true);


// !!!!ALLE WERTE MUESSEN AUS DER JSON GELESEN WERDEN!!!!
$rechenwerte = array("Einzelticket" => (float) $json_data['einzelticket'],
                    "Viererticket" => (float) $json_data['viererticket'],
                    "5erGruppenticket" => (float) $json_data['gruppenticket5'],
                    "10erGruppenticket" => (float) $json_data['gruppenticket10'],
                    "Tages Ticket" => (float) $json_data['tagesticket'],
                    "Monats Ticket" => (float) $json_data['monatsticket'],
                    "Jahres Ticket" => (float) $json_data['jahresticket'],

                    "prozentErwachsene" => (float) $json_data['erwachsene'] * 0.01,
                    "prozentKind" => (float) $json_data['kinder'] * 0.01,
                    "prozentSenior" => (float) $json_data['senioren'] * 0.01,
                    "prozentErmaessigt" => (float) $json_data['ermaessigt'] * 0.01,

                    "kurz" => (float) $json_data['kurz'] * 0.01,
                    "mittel" => (float) $json_data['mittel'] * 0.01,
                    "lang" => (float) $json_data['lang'] * 0.01,

                    "klasse1" => (float) $json_data['klasse1'] * 0.01,
                    "klasse2" => (float) $json_data['klasse2'] * 0.01);

var_dump($_SESSION);

if ($anzErwachsene != 0){

    if (isset($_SESSION['ziel'])){
        $preisPPErwachsene =  number_format($rechenwerte[$_SESSION['tarif']] * (1+$rechenwerte['prozentErwachsene']) * (1+$rechenwerte[$_SESSION['dauer']]) * (1+$rechenwerte[$_SESSION['klasse']]),2);
    }elseif(isset($_SESSION['tarif'])){
        $preisPPErwachsene =  number_format($rechenwerte[$_SESSION['tarif']] * (1+$rechenwerte['prozentErwachsene']) * (1+$rechenwerte[$_SESSION['klasse']]),2);
    }else $preisPPErwachsene = 0;

}else $preisPPErwachsene = 0;

if ($anzKind != 0){
    if (isset($_SESSION['ziel'])){
        $preisPPKind =  number_format($rechenwerte[$_SESSION['tarif']] * (1+$rechenwerte['prozentKind']) * (1+$rechenwerte[$_SESSION['dauer']]) * (1+$rechenwerte[$_SESSION['klasse']]),2);
    }elseif(isset($_SESSION['tarif'])){
        $preisPPKind =  number_format($rechenwerte[$_SESSION['tarif']] * (1+$rechenwerte['prozentKind']) * (1+$rechenwerte[$_SESSION['klasse']]),2);
    }else $preisPPErwachsene = 0;
}else $preisPPKind = 0;

if ($anzSenior != 0){
    if (isset($_SESSION['ziel'])){
        $preisPPSenior =  number_format($rechenwerte[$_SESSION['tarif']] * (1+$rechenwerte['prozentSenior']) * (1+$rechenwerte[$_SESSION['dauer']]) * (1+$rechenwerte[$_SESSION['klasse']]),2);
    }elseif(isset($_SESSION['tarif'])){
        $preisPPSenior =  number_format($rechenwerte[$_SESSION['tarif']] * (1+$rechenwerte['prozentSenior']) * (1+$rechenwerte[$_SESSION['klasse']]),2);
    }else $preisPPErwachsene = 0;
}else $preisPPSenior = 0;

if ($anzErmaessigt != 0){
    if (isset($_SESSION['ziel'])){
        $preisPPErmaessigt =  number_format($rechenwerte[$_SESSION['tarif']] * (1+$rechenwerte['prozentErmaessigt']) * (1+$rechenwerte[$_SESSION['dauer']]) * (1+$rechenwerte[$_SESSION['klasse']]),2);
    }elseif(isset($_SESSION['tarif'])){
        $preisPPErmaessigt =  number_format($rechenwerte[$_SESSION['tarif']] * (1+$rechenwerte['prozentErmaessigt']) * (1+$rechenwerte[$_SESSION['klasse']]),2);
    }else $preisPPErwachsene = 0;
}else $preisPPErmaessigt = 0;

$preisGesamt = number_format(($anzErwachsene * $preisPPErwachsene) + ($anzKind * $preisPPKind) + ($anzSenior * $preisPPSenior) + ($anzErmaessigt * $preisPPErmaessigt), 2);



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
                        if (isset($startort) && isset($zielort))echo '<p >'.$startort.' - '.$zielort.'</p>';
                    ?>
                    <button class="button-gruen" type="button" onclick="location.href='startseite.php'">Ändern</button>
                    <?php endif ?>

                </div>
                <?php endif ?>
                <div class="innerinner">
                    <?php
                    echo '<p>'.$klasse.'</p>';
                    ?>
                    <button class="button-gruen" type="button" onclick="location.href='Anzahl_Reisende.php'">Ändern</button>
                </div>
                <div class="innerinner">
                    <?php
                    if (isset($ticketart)) echo '<p>'.$ticketart.'</p>';

                    if (!$isAboTicket){
                        echo '<button class="button-gruen" type="button" onclick="location.href=';
                        echo "'tarif.php'";
                        echo '">';
                        echo 'Ändern</button>';
                    }else{
                        //unset($_SESSION['tarif']);
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
                <button class="button-gruen" type="button" onclick="location.href='Anzahl_Reisende.php'">Ändern</button>
            </div>


            <div class="rightright">
                <div>
                </div>
                <div style="font-size: 35px">
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
                <div style="position: relative; font-size: 30px; right: 35px">
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
            <form method="post" action=static/php/abbrechen_uebersicht.php>
                <input type="submit" class="button-orange" value="Abbrechen">
            </form>

            <?php
            if ($isAboTicket){
                echo '<button class="button-orange" style="left: 300px; position: relative" type="button" onclick="location.href=';
                echo "'Anzahl_Reisende.php'";
                echo '">Zurück</button>';

            }else{
                echo '<button class="button-orange" style="left: 300px; position: relative" type="button" onclick="location.href=';
                echo "'tarif.php'";
                echo '">Zurück</button>';
            }
            ?>
            <button class="button-gruen" style="left: 200px; position: relative" type="button" onclick="location.href='BEZAHLEN'">Weiter</button>
        </div>
    </div>
</div>



</body>
<script src="static/js/zeit.js"></script>
</html>
