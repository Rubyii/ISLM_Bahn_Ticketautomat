<?php
session_start();
if (!empty($_POST['weiter'])) {

    $jsonData = [
        'bestand' => (float) $_POST['bestand']
    ];

    $jsonString = json_encode($jsonData, JSON_PRETTY_PRINT);
    $file = fopen('static/json/bestand.json','w');
    fwrite($file, $jsonString);
    fclose($file);

    echo '<script type="text/javascript">'.
        'parent.window.location = "/static/php/statistik_handler.php";',
    '</script>';
}
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bezahlen</title>
    <link rel="stylesheet" href="static/css/popup_1.css">

</head>
<body>
<div class="top-text">
    <span>Bezahlung erfolgt</span> <br>
    <span id="wechselgeld">Ihr Wechselgeld beträgt</span> <br>
    <span>Ihr Ticket folgt in Kürze...</span>

</div>

</body>
<script src="static/js/zahlungsabwicklung.js"></script>

<div class="main-grid">
    <div>
        <span id="1centR">x0</span>
        <button style="pointer-events: none" class="button-gruen">1 Cent</button>
    </div>
    <div>
        <span id="2centR">x0</span>
        <button style="pointer-events: none" class="button-gruen">2 Cent</button>
    </div>
    <div>
        <span id="5centR">x0</span>
        <button style="pointer-events: none" class="button-gruen">5 Cent</button>
    </div>
    <div>
        <span id="10centR">x0</span>
        <button style="pointer-events: none" class="button-gruen">10 Cent</button>
    </div>
    <div>
        <span id="20centR">x0</span>
        <button style="pointer-events: none" class="button-gruen">20 Cent</button>
    </div>
    <div>
        <span id="50centR">x0</span>
        <button style="pointer-events: none" class="button-gruen">50 Cent</button>
    </div>
    <div>
        <span id="1euroR">x0</span>
        <button style="pointer-events: none" class="button-gruen">1€</button>
    </div>
    <div>
        <span id="2euroR">x0</span>
        <button style="pointer-events: none" class="button-gruen">2€</button>
    </div>
    <div>
        <span id="5euroR">x0</span>
        <button style="pointer-events: none" class="button-gruen">5€</button>
    </div>
    <div>
        <span id="10euroR">x0</span>
        <button style="pointer-events: none" class="button-gruen">10€</button>
    </div>
    <div>
        <span id="20euroR">x0</span>
        <button style="pointer-events: none" class="button-gruen">20€</button>
    </div>
    <div>
        <span id="50euroR">x0</span>
        <button style="pointer-events: none" class="button-gruen">50€</button>
    </div>
    <div>
        <span id="100euroR">x0</span>
        <button style="pointer-events: none" class="button-gruen">100€</button>
    </div>

</div>

<form method="post" >
    <button class="button-gruen1" type="submit" name="weiter" value="weiter" id="entnommen">Rückgeld entnommen</button>
    <input type="hidden" id="bestand" value="0" name="bestand">
</form>
</html>
