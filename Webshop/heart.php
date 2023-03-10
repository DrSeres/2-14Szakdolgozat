<?php 

require("kapcsolat.php");
session_start();
$id = $_POST['id'];
print_r($id);

$select = "SELECT * FROM termek WHERE id = '{$id}'";
$query = mysqli_query($dbconnect, $select);
$eredmeny = mysqli_fetch_assoc($query);
echo "<pre>";

print_r($eredmeny);
echo "</pre>";

if(mysqli_num_rows($query) > 0){
    $sql = "INSERT INTO `kedvenctermekek`(`id`, `nev`) VALUES ('','sanyi')";
    $eredmeny = mysqli_query($dbconnect, $sql);
}

