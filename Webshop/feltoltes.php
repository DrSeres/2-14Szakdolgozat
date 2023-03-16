<?php


require("../Webshop/kapcsolat.php");
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
print $nev = $_POST["nev"];
$rendelesDb = $_POST['rendelesDb'];
$prices = $_POST['prices'];



$select = "SELECT * FROM users WHERE name = '{$_SESSION['name']}'";
print($select);
$result = mysqli_query($dbconnect, $select);
$eredmeny = mysqli_fetch_array($result);
print_r($eredmeny);
print $userId = $eredmeny['id'];

$sql = "SELECT * FROM termek WHERE termekNev = '{$nev}' ORDER BY id ASC";
print $sql;
$eredmeny = mysqli_query($dbconnect, $sql);
print "<pre>";
$e = mysqli_fetch_array($eredmeny);
echo $id = $e['id'];
print "<pre>";
// print $sor = mysqli_fetch_array($eredmeny);
// print $termekId = $sor['id'];

$sql = "INSERT INTO `megrendeles`(`id`, `usersId`, `termekId`, `raktaron`) VALUES ('','{$userId}','{$id}','{$rendelesDb}')";
print $eredmeny = mysqli_query($dbconnect, $sql);

?>