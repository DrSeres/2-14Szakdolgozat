<?php
require("kapcsolat.php");
session_start();

if(isset($_POST['nyomtatas'])){
    header("location:pdf.php");
    
    
}



?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Köszönjük rendelését</title>
    <link rel="stylesheet" href="../css/koszonjuk.css">
</head>
<body>
    <h1>Köszönjük rendelését!</h1>
    <form method="post" action="pdf.php">
    <div class="kozep">
    <input type="submit" value="Számla nyomtatása PDF-ben" id="nyomtatas" name="nyomtatas">
    <a href="index.php"><input value="Vissza a főoldalra"></a>
        </div>  
    </form>
</body>
</html>