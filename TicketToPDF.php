<?php
require ('fpdf/fpdf.php');
date_default_timezone_set('Europe/Berlin');
$date = date('d.m.Y');
$time = date('h:i');
$klasse = "1"; // AUS JSON AUSLESEN
$ticketart = "Jahresticket"; // AUS JSON AUSLESEN
$anzErwachsene = "0"; // AUS JSON AUSLESEN
$anzKinder = "1"; // AUS JSON AUSLESEN
$anzErmaesigt = "0"; // AUS JSON AUSLESEN
$anzSenior = "0"; // AUS JSON AUSLESEN
$standort = "Koeln"; // AUS JSON AUSLESEN
$zielort = "Aachen"; // AUS JSON AUSLESEN
$isAboTicket = true; // BOOLEAN AUS JSON AUSLESEN
$price = 50;

$pdf = new FPDF();

$pdf->AddPage();

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

$pdf->Output();