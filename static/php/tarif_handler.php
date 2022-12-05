<?php
session_start();

if(isset($_POST['tarif'])){
    $_SESSION['tarif'] = $_POST['tarif'];
    header('Location: ../../uebersicht.php');
}


if (isset($_POST['Abbrechen'])) {
    session_unset();
    session_destroy();
    session_regenerate_id();
    header('Location: ../../startseite.php');
} elseif(isset($_POST['Zurück'])){
    $_SESSION['Zurück'] = $_POST['Zurück'];
    header('Location: ../../Anzahl_Reisende.php');
}

/*foreach ($_POST as $key => $value) {
    echo "The POSTkey is ".$key." and value ". $value;
    echo "<br>";
}

foreach ($_SESSION as $key => $value) {
    echo "The SESSIONTkey is ".$key." and value ". $value;
    echo "<br>";
}*/


?>

<!---
<!DOCTYPE html>
<html lang="de">
<head>
    <title>TEST</title>
</head>
<body>
<button onclick="window.location.href='tarif.php';">
    Click Here
</button>
</body>
</html>
--->
