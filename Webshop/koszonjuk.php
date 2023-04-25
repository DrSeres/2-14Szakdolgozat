<?php
require("kapcsolat.php");
session_start();
$felhasznalo = $_SESSION['name'];
if(isset($_POST['vissza'])){
    $update = "UPDATE `megrendeles` INNER JOIN users ON users.id = megrendeles.usersId SET `szamlazva`='2' WHERE szamlazva = 1 AND users.name = '{$felhasznalo}'";
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
    <link rel="stylesheet" href="css/koszonjuk.css">
</head>
<body>
    <h1>Köszönjük rendelését!</h1>
    <form method="post">
    <div class="kozep">
    <input type="submit" value="Számla nyomtatása PDF-ben" id="nyomtatas" name="nyomtatas" onclick="clickCounter()">
    <input type = "submit" value="A számlát postán is kérem" id="vissza" name="vissza">
    <a href='index.php'><input type = "button" value="Vissza a főoldalra"  id='fooldalra' name="fooldalra"></a>
    <script>
        let gomb =document.getElementById('fooldalra');
        console.log('GOMB:');
        console.log(gomb);
        gomb.addEventListener('click', () =>{
            localStorage.removeItem('termekek');
        })
    </script>
        </div>  
    </form>
    
    <script src="js/index.js"></script>
</body>
</html>