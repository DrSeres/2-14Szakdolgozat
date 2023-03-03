<?php

require("../Webshop/kapcsolat.php");
$nev = $_POST["nev"];
$rendelesDb = $_POST['rendelesDb'];
$prices = $_POST['prices'];

$sql = "INSERT INTO `megrendeles`(`id`, `nev`, `price`, `darab`) VALUES ('','{$nev}','{$prices}','{$rendelesDb}')";
$eredmeny = mysqli_query($dbconnect, $sql);

// if(mysqli_num_rows($eredmeny) > 1)
// {
//     $sql = "UPDATE `megrendeles` SET `nev`='{$nev}',`price`='{$prices}',`darab`='{$rendelesDb}'";
// }
echo $eredmeny;
?>