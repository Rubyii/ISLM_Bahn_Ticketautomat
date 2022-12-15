<?php
session_start();
require ('fpdf/fpdf.php');
date_default_timezone_set('Europe/Berlin');
$date = date('d.m.Y');
$time = date('H:i');

if($_SESSION['klasse'] == 'klasse2'){
    $klasse = "2";
}else{
    $klasse = "1";
}

$isAboTicket = false;
// Vorverarbeitung
if ($_SESSION['tarif'] == "Tages Ticket" || $_SESSION['tarif'] == "Monats Ticket" || $_SESSION['tarif'] == "Jahres Ticket") {
    $isAboTicket = true;
}

if ($_SESSION['tarif'] == "Tages Ticket") {
    $ticketart = "Tagesticket";
}
else if ($_SESSION['tarif'] == "Monats Ticket") {
    $ticketart = "Monatsticket";
}
else if ($_SESSION['tarif'] == "Jahres Ticket") {
    $ticketart = "Jahresticket";
}
else {
    $ticketart = $_SESSION['tarif'];
}



if (!$isAboTicket){
    $standort = stripslashes($_SESSION['start']);
    $standort = iconv('UTF-8', 'windows-1252', $standort);

    $zielort = stripslashes($_SESSION['ziel']);
    $zielort = iconv('UTF-8', 'windows-1252', $zielort);


    if ($_SESSION['tarif'] == "5erGruppenticket" || $_SESSION['tarif'] == "10erGruppenticket"){
        $ticketart = "Gruppenticket";
    }
}

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


$anzErwachsene = $_SESSION['anzErwachsene'];
$anzKinder = $_SESSION['anzKinder'];
$anzSenior = $_SESSION['anzSenioren'];
$anzErmaesigt = $_SESSION['anzErmaessigt'];

$preis_Einzelticket_Erwachsen = $rechenwerte['Einzelticket'] * (1+$rechenwerte['prozentErwachsene']) * (1+$rechenwerte[$_SESSION['dauer']]) * (1+$rechenwerte[$_SESSION['klasse']]);
$preis_Einzelticket_Senior = $rechenwerte['Einzelticket'] * (1+$rechenwerte['prozentSenior']) * (1+$rechenwerte[$_SESSION['dauer']]) * (1+$rechenwerte[$_SESSION['klasse']]);
$preis_Einzelticket_Kind = $rechenwerte['Einzelticket'] * (1+$rechenwerte['prozentKind']) * (1+$rechenwerte[$_SESSION['dauer']]) * (1+$rechenwerte[$_SESSION['klasse']]);
$preis_Einzelticket_Ermaessigt = $rechenwerte['Einzelticket'] * (1+$rechenwerte['prozentErmaessigt']) * (1+$rechenwerte[$_SESSION['dauer']]) * (1+$rechenwerte[$_SESSION['klasse']]);

$preis_Gruppenticket = $_SESSION['preisGesamt'];

$preis_Viererticket_Erwachsen = $rechenwerte['Viererticket'] * (1+$rechenwerte['prozentErwachsene']) * (1+$rechenwerte[$_SESSION['dauer']]) * (1+$rechenwerte[$_SESSION['klasse']]);
$preis_Viererticket_Senior = $rechenwerte['Viererticket'] * (1+$rechenwerte['prozentSenior']) * (1+$rechenwerte[$_SESSION['dauer']]) * (1+$rechenwerte[$_SESSION['klasse']]);
$preis_Viererticket_Kind = $rechenwerte['Viererticket'] * (1+$rechenwerte['prozentKind']) * (1+$rechenwerte[$_SESSION['dauer']]) * (1+$rechenwerte[$_SESSION['klasse']]);
$preis_Viererticket_Ermaessigt = $rechenwerte['Viererticket'] * (1+$rechenwerte['prozentErmaessigt']) * (1+$rechenwerte[$_SESSION['dauer']]) * (1+$rechenwerte[$_SESSION['klasse']]);

$preis_Tagesticket_Erwachsen = $rechenwerte['Tages Ticket'] * (1+$rechenwerte['prozentErwachsene']) * (1+$rechenwerte[$_SESSION['klasse']]);
$preis_Tagesticket_Senior = $rechenwerte['Tages Ticket'] * (1+$rechenwerte['prozentSenior']) * (1+$rechenwerte[$_SESSION['klasse']]);
$preis_Tagesticket_Kind = $rechenwerte['Tages Ticket'] * (1+$rechenwerte['prozentKind']) * (1+$rechenwerte[$_SESSION['klasse']]);
$preis_Tagesticket_Ermaessigt = $rechenwerte['Tages Ticket'] * (1+$rechenwerte['prozentErmaessigt']) * (1+$rechenwerte[$_SESSION['klasse']]);

$preis_Monatsticket_Erwachsen = $rechenwerte['Monats Ticket'] * (1+$rechenwerte['prozentErwachsene']) * (1+$rechenwerte[$_SESSION['klasse']]);
$preis_Monatsticket_Senior = $rechenwerte['Monats Ticket'] * (1+$rechenwerte['prozentSenior']) * (1+$rechenwerte[$_SESSION['klasse']]);
$preis_Monatsticket_Kind = $rechenwerte['Monats Ticket'] * (1+$rechenwerte['prozentKind']) * (1+$rechenwerte[$_SESSION['klasse']]);
$preis_Monatsticket_Ermaessigt = $rechenwerte['Monats Ticket'] * (1+$rechenwerte['prozentErmaessigt']) * (1+$rechenwerte[$_SESSION['klasse']]);

$preis_Jahresticket_Erwachsen = $rechenwerte['Jahres Ticket'] * (1+$rechenwerte['prozentErwachsene']) * (1+$rechenwerte[$_SESSION['klasse']]);
$preis_Jahresticket_Senior = $rechenwerte['Jahres Ticket'] * (1+$rechenwerte['prozentSenior']) * (1+$rechenwerte[$_SESSION['klasse']]);
$preis_Jahresticket_Kind = $rechenwerte['Jahres Ticket'] * (1+$rechenwerte['prozentKind']) * (1+$rechenwerte[$_SESSION['klasse']]);
$preis_Jahresticket_Ermaessigt = $rechenwerte['Jahres Ticket'] * (1+$rechenwerte['prozentErmaessigt']) * (1+$rechenwerte[$_SESSION['klasse']]);



$pdf = new FPDF();

$pdf->AddPage('L','A3');


$expired = new DateTime('Now');
if ($isAboTicket) {
    if ($ticketart == "Tagesticket") {
        date_add($expired,date_interval_create_from_date_string("1 days"));
    }
    else if ($ticketart == "Monatsticket") {
        date_add($expired,date_interval_create_from_date_string("1 month"));
    }
    else {
        date_add($expired,date_interval_create_from_date_string("1 year"));
    }
}

$result = $expired->format('d.m.Y');



$cellHeightTopBottom = 20;
$cellHeightMain = 40;
$gapBetweenTickets = 15;
$gaprechts = 8;

if ($ticketart == "Einzelticket") {
    $count = 0;
    $saveX = 0;
    for ($i = $anzErwachsene+$anzKinder+$anzErmaesigt+$anzSenior; $i > 0; $i--) {

        if ($anzErwachsene != 0 && $count % 2 == 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY(10, $pdf->GetY() + 10);
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88, $saveY + 7);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85, $saveY + 15);
            $pdf->Write(0, "ab " . $date);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(125, $saveY + 8);
            $pdf->Write(0, "Einzelticket");
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159, $saveY + 8);
            $pdf->Write(0, "1 Erwachsener");

            // Strecke
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12, $saveY + 20);
            $pdf->Write(3, "ISLM-Bahn Von: ");

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(55, $saveY + 20);
            $pdf->Write(3, $standort);

            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(42, $saveY + 27);
            $pdf->Write(3, "Nach: ");

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(58, $saveY + 27);
            $pdf->Write(3, $zielort);

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75, $saveY + 10);
            $pdf->Write(3, "**" . number_format($preis_Einzelticket_Erwachsen, 2));
            $pdf->SetXY(95, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130, $saveY + 10);
            $pdf->Write(3, "***" . number_format($preis_Einzelticket_Erwachsen * 0.19, 2));

            // Line
            $pdf->Line(160, $saveY, 160, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162, $saveY + 5);
            $pdf->Write(3, "EUR**" . number_format($preis_Einzelticket_Erwachsen, 2));

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(20 + 190, $saveY - $cellHeightTopBottom - $cellHeightMain);

            $anzErwachsene--;

        }
        else if ($anzErwachsene != 0 && $count % 2 != 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY($pdf->GetX(), $pdf->GetY());
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(38 + 190, $pdf->GetY() + 10);

            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88 + 200, $saveY + 7);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85+ 200, $saveY + 15);
            $pdf->Write(0, "ab " . $date);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163+ 200, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10+ 200, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12+ 200, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28+ 200, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86+ 200, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(125+ 200, $saveY + 8);
            $pdf->Write(0, "Einzelticket");
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159+ 200, $saveY + 8);
            $pdf->Write(0, "1 Erwachsener");

            // Strecke
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12+ 200, $saveY + 20);
            $pdf->Write(3, "ISLM-Bahn Von: ");

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(55+ 200, $saveY + 20);
            $pdf->Write(3, $standort);

            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(42+ 200, $saveY + 27);
            $pdf->Write(3, "Nach: ");

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(58+ 200, $saveY + 27);
            $pdf->Write(3, $zielort);

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10+ 200, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10+ 200, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18+ 200, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45+ 200, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75+ 200, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75+ 200, $saveY + 10);
            $pdf->Write(3, "**" . number_format($preis_Einzelticket_Erwachsen, 2));
            $pdf->SetXY(95+ 200, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130+ 200, $saveY + 10);
            $pdf->Write(3, "***" . number_format($preis_Einzelticket_Erwachsen * 0.19, 2));

            // Line
            $pdf->Line(160+ 200, $saveY, 160+ 200, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162+ 200, $saveY + 5);
            $pdf->Write(3, "EUR**" . number_format($preis_Einzelticket_Erwachsen, 2));

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175+ 200, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(10, $saveY + $gapBetweenTickets);
            $anzErwachsene--;

        }
        else if ($anzKinder != 0 && $count % 2 == 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY(10, $pdf->GetY() + 10);
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial','BI',16);
            $pdf->SetXY(28,$saveY + 10);
            $pdf->Write(0,"ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88,$saveY + 7);
            $pdf->Write(0,"Gueltigkeit: ");
            $pdf->SetXY(85,$saveY + 15);
            $pdf->Write(0,"ab ".$date);

            // Datum
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(163,$saveY + 8);
            $pdf->Write(0,$date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(12 , $saveY + 8);
            $pdf->Write(0,"ISLM");
            $pdf->SetFont('Arial','B',16);
            $pdf->SetXY(28 , $saveY + 8);
            $pdf->Write(0,"Fahrkarte");

            // Klasse
            $pdf->SetXY(86 , $saveY + 8);
            $pdf->Write(0,"Klasse ".$klasse);

            // Einzelticket
            $pdf->SetXY(125 , $saveY + 8);
            $pdf->Write(0,"Einzelticket");
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(159 , $saveY + 8);
            $pdf->Write(0,"1 Kind");

            // Strecke
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12, $saveY + 20);
            $pdf->Write(3, "ISLM-Bahn Von: ");

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(55, $saveY + 20);
            $pdf->Write(3, $standort);

            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(42, $saveY + 27);
            $pdf->Write(3, "Nach: ");

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(58, $saveY + 27);
            $pdf->Write(3, $zielort);

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10 , $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75, $saveY + 10);
            $pdf->Write(3, "**".number_format($preis_Einzelticket_Kind,2));
            $pdf->SetXY(95, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130, $saveY + 10);
            $pdf->Write(3, "***".number_format($preis_Einzelticket_Kind * 0.19,2));

            // Line
            $pdf->Line(160,$saveY ,160,$saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162, $saveY + 5);
            $pdf->Write(3, "EUR**".number_format($preis_Einzelticket_Kind,2));

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(20 + 190, $saveY - $cellHeightTopBottom - $cellHeightMain);


            $anzKinder--;
        }
        else if ($anzKinder != 0 && $count % 2 != 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY($pdf->GetX(), $pdf->GetY());
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial','BI',16);
            $pdf->SetXY(28 + 200,$saveY + 10);
            $pdf->Write(0,"ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88+ 200,$saveY + 7);
            $pdf->Write(0,"Gueltigkeit: ");
            $pdf->SetXY(85+ 200,$saveY + 15);
            $pdf->Write(0,"ab ".$date);

            // Datum
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(163+ 200,$saveY + 8);
            $pdf->Write(0,$date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10+ 200, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(12 + 200, $saveY + 8);
            $pdf->Write(0,"ISLM");
            $pdf->SetFont('Arial','B',16);
            $pdf->SetXY(28 + 200, $saveY + 8);
            $pdf->Write(0,"Fahrkarte");

            // Klasse
            $pdf->SetXY(86+ 200 , $saveY + 8);
            $pdf->Write(0,"Klasse ".$klasse);

            // Einzelticket
            $pdf->SetXY(125 + 200, $saveY + 8);
            $pdf->Write(0,"Einzelticket");
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(159+ 200 , $saveY + 8);
            $pdf->Write(0,"1 Kind");

            // Strecke
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12+ 200, $saveY + 20);
            $pdf->Write(3, "ISLM-Bahn Von: ");

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(55+ 200, $saveY + 20);
            $pdf->Write(3, $standort);

            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(42+ 200, $saveY + 27);
            $pdf->Write(3, "Nach: ");

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(58+ 200, $saveY + 27);
            $pdf->Write(3, $zielort);

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10+ 200, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10 + 200, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18+ 200, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45+ 200, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75+ 200, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75+ 200, $saveY + 10);
            $pdf->Write(3, "**".number_format($preis_Einzelticket_Kind,2));
            $pdf->SetXY(95+ 200, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130+ 200, $saveY + 10);
            $pdf->Write(3, "***".number_format($preis_Einzelticket_Kind * 0.19,2));

            // Line
            $pdf->Line(160+ 200,$saveY ,160+ 200,$saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162+ 200, $saveY + 5);
            $pdf->Write(3, "EUR**".number_format($preis_Einzelticket_Kind,2));

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175+ 200, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(10, $saveY + $gapBetweenTickets);

            $anzKinder--;
        }
        else if ($anzSenior != 0 && $count % 2 == 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY(10, $pdf->GetY() + 10);
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial','BI',16);
            $pdf->SetXY(28,$saveY + 10);
            $pdf->Write(0,"ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88,$saveY + 7);
            $pdf->Write(0,"Gueltigkeit: ");
            $pdf->SetXY(85,$saveY + 15);
            $pdf->Write(0,"ab ".$date);

            // Datum
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(163,$saveY + 8);
            $pdf->Write(0,$date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(12 , $saveY + 8);
            $pdf->Write(0,"ISLM");
            $pdf->SetFont('Arial','B',16);
            $pdf->SetXY(28 , $saveY + 8);
            $pdf->Write(0,"Fahrkarte");

            // Klasse
            $pdf->SetXY(86 , $saveY + 8);
            $pdf->Write(0,"Klasse ".$klasse);

            // Einzelticket
            $pdf->SetXY(125 , $saveY + 8);
            $pdf->Write(0,"Einzelticket");
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(159 , $saveY + 8);
            $pdf->Write(0,"1 Senior");

            // Strecke
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12, $saveY + 20);
            $pdf->Write(3, "ISLM-Bahn Von: ");

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(55, $saveY + 20);
            $pdf->Write(3, $standort);

            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(42, $saveY + 27);
            $pdf->Write(3, "Nach: ");

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(58, $saveY + 27);
            $pdf->Write(3, $zielort);

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10 , $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75, $saveY + 10);
            $pdf->Write(3, "**".number_format($preis_Einzelticket_Senior,2));
            $pdf->SetXY(95, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130, $saveY + 10);
            $pdf->Write(3, "***".number_format($preis_Einzelticket_Senior * 0.19,2));

            // Line
            $pdf->Line(160,$saveY ,160,$saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162, $saveY + 5);
            $pdf->Write(3, "EUR**".number_format($preis_Einzelticket_Senior,2));

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(20 + 190, $saveY - $cellHeightTopBottom - $cellHeightMain);

            $anzSenior--;
        }
        else if ($anzSenior != 0 && $count % 2 != 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY($pdf->GetX(), $pdf->GetY());
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial','BI',16);
            $pdf->SetXY(28 + 200,$saveY + 10);
            $pdf->Write(0,"ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88+ 200,$saveY + 7);
            $pdf->Write(0,"Gueltigkeit: ");
            $pdf->SetXY(85+ 200,$saveY + 15);
            $pdf->Write(0,"ab ".$date);

            // Datum
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(163+ 200,$saveY + 8);
            $pdf->Write(0,$date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10+ 200, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(12+ 200 , $saveY + 8);
            $pdf->Write(0,"ISLM");
            $pdf->SetFont('Arial','B',16);
            $pdf->SetXY(28 + 200, $saveY + 8);
            $pdf->Write(0,"Fahrkarte");

            // Klasse
            $pdf->SetXY(86 + 200, $saveY + 8);
            $pdf->Write(0,"Klasse ".$klasse);

            // Einzelticket
            $pdf->SetXY(125 + 200, $saveY + 8);
            $pdf->Write(0,"Einzelticket");
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(159 + 200, $saveY + 8);
            $pdf->Write(0,"1 Senior");

            // Strecke
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12+ 200, $saveY + 20);
            $pdf->Write(3, "ISLM-Bahn Von: ");

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(55+ 200, $saveY + 20);
            $pdf->Write(3, $standort);

            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(42+ 200, $saveY + 27);
            $pdf->Write(3, "Nach: ");

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(58+ 200, $saveY + 27);
            $pdf->Write(3, $zielort);

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10+ 200, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10 + 200, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18+ 200, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45+ 200, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75+ 200, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75+ 200, $saveY + 10);
            $pdf->Write(3, "**".number_format($preis_Einzelticket_Senior,2));
            $pdf->SetXY(95+ 200, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130+ 200, $saveY + 10);
            $pdf->Write(3, "***".number_format($preis_Einzelticket_Senior * 0.19,2));

            // Line
            $pdf->Line(160+ 200,$saveY ,160+ 200,$saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162+ 200, $saveY + 5);
            $pdf->Write(3, "EUR**".number_format($preis_Einzelticket_Senior,2));

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175+ 200, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(10, $saveY + $gapBetweenTickets);

            $anzSenior--;
        }
        else if ($anzErmaesigt != 0 && $count % 2 == 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY(10, $pdf->GetY() + 10);
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial','BI',16);
            $pdf->SetXY(28,$saveY + 10);
            $pdf->Write(0,"ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88,$saveY + 7);
            $pdf->Write(0,"Gueltigkeit: ");
            $pdf->SetXY(85,$saveY + 15);
            $pdf->Write(0,"ab ".$date);

            // Datum
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(163,$saveY + 8);
            $pdf->Write(0,$date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(12 , $saveY + 8);
            $pdf->Write(0,"ISLM");
            $pdf->SetFont('Arial','B',16);
            $pdf->SetXY(28 , $saveY + 8);
            $pdf->Write(0,"Fahrkarte");

            // Klasse
            $pdf->SetXY(86 , $saveY + 8);
            $pdf->Write(0,"Klasse ".$klasse);

            // Einzelticket
            $pdf->SetXY(125 , $saveY + 8);
            $pdf->Write(0,"Einzelticket");
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(159 , $saveY + 8);
            $pdf->Write(0,"1 Ermaessigt");

            // Strecke
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12, $saveY + 20);
            $pdf->Write(3, "ISLM-Bahn Von: ");

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(55, $saveY + 20);
            $pdf->Write(3, $standort);

            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(42, $saveY + 27);
            $pdf->Write(3, "Nach: ");

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(58, $saveY + 27);
            $pdf->Write(3, $zielort);

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10 , $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75, $saveY + 10);
            $pdf->Write(3, "**".number_format($preis_Einzelticket_Ermaessigt,2));
            $pdf->SetXY(95, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130, $saveY + 10);
            $pdf->Write(3, "***".number_format($preis_Einzelticket_Ermaessigt * 0.19,2));

            // Line
            $pdf->Line(160,$saveY ,160,$saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162, $saveY + 5);
            $pdf->Write(3, "EUR**".number_format($preis_Einzelticket_Ermaessigt,2));

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(20 + 190, $saveY - $cellHeightTopBottom - $cellHeightMain);

            $anzErmaesigt--;
        }
        else if ($anzErmaesigt != 0 && $count % 2 != 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY($pdf->GetX(), $pdf->GetY());
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial','BI',16);
            $pdf->SetXY(28 + 200,$saveY + 10);
            $pdf->Write(0,"ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88+ 200,$saveY + 7);
            $pdf->Write(0,"Gueltigkeit: ");
            $pdf->SetXY(85+ 200,$saveY + 15);
            $pdf->Write(0,"ab ".$date);

            // Datum
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(163+ 200,$saveY + 8);
            $pdf->Write(0,$date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10+ 200, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(12 + 200, $saveY + 8);
            $pdf->Write(0,"ISLM");
            $pdf->SetFont('Arial','B',16);
            $pdf->SetXY(28 + 200, $saveY + 8);
            $pdf->Write(0,"Fahrkarte");

            // Klasse
            $pdf->SetXY(86 + 200, $saveY + 8);
            $pdf->Write(0,"Klasse ".$klasse);

            // Einzelticket
            $pdf->SetXY(125 + 200, $saveY + 8);
            $pdf->Write(0,"Einzelticket");
            $pdf->SetFont('Arial','',16);
            $pdf->SetXY(159 + 200, $saveY + 8);
            $pdf->Write(0,"1 Ermaessigt");

            // Strecke
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12+ 200, $saveY + 20);
            $pdf->Write(3, "ISLM-Bahn Von: ");

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(55+ 200, $saveY + 20);
            $pdf->Write(3, $standort);

            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(42+ 200, $saveY + 27);
            $pdf->Write(3, "Nach: ");

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(58+ 200, $saveY + 27);
            $pdf->Write(3, $zielort);

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10+ 200, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10+ 200 , $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18+ 200, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45+ 200, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75+ 200, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75+ 200, $saveY + 10);
            $pdf->Write(3, "**".number_format($preis_Einzelticket_Ermaessigt,2));
            $pdf->SetXY(95+ 200, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130+ 200, $saveY + 10);
            $pdf->Write(3, "***".number_format($preis_Einzelticket_Ermaessigt * 0.19,2));

            // Line
            $pdf->Line(160+ 200,$saveY ,160+ 200,$saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162+ 200, $saveY + 5);
            $pdf->Write(3, "EUR**".number_format($preis_Einzelticket_Ermaessigt,2));

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175+ 200, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(10, $saveY + $gapBetweenTickets);

            $anzErmaesigt--;
        }
        $count++;
    }

}
else if ($ticketart == "Gruppenticket") {
    // Oberer Teil ////////////////////////////////////////
    $pdf->SetXY(10, $pdf->GetY() + 10);
    $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
    $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
    $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

    $saveY = $pdf->GetY();

    // ISLM-Bahn
    $pdf->SetFont('Arial','BI',16);
    $pdf->SetXY(28,$saveY + 10);
    $pdf->Write(0,"ISLM-Bahn");

    // Gültigkeit
    $pdf->SetFont('Arial', '', 13);
    $pdf->SetXY(88,$saveY + 7);
    $pdf->Write(0,"Gueltigkeit: ");
    $pdf->SetXY(85,$saveY + 15);
    $pdf->Write(0,"ab ".$date);

    // Datum
    $pdf->SetFont('Arial','',16);
    $pdf->SetXY(163,$saveY + 8);
    $pdf->Write(0,$date);

    // Hauptteil ////////////////////////////////////////////////
    $pdf->SetXY(10, $saveY + $cellHeightTopBottom);
    $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

    $saveY = $pdf->GetY();

    // ISLM Fahrkarte
    $pdf->SetFont('Arial','',16);
    $pdf->SetXY(12 , $saveY + 8);
    $pdf->Write(0,"ISLM");
    $pdf->SetFont('Arial','B',16);
    $pdf->SetXY(28 , $saveY + 8);
    $pdf->Write(0,"Fahrkarte");

    // Klasse
    $pdf->SetXY(86 , $saveY + 8);
    $pdf->Write(0,"Klasse ".$klasse);

    // Gruppenticket
    $pdf->SetXY(118 , 47);
    $pdf->Write(0,"Gruppenticket");
    $pdf->SetFont('Arial','',16);
    $pdf->SetXY(160 , 45);
    if ($anzErwachsene != "0") {
        $pdf->Write(3,$anzErwachsene." Erwachsene");
        $pdf->SetXY(160 , $pdf->GetY() +7 );
    }
    if ($anzKinder != "0") {
        $pdf->Write(3,$anzKinder." Kinder");
        $pdf->SetXY(160 , $pdf->GetY() + 7);
    }
    if ($anzErmaesigt != "0") {
        $pdf->Write(3,$anzErmaesigt." Ermaessigt");
        $pdf->SetXY(160 , $pdf->GetY() + 7);
    }
    if ($anzSenior != "0") {
        $pdf->Write(3,$anzSenior." Senioren");
        $pdf->SetXY(160 , $pdf->GetY() + 7);
    }

    // Strecke
    $pdf->SetFont('Arial', '', 16);
    $pdf->SetXY(12, $saveY + 20);
    $pdf->Write(3, "ISLM-Bahn Von: ");

    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetXY(55, $saveY + 20);
    $pdf->Write(3, $standort);

    $pdf->SetFont('Arial', '', 16);
    $pdf->SetXY(42, $saveY + 27);
    $pdf->Write(3, "Nach: ");

    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetXY(58, $saveY + 27);
    $pdf->Write(3, $zielort);

    // Unterer Teil ////////////////////////////////////////////////

    $pdf->SetXY(10, $saveY + $cellHeightMain);
    $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

    $saveY = $pdf->GetY();

    // Datum und Uhrzeit
    $pdf->SetXY(10 , $saveY + 8);
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetXY(18, $saveY + 8);
    $pdf->Write(3, $date);
    $pdf->SetXY(45, $saveY + 8);
    $pdf->Write(3, $time);

    // Mehrwertsteuerberechnung
    $pdf->SetXY(75, $saveY + 6);
    $pdf->Write(3, "MwSt D:");
    $pdf->SetXY(75, $saveY + 10);
    $pdf->Write(3, "**".number_format($preis_Gruppenticket,2));
    $pdf->SetXY(95, $saveY + 10);
    $pdf->Write(3, "19,00% = ");
    $pdf->SetXY(130, $saveY + 10);
    $pdf->Write(3, "***".number_format($preis_Gruppenticket * 0.19,2));

    // Line
    $pdf->Line(160,$saveY ,160,$saveY + 20);

    // Betrag
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->SetXY(162, $saveY + 5);
    $pdf->Write(3, "EUR**".number_format($preis_Gruppenticket,2));

    $pdf->SetFont('Arial', '', 12);
    $pdf->SetXY(175, $saveY + 13);
    $pdf->Write(3, "Barzahlung");



}
else if ($isAboTicket) {
    $count = 0;
    $saveX = 0;
    for ($i = $anzErwachsene + $anzKinder + $anzErmaesigt + $anzSenior; $i > 0; $i--) {

        if ($anzErwachsene != 0 && $count % 2 == 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY(10, $pdf->GetY() + 10);
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88, $saveY + 4);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85, $saveY + 11);
            $pdf->Write(0, "ab " . $date);
            $pdf->SetXY(85, $saveY + 16);
            $pdf->Write(0, "bis " . $result);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(120, $saveY + 8);
            $pdf->Write(0, $ticketart);
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159, $saveY + 8);
            $pdf->Write(0, "1 Erwachsener");

            // Strecke
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(15, $saveY + 22);
            $pdf->Write(3, "Gilt fuer Fahrten im angegebenen Geltungsbereich in");
            $pdf->SetXY(35, $saveY + 27);
            $pdf->Write(3, "allen Zuegen der ISLM-Bahn");

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75, $saveY + 10);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "**" . number_format($preis_Tagesticket_Erwachsen, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "**" . number_format($preis_Monatsticket_Erwachsen, 2));
            }
            else {
                $pdf->Write(3, "**" . number_format($preis_Jahresticket_Erwachsen, 2));
            }
            $pdf->SetXY(95, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130, $saveY + 10);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "***" . number_format($preis_Tagesticket_Erwachsen * 0.19, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "***" . number_format($preis_Monatsticket_Erwachsen * 0.19, 2));
            }
            else {
                $pdf->Write(3, "***" . number_format($preis_Jahresticket_Erwachsen * 0.19, 2));
            }
            // Line
            $pdf->Line(160, $saveY, 160, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162, $saveY + 5);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "EUR**" . number_format($preis_Tagesticket_Erwachsen, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "EUR**" . number_format($preis_Monatsticket_Erwachsen, 2));
            }
            else {
                $pdf->Write(3, "EUR**" . number_format($preis_Jahresticket_Erwachsen, 2));
            }
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(20 + 190, $saveY - $cellHeightTopBottom - $cellHeightMain);

            $anzErwachsene--;

        }
        else if ($anzErwachsene != 0 && $count % 2 != 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY($pdf->GetX(), $pdf->GetY());
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28 + 200, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88+ 200, $saveY + 4);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85+ 200, $saveY + 11);
            $pdf->Write(0, "ab " . $date);
            $pdf->SetXY(85+ 200, $saveY + 16);
            $pdf->Write(0, "bis " . $result);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163+ 200, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10+ 200, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12+ 200, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28+ 200, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86+ 200, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(120+ 200, $saveY + 8);
            $pdf->Write(0, $ticketart);
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159+ 200, $saveY + 8);
            $pdf->Write(0, "1 Erwachsener");

            // Strecke
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(15+ 200, $saveY + 22);
            $pdf->Write(3, "Gilt fuer Fahrten im angegebenen Geltungsbereich in");
            $pdf->SetXY(35+ 200, $saveY + 27);
            $pdf->Write(3, "allen Zuegen der ISLM-Bahn");

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10+ 200, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10+ 200, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18+ 200, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45+ 200, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75+ 200, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75+ 200, $saveY + 10);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "**" . number_format($preis_Tagesticket_Erwachsen, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "**" . number_format($preis_Monatsticket_Erwachsen, 2));
            }
            else {
                $pdf->Write(3, "**" . number_format($preis_Jahresticket_Erwachsen, 2));
            }
            $pdf->SetXY(95+ 200, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130+ 200, $saveY + 10);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "***" . number_format($preis_Tagesticket_Erwachsen * 0.19, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "***" . number_format($preis_Monatsticket_Erwachsen * 0.19, 2));
            }
            else {
                $pdf->Write(3, "***" . number_format($preis_Jahresticket_Erwachsen * 0.19, 2));
            }
            // Line
            $pdf->Line(160+ 200, $saveY, 160+ 200, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162+ 200, $saveY + 5);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "EUR**" . number_format($preis_Tagesticket_Erwachsen, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "EUR**" . number_format($preis_Monatsticket_Erwachsen, 2));
            }
            else {
                $pdf->Write(3, "EUR**" . number_format($preis_Jahresticket_Erwachsen, 2));
            }
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175+ 200, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(10, $saveY + $gapBetweenTickets);

            $anzErwachsene--;

        }
        else if ($anzKinder != 0 && $count % 2 == 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY(10, $pdf->GetY() + 10);
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88, $saveY + 4);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85, $saveY + 11);
            $pdf->Write(0, "ab " . $date);
            $pdf->SetXY(85, $saveY + 16);
            $pdf->Write(0, "bis " . $result);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(120, $saveY + 8);
            $pdf->Write(0, $ticketart);
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159, $saveY + 8);
            $pdf->Write(0, "1 Kind");

            // Strecke
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(15, $saveY + 22);
            $pdf->Write(3, "Gilt fuer Fahrten im angegebenen Geltungsbereich in");
            $pdf->SetXY(35, $saveY + 27);
            $pdf->Write(3, "allen Zuegen der ISLM-Bahn");

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75, $saveY + 10);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "**" . number_format($preis_Tagesticket_Kind, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "**" . number_format($preis_Monatsticket_Kind, 2));
            }
            else {
                $pdf->Write(3, "**" . number_format($preis_Jahresticket_Kind, 2));
            }
            $pdf->SetXY(95, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130, $saveY + 10);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "***" . number_format($preis_Tagesticket_Kind * 0.19, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "***" . number_format($preis_Monatsticket_Kind * 0.19, 2));
            }
            else {
                $pdf->Write(3, "***" . number_format($preis_Jahresticket_Kind * 0.19, 2));
            }

            // Line
            $pdf->Line(160, $saveY, 160, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162, $saveY + 5);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "EUR**" . number_format($preis_Tagesticket_Kind, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "EUR**" . number_format($preis_Monatsticket_Kind, 2));
            }
            else {
                $pdf->Write(3, "EUR**" . number_format($preis_Jahresticket_Kind, 2));
            }


            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(20 + 190, $saveY - $cellHeightTopBottom - $cellHeightMain);

            $anzKinder--;

        }
        else if ($anzKinder != 0 && $count % 2 != 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY($pdf->GetX(), $pdf->GetY());
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28 + 200, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88+ 200, $saveY + 4);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85+ 200, $saveY + 11);
            $pdf->Write(0, "ab " . $date);
            $pdf->SetXY(85+ 200, $saveY + 16);
            $pdf->Write(0, "bis " . $result);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163+ 200, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10+ 200, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12+ 200, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28+ 200, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86+ 200, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(120+ 200, $saveY + 8);
            $pdf->Write(0, $ticketart);
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159+ 200, $saveY + 8);
            $pdf->Write(0, "1 Kind");

            // Strecke
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(15+ 200, $saveY + 22);
            $pdf->Write(3, "Gilt fuer Fahrten im angegebenen Geltungsbereich in");
            $pdf->SetXY(35+ 200, $saveY + 27);
            $pdf->Write(3, "allen Zuegen der ISLM-Bahn");

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10+ 200, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10+ 200, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18+ 200, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45+ 200, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75+ 200, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75+ 200, $saveY + 10);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "**" . number_format($preis_Tagesticket_Kind, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "**" . number_format($preis_Monatsticket_Kind, 2));
            }
            else {
                $pdf->Write(3, "**" . number_format($preis_Jahresticket_Kind, 2));
            }
            $pdf->SetXY(95+ 200, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130+ 200, $saveY + 10);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "***" . number_format($preis_Tagesticket_Kind * 0.19, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "***" . number_format($preis_Monatsticket_Kind * 0.19, 2));
            }
            else {
                $pdf->Write(3, "***" . number_format($preis_Jahresticket_Kind * 0.19, 2));
            }

            // Line
            $pdf->Line(160+ 200, $saveY, 160+ 200, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162+ 200, $saveY + 5);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "EUR**" . number_format($preis_Tagesticket_Kind, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "EUR**" . number_format($preis_Monatsticket_Kind, 2));
            }
            else {
                $pdf->Write(3, "EUR**" . number_format($preis_Jahresticket_Kind, 2));
            }


            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175+ 200, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(10, $saveY + $gapBetweenTickets);

            $anzKinder--;

        }
        else if ($anzSenior != 0 && $count % 2 == 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY(10, $pdf->GetY() + 10);
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88, $saveY + 4);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85, $saveY + 11);
            $pdf->Write(0, "ab " . $date);
            $pdf->SetXY(85, $saveY + 16);
            $pdf->Write(0, "bis " . $result);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(120, $saveY + 8);
            $pdf->Write(0, $ticketart);
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159, $saveY + 8);
            $pdf->Write(0, "1 Senior");

            // Strecke
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(15, $saveY + 22);
            $pdf->Write(3, "Gilt fuer Fahrten im angegebenen Geltungsbereich in");
            $pdf->SetXY(35, $saveY + 27);
            $pdf->Write(3, "allen Zuegen der ISLM-Bahn");

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75, $saveY + 10);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "**" . number_format($preis_Tagesticket_Senior, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "**" . number_format($preis_Monatsticket_Senior, 2));
            }
            else {
                $pdf->Write(3, "**" . number_format($preis_Jahresticket_Senior, 2));
            }

            $pdf->SetXY(95, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130, $saveY + 10);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "***" . number_format($preis_Tagesticket_Senior * 0.19, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "***" . number_format($preis_Monatsticket_Senior * 0.19, 2));
            }
            else {
                $pdf->Write(3, "***" . number_format($preis_Jahresticket_Senior * 0.19, 2));
            }


            // Line
            $pdf->Line(160, $saveY, 160, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162, $saveY + 5);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "EUR**" . number_format($preis_Tagesticket_Senior, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "EUR**" . number_format($preis_Monatsticket_Senior, 2));
            }
            else {
                $pdf->Write(3, "EUR**" . number_format($preis_Jahresticket_Senior, 2));
            }


            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(20 + 190, $saveY - $cellHeightTopBottom - $cellHeightMain);

            $anzSenior--;

        }
        else if ($anzSenior != 0 && $count % 2 != 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY($pdf->GetX(), $pdf->GetY());
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28 + 200, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88+ 200, $saveY + 4);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85+ 200, $saveY + 11);
            $pdf->Write(0, "ab " . $date);
            $pdf->SetXY(85+ 200, $saveY + 16);
            $pdf->Write(0, "bis " . $result);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163+ 200, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10+ 200, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12+ 200, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28+ 200, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86+ 200, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(120+ 200, $saveY + 8);
            $pdf->Write(0, $ticketart);
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159+ 200, $saveY + 8);
            $pdf->Write(0, "1 Senior");

            // Strecke
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(15+ 200, $saveY + 22);
            $pdf->Write(3, "Gilt fuer Fahrten im angegebenen Geltungsbereich in");
            $pdf->SetXY(35+ 200, $saveY + 27);
            $pdf->Write(3, "allen Zuegen der ISLM-Bahn");

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10+ 200, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10+ 200, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18+ 200, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45+ 200, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75+ 200, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75+ 200, $saveY + 10);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "**" . number_format($preis_Tagesticket_Senior, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "**" . number_format($preis_Monatsticket_Senior, 2));
            }
            else {
                $pdf->Write(3, "**" . number_format($preis_Jahresticket_Senior, 2));
            }

            $pdf->SetXY(95+ 200, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130+ 200, $saveY + 10);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "***" . number_format($preis_Tagesticket_Senior * 0.19, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "***" . number_format($preis_Monatsticket_Senior * 0.19, 2));
            }
            else {
                $pdf->Write(3, "***" . number_format($preis_Jahresticket_Senior * 0.19, 2));
            }


            // Line
            $pdf->Line(160+ 200, $saveY, 160+ 200, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162+ 200, $saveY + 5);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "EUR**" . number_format($preis_Tagesticket_Senior, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "EUR**" . number_format($preis_Monatsticket_Senior, 2));
            }
            else {
                $pdf->Write(3, "EUR**" . number_format($preis_Jahresticket_Senior, 2));
            }


            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175+ 200, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(10, $saveY + $gapBetweenTickets);

            $anzSenior--;

        }
        else if ($anzErmaesigt != 0 && $count % 2 == 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY(10, $pdf->GetY() + 10);
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88, $saveY + 4);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85, $saveY + 11);
            $pdf->Write(0, "ab " . $date);
            $pdf->SetXY(85, $saveY + 16);
            $pdf->Write(0, "bis " . $result);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(120, $saveY + 8);
            $pdf->Write(0, $ticketart);
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159, $saveY + 8);
            $pdf->Write(0, "1 Ermaessigt");

            // Strecke
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(15, $saveY + 22);
            $pdf->Write(3, "Gilt fuer Fahrten im angegebenen Geltungsbereich in");
            $pdf->SetXY(35, $saveY + 27);
            $pdf->Write(3, "allen Zuegen der ISLM-Bahn");

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75, $saveY + 10);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "**" . number_format($preis_Tagesticket_Ermaessigt, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "**" . number_format($preis_Monatsticket_Ermaessigt, 2));
            }
            else {
                $pdf->Write(3, "**" . number_format($preis_Jahresticket_Ermaessigt, 2));
            }

            $pdf->SetXY(95, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130, $saveY + 10);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "***" . number_format($preis_Tagesticket_Ermaessigt * 0.19, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "***" . number_format($preis_Monatsticket_Ermaessigt * 0.19, 2));
            }
            else {
                $pdf->Write(3, "***" . number_format($preis_Jahresticket_Ermaessigt * 0.19, 2));
            }


            // Line
            $pdf->Line(160, $saveY, 160, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162, $saveY + 5);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "EUR**" . number_format($preis_Tagesticket_Ermaessigt, 2));;
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "EUR**" . number_format($preis_Monatsticket_Ermaessigt, 2));
            }
            else {
                $pdf->Write(3, "EUR**" . number_format($preis_Jahresticket_Ermaessigt, 2));
            }


            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(20 + 190, $saveY - $cellHeightTopBottom - $cellHeightMain);

            $anzErmaesigt--;

        }
        else if ($anzErmaesigt != 0 && $count % 2 != 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY($pdf->GetX(), $pdf->GetY());
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28 + 200, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88+ 200, $saveY + 4);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85+ 200, $saveY + 11);
            $pdf->Write(0, "ab " . $date);
            $pdf->SetXY(85+ 200, $saveY + 16);
            $pdf->Write(0, "bis " . $result);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163+ 200, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10+ 200, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12+ 200, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28+ 200, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86+ 200, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(120+ 200, $saveY + 8);
            $pdf->Write(0, $ticketart);
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159+ 200, $saveY + 8);
            $pdf->Write(0, "1 Ermaessigt");

            // Strecke
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(15+ 200, $saveY + 22);
            $pdf->Write(3, "Gilt fuer Fahrten im angegebenen Geltungsbereich in");
            $pdf->SetXY(35+ 200, $saveY + 27);
            $pdf->Write(3, "allen Zuegen der ISLM-Bahn");

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10+ 200, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10+ 200, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18+ 200, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45+ 200, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75+ 200, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75+ 200, $saveY + 10);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "**" . number_format($preis_Tagesticket_Ermaessigt, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "**" . number_format($preis_Monatsticket_Ermaessigt, 2));
            }
            else {
                $pdf->Write(3, "**" . number_format($preis_Jahresticket_Ermaessigt, 2));
            }

            $pdf->SetXY(95+ 200, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130+ 200, $saveY + 10);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "***" . number_format($preis_Tagesticket_Ermaessigt * 0.19, 2));
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "***" . number_format($preis_Monatsticket_Ermaessigt * 0.19, 2));
            }
            else {
                $pdf->Write(3, "***" . number_format($preis_Jahresticket_Ermaessigt * 0.19, 2));
            }


            // Line
            $pdf->Line(160+ 200, $saveY, 160+ 200, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162+ 200, $saveY + 5);
            if ($ticketart == "Tagesticket") {
                $pdf->Write(3, "EUR**" . number_format($preis_Tagesticket_Ermaessigt, 2));;
            }
            else if ($ticketart == "Monatsticket") {
                $pdf->Write(3, "EUR**" . number_format($preis_Monatsticket_Ermaessigt, 2));
            }
            else {
                $pdf->Write(3, "EUR**" . number_format($preis_Jahresticket_Ermaessigt, 2));
            }


            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175+ 200, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(10, $saveY + $gapBetweenTickets);

            $anzErmaesigt--;

        }
            $count++;
    }
}
else if ($ticketart == "Viererticket") {
    $count = 0;
    $saveX = 0;
    for ($i = $anzErwachsene + $anzKinder + $anzErmaesigt + $anzSenior; $i > 0; $i--) {

        if ($anzErwachsene != 0 && $count % 2 == 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY(10, $pdf->GetY() + 10);
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88, $saveY + 7);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85, $saveY + 15);
            $pdf->Write(0, "ab " . $date);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(125, $saveY + 8);
            $pdf->Write(0, $ticketart);
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159, $saveY + 8);
            $pdf->Write(0, "1 Erwachsener");

            // Strecke
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(15, $saveY + 22);
            $pdf->Write(3, "Gilt fuer vier Fahrten im angegebenen Geltungsbereich in");
            $pdf->SetXY(35, $saveY + 27);
            $pdf->Write(3, "allen Zuegen der ISLM-Bahn");

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75, $saveY + 10);
            $pdf->Write(3, "**" . number_format($preis_Viererticket_Erwachsen, 2));
            $pdf->SetXY(95, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130, $saveY + 10);
            $pdf->Write(3, "***" . number_format($preis_Viererticket_Erwachsen * 0.19, 2));

            // Line
            $pdf->Line(160, $saveY, 160, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162, $saveY + 5);
            $pdf->Write(3, "EUR**" . number_format($preis_Viererticket_Erwachsen, 2));

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(20 + 190, $saveY - $cellHeightTopBottom - $cellHeightMain);

            $anzErwachsene--;

        }
        else if ($anzErwachsene != 0 && $count % 2 != 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY($pdf->GetX(), $pdf->GetY());
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28 + 200, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88+ 200, $saveY + 7);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85+ 200, $saveY + 15);
            $pdf->Write(0, "ab " . $date);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163+ 200, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10+ 200, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12+ 200, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28+ 200, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86+ 200, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(125+ 200, $saveY + 8);
            $pdf->Write(0, $ticketart);
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159+ 200, $saveY + 8);
            $pdf->Write(0, "1 Erwachsener");

            // Strecke
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(15+ 200, $saveY + 22);
            $pdf->Write(3, "Gilt fuer vier Fahrten im angegebenen Geltungsbereich in");
            $pdf->SetXY(35+ 200, $saveY + 27);
            $pdf->Write(3, "allen Zuegen der ISLM-Bahn");

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10+ 200, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10+ 200, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18+ 200, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45+ 200, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75+ 200, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75+ 200, $saveY + 10);
            $pdf->Write(3, "**" . number_format($preis_Viererticket_Erwachsen, 2));
            $pdf->SetXY(95+ 200, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130+ 200, $saveY + 10);
            $pdf->Write(3, "***" . number_format($preis_Viererticket_Erwachsen * 0.19, 2));

            // Line
            $pdf->Line(160+ 200, $saveY, 160+ 200, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162+ 200, $saveY + 5);
            $pdf->Write(3, "EUR**" . number_format($preis_Viererticket_Erwachsen, 2));

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175+ 200, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(10, $saveY + $gapBetweenTickets);

            $anzErwachsene--;

        }
        else if ($anzKinder != 0 && $count % 2 == 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY(10, $pdf->GetY() + 10);
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88, $saveY + 7);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85, $saveY + 15);
            $pdf->Write(0, "ab " . $date);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(125, $saveY + 8);
            $pdf->Write(0, $ticketart);
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159, $saveY + 8);
            $pdf->Write(0, "1 Kind");

            // Strecke
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(15, $saveY + 22);
            $pdf->Write(3, "Gilt fuer vier Fahrten im angegebenen Geltungsbereich in");
            $pdf->SetXY(35, $saveY + 27);
            $pdf->Write(3, "allen Zuegen der ISLM-Bahn");

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75, $saveY + 10);
            $pdf->Write(3, "**" . number_format($preis_Viererticket_Kind, 2));
            $pdf->SetXY(95, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130, $saveY + 10);
            $pdf->Write(3, "***" . number_format($preis_Viererticket_Kind * 0.19, 2));

            // Line
            $pdf->Line(160, $saveY, 160, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162, $saveY + 5);
            $pdf->Write(3, "EUR**" . number_format($preis_Viererticket_Kind, 2));

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(20 + 190, $saveY - $cellHeightTopBottom - $cellHeightMain);

            $anzKinder--;

        }
        else if ($anzKinder != 0 && $count % 2 != 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY($pdf->GetX(), $pdf->GetY());
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28 + 200, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88+ 200, $saveY + 7);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85+ 200, $saveY + 15);
            $pdf->Write(0, "ab " . $date);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163+ 200, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10+ 200, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12+ 200, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28+ 200, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86+ 200, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(125+ 200, $saveY + 8);
            $pdf->Write(0, $ticketart);
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159+ 200, $saveY + 8);
            $pdf->Write(0, "1 Kind");

            // Strecke
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(15+ 200, $saveY + 22);
            $pdf->Write(3, "Gilt fuer vier Fahrten im angegebenen Geltungsbereich in");
            $pdf->SetXY(35+ 200, $saveY + 27);
            $pdf->Write(3, "allen Zuegen der ISLM-Bahn");

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10+ 200, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10+ 200, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18+ 200, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45+ 200, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75+ 200, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75+ 200, $saveY + 10);
            $pdf->Write(3, "**" . number_format($preis_Viererticket_Kind, 2));
            $pdf->SetXY(95+ 200, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130+ 200, $saveY + 10);
            $pdf->Write(3, "***" . number_format($preis_Viererticket_Kind * 0.19, 2));

            // Line
            $pdf->Line(160+ 200, $saveY, 160+ 200, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162+ 200, $saveY + 5);
            $pdf->Write(3, "EUR**" . number_format($preis_Viererticket_Kind, 2));

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175+ 200, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(10, $saveY + $gapBetweenTickets);

            $anzKinder--;

        }
        else if ($anzSenior != 0 && $count % 2 == 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY(10, $pdf->GetY() + 10);
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88, $saveY + 7);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85, $saveY + 15);
            $pdf->Write(0, "ab " . $date);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(125, $saveY + 8);
            $pdf->Write(0, $ticketart);
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159, $saveY + 8);
            $pdf->Write(0, "1 Senior");

            // Strecke
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(15, $saveY + 22);
            $pdf->Write(3, "Gilt fuer vier Fahrten im angegebenen Geltungsbereich in");
            $pdf->SetXY(35, $saveY + 27);
            $pdf->Write(3, "allen Zuegen der ISLM-Bahn");

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75, $saveY + 10);
            $pdf->Write(3, "**" . number_format($preis_Viererticket_Senior, 2));
            $pdf->SetXY(95, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130, $saveY + 10);
            $pdf->Write(3, "***" . number_format($preis_Viererticket_Senior * 0.19, 2));

            // Line
            $pdf->Line(160, $saveY, 160, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162, $saveY + 5);
            $pdf->Write(3, "EUR**" . number_format($preis_Viererticket_Senior, 2));

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(20 + 190, $saveY - $cellHeightTopBottom - $cellHeightMain);

            $anzSenior--;

        }
        else if ($anzSenior != 0 && $count % 2 != 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY($pdf->GetX(), $pdf->GetY());
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28 + 200, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88+ 200, $saveY + 7);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85+ 200, $saveY + 15);
            $pdf->Write(0, "ab " . $date);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163+ 200, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10+ 200, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12+ 200, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28+ 200, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86+ 200, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(125+ 200, $saveY + 8);
            $pdf->Write(0, $ticketart);
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159+ 200, $saveY + 8);
            $pdf->Write(0, "1 Senior");

            // Strecke
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(15+ 200, $saveY + 22);
            $pdf->Write(3, "Gilt fuer vier Fahrten im angegebenen Geltungsbereich in");
            $pdf->SetXY(35+ 200, $saveY + 27);
            $pdf->Write(3, "allen Zuegen der ISLM-Bahn");

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10+ 200, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10+ 200, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18+ 200, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45+ 200, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75+ 200, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75+ 200, $saveY + 10);
            $pdf->Write(3, "**" . number_format($preis_Viererticket_Senior, 2));
            $pdf->SetXY(95+ 200, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130+ 200, $saveY + 10);
            $pdf->Write(3, "***" . number_format($preis_Viererticket_Senior * 0.19, 2));

            // Line
            $pdf->Line(160+ 200, $saveY, 160+ 200, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162+ 200, $saveY + 5);
            $pdf->Write(3, "EUR**" . number_format($preis_Viererticket_Senior, 2));

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175+ 200, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(10, $saveY + $gapBetweenTickets);

            $anzSenior--;

        }
        else if ($anzErmaesigt != 0 && $count % 2 == 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY(10, $pdf->GetY() + 10);
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88, $saveY + 7);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85, $saveY + 15);
            $pdf->Write(0, "ab " . $date);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(125, $saveY + 8);
            $pdf->Write(0, $ticketart);
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159, $saveY + 8);
            $pdf->Write(0, "1 Ermaessigt");

            // Strecke
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(15, $saveY + 22);
            $pdf->Write(3, "Gilt fuer vier Fahrten im angegebenen Geltungsbereich in");
            $pdf->SetXY(35, $saveY + 27);
            $pdf->Write(3, "allen Zuegen der ISLM-Bahn");

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75, $saveY + 10);
            $pdf->Write(3, "**" . number_format($preis_Viererticket_Ermaessigt, 2));
            $pdf->SetXY(95, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130, $saveY + 10);
            $pdf->Write(3, "***" . number_format($preis_Viererticket_Ermaessigt * 0.19, 2));

            // Line
            $pdf->Line(160, $saveY, 160, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162, $saveY + 5);
            $pdf->Write(3, "EUR**" . number_format($preis_Viererticket_Ermaessigt, 2));

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(20 + 190, $saveY - $cellHeightTopBottom - $cellHeightMain);

            $anzErmaesigt--;

        }
        else if ($anzErmaesigt != 0 && $count % 2 != 0) {
            // Oberer Teil ////////////////////////////////////////
            $pdf->SetXY($pdf->GetX(), $pdf->GetY());
            $pdf->Cell(70, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(40, $cellHeightTopBottom, "", 1, 0, 'C');
            $pdf->Cell(80 + $gaprechts, $cellHeightTopBottom, "", 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM-Bahn
            $pdf->SetFont('Arial', 'BI', 16);
            $pdf->SetXY(28 + 200, $saveY + 10);
            $pdf->Write(0, "ISLM-Bahn");

            // Gültigkeit
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(88+ 200, $saveY + 7);
            $pdf->Write(0, "Gueltigkeit: ");
            $pdf->SetXY(85+ 200, $saveY + 15);
            $pdf->Write(0, "ab " . $date);

            // Datum
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(163+ 200, $saveY + 8);
            $pdf->Write(0, $date);

            // Hauptteil ////////////////////////////////////////////////
            $pdf->SetXY(10+ 200, $saveY + $cellHeightTopBottom);
            $pdf->Cell(190 + $gaprechts, $cellHeightMain, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // ISLM Fahrkarte
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(12+ 200, $saveY + 8);
            $pdf->Write(0, "ISLM");
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetXY(28+ 200, $saveY + 8);
            $pdf->Write(0, "Fahrkarte");

            // Klasse
            $pdf->SetXY(86+ 200, $saveY + 8);
            $pdf->Write(0, "Klasse " . $klasse);

            // Einzelticket
            $pdf->SetXY(125+ 200, $saveY + 8);
            $pdf->Write(0, $ticketart);
            $pdf->SetFont('Arial', '', 16);
            $pdf->SetXY(159+ 200, $saveY + 8);
            $pdf->Write(0, "1 Ermaessigt");

            // Strecke
            $pdf->SetFont('Arial', '', 13);
            $pdf->SetXY(15+ 200, $saveY + 22);
            $pdf->Write(3, "Gilt fuer vier Fahrten im angegebenen Geltungsbereich in");
            $pdf->SetXY(35+ 200, $saveY + 27);
            $pdf->Write(3, "allen Zuegen der ISLM-Bahn");

            // Unterer Teil ////////////////////////////////////////////////

            $pdf->SetXY(10+ 200, $saveY + $cellHeightMain);
            $pdf->Cell(190 + $gaprechts, $cellHeightTopBottom, '', 1, 0, 'C');

            $saveY = $pdf->GetY();

            // Datum und Uhrzeit
            $pdf->SetXY(10+ 200, $saveY + 8);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(18+ 200, $saveY + 8);
            $pdf->Write(3, $date);
            $pdf->SetXY(45+ 200, $saveY + 8);
            $pdf->Write(3, $time);

            // Mehrwertsteuerberechnung
            $pdf->SetXY(75+ 200, $saveY + 6);
            $pdf->Write(3, "MwSt D:");
            $pdf->SetXY(75+ 200, $saveY + 10);
            $pdf->Write(3, "**" . number_format($preis_Viererticket_Ermaessigt, 2));
            $pdf->SetXY(95+ 200, $saveY + 10);
            $pdf->Write(3, "19,00% = ");
            $pdf->SetXY(130+ 200, $saveY + 10);
            $pdf->Write(3, "***" . number_format($preis_Viererticket_Ermaessigt * 0.19, 2));

            // Line
            $pdf->Line(160+ 200, $saveY, 160+ 200, $saveY + 20);

            // Betrag
            $pdf->SetFont('Arial', 'B', 18);
            $pdf->SetXY(162+ 200, $saveY + 5);
            $pdf->Write(3, "EUR**" . number_format($preis_Viererticket_Ermaessigt, 2));

            $pdf->SetFont('Arial', '', 12);
            $pdf->SetXY(175+ 200, $saveY + 13);
            $pdf->Write(3, "Barzahlung");

            // Abstand zwischen Tickets in der PDF
            $pdf->SetXY(10, $saveY + $gapBetweenTickets);

            $anzErmaesigt--;

        }
        $count++;
    }
}


/*

// Ab hier nichts anfassen
$pdf->SetFont('Arial','BI',16);
$pdf->Cell(70,20,"ISLM-Bahn",1,0,'C');

$y = $pdf->GetY();
$x = $pdf->GetX();

if (!$isAboTicket) {
    $pdf->SetFont('Arial', '', 13);
    $pdf->MultiCell(40, 10, "Gueltigkeit:\nab " . $date, 1, 'C');
}
else {
    $pdf->SetFont('Arial', '', 13);
    $pdf->MultiCell(40, 20/3, "Gueltigkeit:\nab " . $date."\nbis ".$result, 1, 'C');
}

$pdf->SetXY($x + 40, $y);
$pdf->Cell(80,20, $date, 1, 2, "R");


$pdf->SetXY(10 , 30);
$pdf->Cell(190,40,'',1,0,'C');

$pdf->SetFont('Arial','',16);
$pdf->SetXY(12 , 35);
$pdf->Write(3,"ISLM");
$pdf->SetFont('Arial','B',16);
$pdf->SetXY(28 , 35);
$pdf->Write(3,"Fahrkarte");
$pdf->SetXY(86 , 35);
$pdf->Write(3,"Klasse ".$klasse);
$pdf->SetXY(120 , 35);
$pdf->Write(3,$ticketart);
$pdf->SetFont('Arial','',16);
$pdf->SetXY(160 , 35);

if ($anzErwachsene != "0") {
    $pdf->Write(3,$anzErwachsene." Erwachsene");
    $pdf->SetXY(160 , $pdf->GetY() + 7);
}
if ($anzKinder != "0") {
    $pdf->Write(3,$anzKinder." Kinder");
    $pdf->SetXY(160 , $pdf->GetY() + 7);
}
if ($anzErmaesigt != "0") {
    $pdf->Write(3,$anzErmaesigt." Ermaessigt");
    $pdf->SetXY(160 , $pdf->GetY() + 7);
}
if ($anzSenior != "0") {
    $pdf->Write(3,$anzSenior." Senioren");
    $pdf->SetXY(160 , $pdf->GetY() + 7);
}
if (!$isAboTicket) {
    $pdf->SetFont('Arial', '', 16);
    $pdf->SetXY(12, 50);
    $pdf->Write(3, "ISLM-Bahn Von: ");

    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetXY(55, 50);
    $pdf->Write(3, $standort);

    $pdf->SetFont('Arial', '', 16);
    $pdf->SetXY(42, 57);
    $pdf->Write(3, "Nach: ");

    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetXY(58, 57);
    $pdf->Write(3, $zielort);
}
else {
    $pdf->SetFont('Arial', '', 13);
    $pdf->SetXY(15, 55);
    $pdf->Write(3, "Gilt fuer Fahrten im angegebenen Geltungsbereich in");
    $pdf->SetXY(35, 60);
    $pdf->Write(3, "allen Zuegen der ISLM-Bahn");
}

$pdf->SetXY(10 , 70);
$pdf->Cell(190,18,'',1,0,'C');
$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(18, 78);
$pdf->Write(3, $date);
$pdf->SetXY(45, 78);
$pdf->Write(3, $time);

$pdf->SetXY(75, 74);
$pdf->Write(3, "MwSt D:");
$pdf->SetXY(75, 80);
$pdf->Write(3, "**".number_format($price,2));
$pdf->SetXY(95, 80);
$pdf->Write(3, "19,00% = ");
$pdf->SetXY(130, 80);
$pdf->Write(3, "***".number_format($price * 0.19,2));

$pdf->Line(160,70,160,88);


$pdf->SetFont('Arial', 'B', 18);
$pdf->SetXY(162, 75);
$pdf->Write(3, "EUR**".number_format($price,2));

$pdf->SetFont('Arial', '', 12);
$pdf->SetXY(170, 83);
$pdf->Write(3, "Barzahlung");

*/
$pdf->SetAuthor("ISLM-Bahn");
$pdf->SetTitle("Tickets");
$pdf->Output('F',"ISLM_Ticket.pdf",true);


header('Location: drucken.php');

?>
