<?php
session_start();


foreach($_SESSION as $key => $value) {

    echo "<br> SESSION parameter '$key' has '$value' <br>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<a href="../../Anzahl_Reisende.php">TEST</a>
</body>
</html>