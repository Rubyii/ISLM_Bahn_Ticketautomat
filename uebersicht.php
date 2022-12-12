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
$rechenwerte = array(
        "Einzelticket" => (float) $json_data['einzelticket'],
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
        "klasse2" => (float) $json_data['klasse2'] * 0.01
);

//var_dump($_SESSION);

function erwachsenePreisBerechnung($_rechenwerte): float
{
    if (isset($_SESSION['ziel'])){
        return $_rechenwerte[$_SESSION['tarif']] * (1+$_rechenwerte['prozentErwachsene']) * (1+$_rechenwerte[$_SESSION['dauer']]) * (1+$_rechenwerte[$_SESSION['klasse']]);
    }elseif(isset($_SESSION['tarif'])){
        return $_rechenwerte[$_SESSION['tarif']] * (1+$_rechenwerte['prozentErwachsene']) * (1+$_rechenwerte[$_SESSION['klasse']]);
    }else return 0;
}

function kinderPreisBerechnung($_rechenwerte): float
{
    if (isset($_SESSION['ziel'])){
        return $_rechenwerte[$_SESSION['tarif']] * (1+$_rechenwerte['prozentKind']) * (1+$_rechenwerte[$_SESSION['dauer']]) * (1+$_rechenwerte[$_SESSION['klasse']]);
    }elseif(isset($_SESSION['tarif'])){
        return $_rechenwerte[$_SESSION['tarif']] * (1+$_rechenwerte['prozentKind']) * (1+$_rechenwerte[$_SESSION['klasse']]);
    }else return 0;
}

function seniorPreisBerechnung($_rechenwerte): float
{
    if (isset($_SESSION['ziel'])){
        return $_rechenwerte[$_SESSION['tarif']] * (1+$_rechenwerte['prozentSenior']) * (1+$_rechenwerte[$_SESSION['dauer']]) * (1+$_rechenwerte[$_SESSION['klasse']]);
    }elseif(isset($_SESSION['tarif'])){
        return $_rechenwerte[$_SESSION['tarif']] * (1+$_rechenwerte['prozentSenior']) * (1+$_rechenwerte[$_SESSION['klasse']]);
    }else return 0;
}

function ermaessigtPreisBerechnung($_rechenwerte): float
{
    if (isset($_SESSION['ziel'])){
        return $_rechenwerte[$_SESSION['tarif']] * (1+$_rechenwerte['prozentErmaessigt']) * (1+$_rechenwerte[$_SESSION['dauer']]) * (1+$_rechenwerte[$_SESSION['klasse']]);
    }elseif(isset($_SESSION['tarif'])){
        return $_rechenwerte[$_SESSION['tarif']] * (1+$_rechenwerte['prozentErmaessigt']) * (1+$_rechenwerte[$_SESSION['klasse']]);
    }else return 0;
}


if ($anzErwachsene != 0){
    $preisPPErwachsene = number_format(erwachsenePreisBerechnung($rechenwerte),2);
    $preisPPErwachseneKomma = str_replace(".",",",$preisPPErwachsene);
}else {
    $preisPPErwachsene = 0;
    $preisPPErwachseneKomma = 0;
}


if ($anzKind != 0){
    $preisPPKind = number_format(kinderPreisBerechnung($rechenwerte),2);
    $preisPPKindKomma = str_replace(".",",",$preisPPKind);
}else {
    $preisPPKind = 0;
    $preisPPKindKomma = 0;
}


if ($anzSenior != 0){
    $preisPPSenior = number_format(seniorPreisBerechnung($rechenwerte),2);
    $preisPPSeniorKomma = str_replace(".",",",$preisPPSenior);
}else {
    $preisPPSenior = 0;
    $preisPPSeniorKomma = 0;
}


if ($anzErmaessigt != 0){
    $preisPPErmaessigt = number_format(ermaessigtPreisBerechnung($rechenwerte),2);
    $preisPPErmaessigtKomma = str_replace(".",",",$preisPPErmaessigt);
}else {
    $preisPPErmaessigt = 0;
    $preisPPErmaessigtKomma = 0;
}

$preisGesamt = number_format(($anzErwachsene * $preisPPErwachsene) + ($anzKind * $preisPPKind) + ($anzSenior * $preisPPSenior) + ($anzErmaessigt * $preisPPErmaessigt), 2);

$preisGesamtKomma = number_format($preisGesamt,2, ",",".");




$_SESSION['preisGesamt'] = $preisGesamt;

//var_dump($_POST);

if (!empty($_POST['abbrechen'])) {
    session_unset();
    session_destroy();
    session_regenerate_id();
    header('Location: startseite.php'); // ZUR STARTSEITE HIER LEITEN
    exit();
}

if (!empty($_POST['startseiteÄndern'])) {
    $_SESSION['showinfo'] = true;
    header('Location: startseite.php');
    exit();
}
if (!empty($_POST['reisendeÄndern'])) {
    $_SESSION['showinfo'] = true;
    header('Location: Anzahl_Reisende.php');
    exit();
}
if (!empty($_POST['tarifÄndern'])) {
    $_SESSION['showinfo'] = true;
    header('Location: tarif.php');
    exit();
}
?>



<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Uebersicht</title>
    <link rel="stylesheet" href="static/css/uebersicht.css">
    <script async defer src="static/js/pageloader.js"></script>
</head>
<body>

<!--Page Load-->


<div class="loadingscreen" id="loader-container" >
    <div class="loadingscreen" id="loader"></div>
    <div class="loadingscreen" id="loading-text">Lädt...</div>
</div>
<!--Page Load-->

<form method="post">

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
                    <input class="button-gruen" type="submit" value="Ändern" name="startseiteÄndern"></input>
                    <?php endif ?>

                </div>
                <?php endif ?>
                <div class="innerinner">
                    <?php
                    echo '<p>'.$klasse.'</p>';
                    ?>
                    <input class="button-gruen" value="Ändern" type="submit" name="reisendeÄndern"></input>
                </div>
                <div class="innerinner">
                    <?php
                    if (isset($ticketart)) echo '<p>'.$ticketart.'</p>';

                    if (!$isAboTicket){
                        echo '<input class="button-gruen" type="submit" value="Ändern" name=';
                        echo "'tarifÄndern'";
                        echo '">';
                        echo '</input>';
                    }else{
                        //unset($_SESSION['tarif']);
                        echo '<input class="button-gruen" type="submit" value="Ändern" name=';
                        echo "'startseiteÄndern'";
                        echo '">';
                        echo '</input>';
                    }

                    ?>

                </div>

            </div>
        <div class="right">
            <div class="innerinner"><p>Anzahl Reisende</p>
                <input class="button-gruen" type="submit" value="Ändern" name="reisendeÄndern"></input>
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
                        echo '<p>'."p.P ".$preisPPErwachseneKomma.'</p>';
                    }
                    if ($anzKind != 0) {
                        echo '<p>'."p.P ".$preisPPKindKomma.'</p>';
                    }
                    if ($anzSenior != 0) {
                        echo '<p>'."p.P ".$preisPPSeniorKomma.'</p>';
                    }
                    if ($anzErmaessigt != 0) {
                        echo '<p>'."p.P ".$preisPPErmaessigtKomma.'</p>';
                    }
                    ?>
                </div>
                <div></div>
                <div style="font-size: 20px">Alle Angaben sind in Euro €</div>
                <div><em class="preis">Preis: <?php echo $preisGesamtKomma?>€</em></div>
            </div>

        </div>

    </div>

    <div class="navigation">
        <div class="navigation-innen">

            <input type="submit" class="button-orange" value="Abbrechen" name="abbrechen">


            <?php
            echo '<input class="button-orange" style="left: 300px; position: relative" type="submit" value="Zurück" name=';
            if ($isAboTicket){
                echo "'reisendeÄndern'";

            }else{
                echo "'tarifÄndern'";
            }
            echo '"></input>';
            ?>
            <button class="button-gruen" style="left: 200px; position: relative" type="button" onclick="location.href='/static/php/statistik_handler.php'">Weiter</button>
        </div>
    </div>
</div>


</form>
</body>
<script src="static/js/zeit.js"></script>
</html>
