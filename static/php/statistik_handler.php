<?php
session_start();

$ticketart = NULL;
$isAboTicket = false;
if(isset($_SESSION['tarif'])) {
    $ticketart = $_SESSION['tarif'];
    if ($ticketart == "Tages Ticket" || $ticketart == "Monats Ticket" || $ticketart == "Jahres Ticket")  $isAboTicket = true;
}


$anzErwachsene = $_SESSION['anzErwachsene'];
$anzKind = $_SESSION['anzKinder'];
$anzSenior = $_SESSION['anzSenioren'];
$anzErmaessigt = $_SESSION['anzErmaessigt'];


$json = file_get_contents('../json/statistik.json');

$json_data_stats = json_decode($json, true);





if(!$isAboTicket) {
    if ($ticketart == "Einzelticket") {
        $json_data_stats['einzeltickets_euro'] += $_SESSION['preisGesamt'];
        $json_data_stats['einzeltickets_anzahl'] += $anzErmaessigt + $anzErwachsene + $anzSenior + $anzKind;
    }
    else if ($ticketart == "Viererticket") {
        $json_data_stats['vierertickets_euro'] += $_SESSION['preisGesamt'];
        $json_data_stats['vierertickets_anzahl'] += $anzErmaessigt + $anzErwachsene + $anzSenior + $anzKind;
    }
    else if ($ticketart == "5erGruppenticket") {
        $json_data_stats['gruppenticket5_euro'] += $_SESSION['preisGesamt'];
        $json_data_stats['gruppenticket5_anzahl'] += $anzErmaessigt + $anzErwachsene + $anzSenior + $anzKind;
    }
    else if ($ticketart == "10erGruppenticket") {
        $json_data_stats['gruppenticket10_euro'] += $_SESSION['preisGesamt'];
        $json_data_stats['gruppenticket10_anzahl'] += $anzErmaessigt + $anzErwachsene + $anzSenior + $anzKind;
    }

    $json_data_stats['gesamt_euro'] = $json_data_stats['einzeltickets_euro'] + $json_data_stats['vierertickets_euro'] + $json_data_stats['gruppenticket5_euro'] + $json_data_stats['gruppenticket10_euro'];
    $json_data_stats['gesamt_anzahl'] = $json_data_stats['einzeltickets_anzahl'] + $json_data_stats['vierertickets_anzahl'] + $json_data_stats['gruppenticket5_anzahl'] + $json_data_stats['gruppenticket10_anzahl'];


}

$jsonString = json_encode($json_data_stats, JSON_PRETTY_PRINT);
$file = fopen('../json/statistik.json','w');
fwrite($file, $jsonString);
fclose($file);

header('Location: /SWE_B6_git/Zahlungsabwicklung.php');
exit();

