<?php


require("../Webshop/kapcsolat.php");
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$nev = $_POST["nev"];
$rendelesDb = $_POST['rendelesDb'];
$prices = $_POST['prices'];



$select = "SELECT email FROM users WHERE name = '{$_SESSION['name']}'";
print($select);

$result = mysqli_query($dbconnect, $select);
$eredmeny = mysqli_fetch_array($result);
print_r($eredmeny);
$email = $eredmeny['email'];
print_r($email);

$sql = "INSERT INTO `megrendeles`(`id`, `emailNev`, `nev`, `price`, `darab`) VALUES ('','{$email}', '{$nev}','{$prices}','{$rendelesDb}')";
$eredmeny = mysqli_query($dbconnect, $sql);

?>