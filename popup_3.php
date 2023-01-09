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
    <script async defer src="static/js/keinRechtsclick.js"></script>
    <script async defer src="static/js/keinZurueck.js"></script>
</head>
<body>
<div class="main">
    <p><?php echo $_SESSION['language']['nichtgenugGeld']?> <br> <?php echo $_SESSION['language']['fürwechselgeld']?>
    <br> <?php echo $_SESSION['language']['personalwenden']?></p>
    <form method="post" >
        <button class="button-orange" type="submit" name="abbrechen" value="abbrechen" id="entnommen"><?php echo $_SESSION['language']['abbrechen']?></button>

    </form>

</div>


</body>
<script src="static/js/zahlungsabwicklung.js"></script>

</html>
