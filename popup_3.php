<?php
session_start();

if (!empty($_POST['abbrechen'])) {
    session_unset();
    session_destroy();
    session_regenerate_id();
    echo '<script type="text/javascript">'.
        'parent.window.location = "startseite.php";',
    '</script>';

}

?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bezahlen</title>
    <link rel="stylesheet" href="static/css/popup_3.css">

</head>
<body>
<div class="main">
    <p>Es ist nicht genügend Geld im Automaten <br> um das Wechselgeld auszugeben</p>
    <p>Bitte wenden Sie sich an das Bahnpersonal</p>
    <form method="post" >
        <button class="button-orange" type="submit" name="abbrechen" value="abbrechen" id="entnommen">Abbrechen</button>

    </form>

</div>


</body>
<script src="static/js/zahlungsabwicklung.js"></script>

</html>
