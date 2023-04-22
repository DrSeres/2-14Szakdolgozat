<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['id'])) {
    require("kapcsolat.php");
    $id = (int)$_GET['id'];

    $kedvenc = "DELETE FROM kedvenctermekek WHERE termekId = {$id}";
    mysqli_query($dbconnect, $kedvenc);

    $megrendeles = "DELETE FROM megrendeles WHERE termekId = {$id}";
    mysqli_query($dbconnect, $megrendeles);
    $sql = "DELETE FROM termek
            WHERE id = {$id}";
    mysqli_query($dbconnect, $sql);
}
header("location: kategoria.php");

?>