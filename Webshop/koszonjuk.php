<?php
require("kapcsolat.php");
session_start();
if(isset($_POST['vissza'])){
    $update = "UPDATE `megrendeles` INNER JOIN users ON users.id = megrendeles.usersId SET `szamlazva`='2' WHERE szamlazva = 0 AND users.name = '{$_SESSION['name']}'";
    $eredmeny = mysqli_query($dbconnect, $update);
    header("location:index.php");
} else if(isset($_POST['nyomtatas'])){
    header("location:pdf.php");
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="Free Web tutorials"> <!--Keresőmotor optimalizáláshoz kellenek ezen kódsorok -->
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="John Doe">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Köszönjük rendelését</title>
    <link rel="stylesheet" href="../css/koszonjuk.css">
</head>
<body>
    <h1>Köszönjük rendelését!</h1>
    <form method="post">
    <div class="kozep">
    <input type="submit" value="Számla nyomtatása PDF-ben" id="nyomtatas" name="nyomtatas">
    <input type = "submit" value="Vissza a főoldalra" id="vissza" name="vissza">
        </div>  
    </form>
    <script>
        window.onload = () => {
            localStorage.clear();
        }

    </script>
</body>
</html>