<?php
session_start();

if (!$_SESSION['login']) {
    header('Location: login.php');
    exit();
}


if (!empty($_POST['submit'])) {
    $jsonData = [
        'erwachsene' => str_replace('%','',$_POST['erwachsene']),
        'kinder' => str_replace('%','',$_POST['kinder']),
        'senioren' => str_replace('%','',$_POST['senioren']),
        'ermaessigt' => str_replace('%','',$_POST['ermaessigt']),
        'kurz' => str_replace('%','',$_POST['kurz']),
        'mittel' => str_replace('%','',$_POST['mittel']),
        'lang' => str_replace('%','',$_POST['lang']),
        'klasse2' => str_replace('%','',$_POST['klasse2']),
        'klasse1' => str_replace('%','',$_POST['klasse1']),
        'einzelticket' => str_replace('€','',$_POST['einzelticket']),
        'viererticket' => str_replace('€','',$_POST['viererticket']),
        'gruppenticket5' => str_replace('€','',$_POST['gruppenticket5']),
        'gruppenticket10' => str_replace('€','',$_POST['gruppenticket10']),
        'tagesticket' => str_replace('€','',$_POST['tagesticket']),
        'monatsticket' => str_replace('€','',$_POST['monatsticket']),
        'jahresticket' => str_replace('€','',$_POST['jahresticket'])
    ];


    $jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
    $file = fopen('../static/json/configuration.json','w');
    fwrite($file, $jsonString);
    fclose($file);
}

$json = file_get_contents('../static/json/configuration.json');

$json_data = json_decode($json, true);



?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Konfiguration</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../static/css/konfiguration.css">
    <script src="../static/js/errors.js"></script>
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
<form method="post" id="configuration">
<div class="main-grid">
    <div class="left-grid">
        <div>
            <h3>Status-Kunde:</h3>
            <div class="status-kunde">
                <label for="erwachsene">Erwachsene</label> <input oninput="testProzent(this)" autocomplete="off" type="text" id="erwachsene" name="erwachsene" value= <?php echo $json_data['erwachsene'].'%' ?>>
                <label for="kinder">Kinder</label> <input oninput="testProzent(this)" type="text" id="kinder" name="kinder" value= <?php echo $json_data['kinder'].'%' ?>>
                <label for="senioren">Senioren</label> <input oninput="testProzent(this)" type="text" id="senioren" name="senioren" value= <?php echo $json_data['senioren'].'%' ?>>
                <label for="ermaessigt">Ermäßigt</label> <input oninput="testProzent(this)" type="text" id="ermaessigt" name="ermaessigt" value= <?php echo $json_data['ermaessigt'].'%' ?>>
                <p id="status-kunde"></p>
            </div>
            <h3>Dauer:</h3>
            <div class="status-kunde">
                <label for="kurz">Kurz</label> <input oninput="testProzent(this)" type="text" id="kurz" name="kurz" value= <?php echo $json_data['kurz'].'%' ?>>
                <label for="mittel">Mittel</label> <input oninput="testProzent(this)" type="text" id="mittel" name="mittel" value= <?php echo $json_data['mittel'].'%' ?>>
                <label for="lang">Lang</label> <input oninput="testProzent(this)" type="text" id="lang" name="lang" value= <?php echo $json_data['lang'].'%' ?>>
                <p id="dauer"></p>
            </div>
            <h3>Klasse:</h3>
            <div class="status-kunde">
                <label for="klasse2">2.Klasse</label> <input oninput="testProzent(this)" type="text" id="klasse2" name="klasse2" value= <?php echo $json_data['klasse2'].'%' ?>>
                <label for="klasse1">1.Klasse</label> <input oninput="testProzent(this)" type="text" id="klasse1" name="klasse1" value= <?php echo $json_data['klasse1'].'%' ?>>
                <p id="klasse"></p>
            </div>



        </div>
        <div>
        </div>
        <div>

        </div>


    </div>
    <div>
        <h3>Einzelticket:</h3>
        <div class="status-kunde">
            <label for="einzelticket">Normalpreis pro Person</label> <input oninput="testEuro(this)" type="text" id="einzelticket" name="einzelticket" value= <?php echo number_format($json_data['einzelticket'],2,".","").'€' ?>>
            <p id="einzelticketP"></p>
        </div>
        <h3>Viererticket:</h3>
        <div class="status-kunde">
            <label for="viererticket">Normalpreis pro Person</label> <input oninput="testEuro(this)" type="text" id="viererticket" name="viererticket" value= <?php echo number_format($json_data['viererticket'],2,".","").'€' ?>>
            <p id="viererticketP"></p>
        </div>
        <h3>Gruppenticket 5 Personen:</h3>
        <div class="status-kunde">
            <label for="gruppenticket5">Normalpreis pro Person</label> <input oninput="testEuro(this)" type="text" id="gruppenticket5" name="gruppenticket5" value= <?php echo number_format($json_data['gruppenticket5'],2,".","").'€' ?>>
            <p id="gruppenticket5P"></p>
        </div>
        <h3>Gruppenticket 10 Personen:</h3>
        <div class="status-kunde">
            <label for="gruppenticket10">Normalpreis pro Person</label> <input oninput="testEuro(this)" type="text" id="gruppenticket10" name="gruppenticket10" value= <?php echo number_format($json_data['gruppenticket10'],2,".","").'€' ?>>
            <p id="gruppenticket10P"></p>
        </div>

    </div>
    <div>
        <h3>Tagesticket:</h3>
        <div class="status-kunde">
            <label for="tagesticket">Normalpreis pro Person</label> <input oninput="testEuro(this)" type="text" id="tagesticket" name="tagesticket" value= <?php echo number_format($json_data['tagesticket'],2,".","").'€' ?>>
            <p id="tagesticketP"></p>
        </div>
        <h3>Monatsticket:</h3>
        <div class="status-kunde">
            <label for="monatsticket">Normalpreis pro Person</label> <input oninput="testEuro(this)" type="text" id="monatsticket" name="monatsticket" value= <?php echo number_format($json_data['monatsticket'],2,".","").'€' ?>>
            <p id="monatsticketP"></p>
        </div>
        <h3>Jahresticket:</h3>
        <div class="status-kunde">
            <label for="jahresticket">Normalpreis pro Person</label> <input oninput="testEuro(this)" type="text" id="jahresticket" name="jahresticket" value= <?php echo number_format($json_data['jahresticket'],2,".","").'€' ?>>
            <p id="jahresticketP"></p>
        </div>
    </div>


</div>
    <div class="message">
        <?php if(!empty($_POST['submit'])): ?>
        <div>
            <p id="successText">Ihre Eingaben wurden erfolgreich gespeichert</p>
        </div>
        <?php endif; ?>

    </div>
    <div class="bottom-navigation">
        <input type="submit" value="Bestätigen" id="bestätigen" name="submit">
    </div>

</form>

</body>
</html>
