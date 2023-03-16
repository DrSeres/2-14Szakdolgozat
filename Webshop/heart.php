<?php 

require("kapcsolat.php");
session_start();
$termekid = $_POST['id'];
print_r($termekid);



$sql = "SELECT * FROM users WHERE name = '{$_SESSION['name']}'";
print($sql);
$eredmeny = mysqli_query($dbconnect, $sql);
$sor = mysqli_fetch_array($eredmeny);
$usersid = $sor['id'];



// $select = "SELECT * FROM termek WHERE id = '{$termekid}'";
// $query = mysqli_query($dbconnect, $select);
// $eredmeny = mysqli_fetch_array($query);

// $van = "SELECT * FROM kedvenctermekek";
// $er = mysqli_query($dbconnect, $van);
// $sorozat = mysqli_fetch_array($er);
// $kedvencId = $sorozat['id'];
// print(" ");
// print($kedvencId);
$sql = "SELECT * FROM kedvenctermekek";
$ki = mysqli_query($dbconnect, $sql);
$sor = mysqli_fetch_array($ki);
$id = $sor['id'];

$van = "SELECT * FROM kedvenctermekek WHERE id = {$id}";
$er = mysqli_query($dbconnect, $van);


if(mysqli_num_rows($er) < 0){
    $update = "UPDATE kedvenctermekek SET `termekId`='{$termekid}' WHERE id = {$id}";
    $eredmeny = mysqli_query($dbconnect, $update);
}
else{
    $sql = "INSERT INTO `kedvenctermekek`(`id`, `termekId`, `usersId`) VALUES ('','{$termekid}','{$usersid}')";
    $eredmeny = mysqli_query($dbconnect, $sql);
}

// $k = "SELECT * FROM kedvenctermekek WHERE id = {$kedvencId}";
// $erd = mysqli_query($dbconnect, $k);



// if(mysqli_num_rows($erd) > 0){
//     $update = "UPDATE `kedvenctermekek` SET `termekId`='{$termekid}',`usersId`='{$usersid}' WHERE id = {$kedvencId}";
//     $eredmeny = mysqli_query($dbconnect, $update);
// }
// else{
//     if(mysqli_num_rows($query) < 0){
    
    
//         $sql = "INSERT INTO `kedvenctermekek`(`id`, `termekId`, `usersId`) VALUES ('','{$termekid}','{$usersid}')";
//         $eredmeny = mysqli_query($dbconnect, $sql);
//     }
// }



