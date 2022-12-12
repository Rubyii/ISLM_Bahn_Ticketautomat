<?php
session_start();

if (!$_SESSION['login']) {
    header('Location: login.php');
    exit();
}

$json = file_get_contents('../static/json/statistik.json');

$json_data = json_decode($json, true);


?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Statistik</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../static/css/statistik.css">
</head>
<body>
<div class="top-navigation">
    <div>
        <img alt="islm-bahn" src="../static/images/ISLM_Logo2009.png">
    </div>


    <form method="post" class="zurückArea" action="auswahlseite.php">
        <input type="submit" value="zurück" name="zurück" id="zurück">
    </form>
</div>

<header>
    <h2>Bitte wählen Sie den Anwendungszeitraum aus</h2>
    <span>Von</span>
    <input type="date" name="startzeitraum">
    <span>bis</span>
    <input type="date" name="endzeitraum">
</header>

<main>
    <table>
        <tr>
            <td colspan="3" class="custom-table">Statistik</td>
        </tr>
        <tr>
            <td class="custom-table" id="tarif-cell">Tarife</td>
            <td class="custom-table">Umsatz</td>
            <td class="custom-table">Anzahl verkaufter Tickets</td>
        </tr>
        <tr>
            <td class="custom-table-data custom-table-data-bold">Gesamt</td>
            <td class="custom-table-data"><?php echo number_format($json_data['gesamt_euro'],2,',','.').'€'?></td>
            <td class="custom-table-data"><?php echo number_format($json_data['gesamt_anzahl'],0,',','.')?></td>
        </tr>
        <tr>
            <td class="custom-table-data custom-table-data-bold">Einzeltickets</td>
            <td class="custom-table-data"><?php echo number_format($json_data['einzeltickets_euro'],2,',','.').'€'?></td>
            <td class="custom-table-data"><?php echo number_format($json_data['einzeltickets_anzahl'],0,',','.')?></td>
        </tr>
        <tr>
            <td class="custom-table-data custom-table-data-bold">Viererticket</td>
            <td class="custom-table-data"><?php echo number_format($json_data['vierertickets_euro'],2,',','.').'€'?></td>
            <td class="custom-table-data"><?php echo number_format($json_data['vierertickets_anzahl'],0,',','.')?></td>
        </tr>
        <tr>
            <td class="custom-table-data custom-table-data-bold">5er Gruppenticket</td>
            <td class="custom-table-data"><?php echo number_format($json_data['gruppenticket5_euro'],2,',','.').'€'?></td>
            <td class="custom-table-data"><?php echo number_format($json_data['gruppenticket5_anzahl'],0,',','.')?></td>
        </tr>
        <tr>
            <td class="custom-table-data custom-table-data-bold">10er Gruppenticket</td>
            <td class="custom-table-data"><?php echo number_format($json_data['gruppenticket10_euro'],2,',','.').'€'?></td>
            <td class="custom-table-data"><?php echo number_format($json_data['gruppenticket10_anzahl'],0,',','.')?></td>
        </tr>
    </table>

</main>

</body>
</html>
