<?php
session_start();

$bahnhoefe = array(
    array("AachenHauptbahnhof", 50.76763697947344, 6.0909034446067825),
    array("AachenRotheErde", 50.77018640899706, 6.116490727116905),
    array("Dueren", 50.80930664580822, 6.48204588509695),
    array("KoelnHauptbahnhof", 50.943288440980105, 6.958548054110135),
    array("KoelnEhrenfeld", 50.95172918094622, 6.91836526945143),
);

$zielkorrekt = false;
$distanz = 0.0;
$latFrom = 0;
$longFrom = 0;

$latTo = 0.0;
$longTo = 0.0;


//Harvesine Function
function getDistance($latitude1, $longitude1, $latitude2, $longitude2): float|int
{
    $earth_radius = 6371;

    $dLat = deg2rad($latitude2 - $latitude1);
    $dLon = deg2rad($longitude2 - $longitude1);

    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);
    $c = 2 * asin(sqrt($a));
    $d = $earth_radius * $c;
    return $d;
}


/*foreach($_POST as $key => $value) {                                                 //TESTEN
    echo "<br> POST parameter '$key' has '$value' <br>";
}*/

//Tarif ausgewaehlt
if (isset($_POST['tarif']) || isset($_SESSION['tarif']) && empty($_POST['weiter'])){
    $_SESSION['tarif'] = $_POST['tarif'];
    $_SESSION['error'] = false;
    //Start-Ziel zurücksetzen
    unset($_SESSION['dauer']);
    unset($_SESSION['start']);
    unset($_SESSION['ziel']);
    header('Location: ../../Anzahl_Reisende.php');
    /*echo $_SESSION['tarif'];*/
} else if ((isset($_POST['start']) && isset($_POST['ziel'])) || (isset($_SESSION['start']) && isset($_SESSION['ziel']))){ //Start Ziel ausgewaehlt

    //ZIEL VALIDIERUNG
    for ($i = 0; $i < sizeof($bahnhoefe); $i++){
        if ( ($_POST['start']!= $_POST['ziel']) && ($bahnhoefe[$i][0] == $_POST['ziel'])){
            $zielkorrekt = true;
            $_SESSION['error'] = false;
            break;
        }
    }

    //UMLEITUNG WENN FALSCH
    if (!$zielkorrekt){
        unset($_SESSION['dauer']);
        unset($_SESSION['start']);
        unset($_SESSION['ziel']);
        unset($_SESSION['tarif']);
        unset($_POST['ziel']);
        $_SESSION['error'] = true;
        header('Location: ../../startseite.php');
    }

    //Tarif zuruecksetzen
    //unset($_SESSION['tarif']);

    $_SESSION['start'] = $_POST['start'];
    $_SESSION['ziel'] =  $_POST['ziel'];


//Setzt Koordinaten fuer den Start
    for ($i = 0; $i < sizeof($bahnhoefe); $i++){
        if ($bahnhoefe[$i][0] == $_SESSION['start']){
            //echo ('JAStart '."\n");

            $latFrom = $bahnhoefe[$i][1];
            $longFrom = $bahnhoefe[$i][2];

            break;
        }
    }

    for ($i = 0; $i < sizeof($bahnhoefe); $i++){
        if ($bahnhoefe[$i][0] == $_SESSION['ziel']){
            //echo ('JAZiel '."\n");

            //Setzt Koordinaten fuer das Ziel
            $latTo = $bahnhoefe[$i][1];
            $longTo = $bahnhoefe[$i][2];
            $distanz = getDistance($latFrom, $longFrom, $latTo, $longTo);
            /*echo "<br><br>Distanz ist ".getDistance($latFrom, $longFrom, $latTo, $longTo)."km";*/

            //Setzt je nach Distanz die Dauer auf kurz, mittel oder lang
            switch ($distanz) {
                case $distanz < 20:
                    $_SESSION['dauer'] = "kurz";
                    header('Location: ../../Anzahl_Reisende.php');
                    break;
                case ($distanz >= 20 && $distanz<= 50):
                    $_SESSION['dauer'] = "mittel";
                    header('Location: ../../Anzahl_Reisende.php');
                    break;
                case $distanz > 50:
                    $_SESSION['dauer'] = "lang";
                    header('Location: ../../Anzahl_Reisende.php');
                    break;
                default:
                    echo "FEHLER: MITARBEITER KONTAKTIEREN!!!";
                    break;
            }
            break;
        }
    }

}

/*foreach($_SESSION as $key => $value) {

    echo "<br> SESSION parameter '$key' has '$value' <br>";                       //TESTEN

}*/
?>

<!--
<!DOCTYPE html>
<html lang="de">
<head>
   <title>TEST</title>
</head>
<body>
   <button onclick="window.location.href='startseite.php';">
       Click Here
   </button>
</body>
</html>
-->



