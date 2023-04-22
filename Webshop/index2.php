<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("kapcsolat.php");

$u = "UPDATE `termek` SET akcio = 0";
mysqli_query($dbconnect, $u);
$sors = "UPDATE termek SET akcio = 1 ORDER BY rand() LIMIT 5";
mysqli_query($dbconnect, $sors);


// echo $reload;
// if( isset( $_SERVER['HTTP_REFERER'] ) ){
//     $url =  $_SERVER['HTTP_REFERER'];
    
// }
// $reload = "<script>window.location.reload()</script>";
// header("Refresh: 0; url=$url");

// $page = $_SERVER['PHP_SELF'];
// $sec = "10";
// header("Refresh: $sec; url=$page");



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        window.onload = () =>{
            let a = window.localStorage.getItem('oldal');
            window.location.reload(true);
            console.log(a);
            location.href = a;
        }
        
    </script>
</body>
</html>