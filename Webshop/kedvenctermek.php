<?php 

require("kapcsolat.php");
session_start();
$select = "SELECT * FROM termek INNER JOIN kedvencek WHERE id = '{$id}'";
$query = mysqli_query($dbconnect, $select);




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kedvenc termék</title>
</head>
<body>
    
</body>
</html>