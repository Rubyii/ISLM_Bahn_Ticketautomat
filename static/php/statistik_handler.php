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

$json = file_get_contents('../json/configuration.json');

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
}else $preisPPErwachsene = 0;


if ($anzKind != 0){
    $preisPPKind = number_format(kinderPreisBerechnung($rechenwerte),2);
}else $preisPPKind = 0;


if ($anzSenior != 0){
    $preisPPSenior = number_format(seniorPreisBerechnung($rechenwerte),2);
}else $preisPPSenior = 0;


if ($anzErmaessigt != 0){
    $preisPPErmaessigt = number_format(ermaessigtPreisBerechnung($rechenwerte),2);
}else $preisPPErmaessigt = 0;




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

header('Location: /islm_bahn_ticketautomat/TicketToPDF.php');
exit();

