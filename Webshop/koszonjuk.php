<?php
require("kapcsolat.php");
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$felhasznalo = $_SESSION['name'];
// if(isset($_POST['vissza'])){
//     $utolsoSor = "SELECT * FROM megrendeles INNER JOIN users ON megrendeles.usersId=users.id WHERE users.name = '{$felhasznalo}' ORDER BY sorszam DESC LIMIT 1";
//     $utolsoSorQuery = mysqli_query($dbconnect, $utolsoSor);
//     $legnagyobbIdSor = mysqli_fetch_assoc($utolsoSorQuery);
//     $legnagyobbSorszam = $legnagyobbIdSor['sorszam'];
//     if(mysqli_num_rows($utolsoSorQuery) > 0){
//         $update = "UPDATE `megrendeles` INNER JOIN users ON users.id = megrendeles.usersId SET `szamlazva`='2' WHERE szamlazva = 1 AND users.name = '{$felhasznalo}' AND megrendeles.sorszam = '{$legnagyobbSorszam}'";
//         $eredmeny = mysqli_query($dbconnect, $update);
//         header("location:index.php");
//     }
    
// } else 
if(isset($_POST['nyomtatas'])){
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
</head>
<body>
    <h1>Köszönjük rendelését!</h1>
    <form method="post">
    <div class="kozep">
    <input type="submit" value="Számla nyomtatása PDF-ben" id="nyomtatas" name="nyomtatas" onclick="clickCounter()">
    <input type = "button" value="A számlát postán is kérem" id="vissza" name="vissza">
    <a href='index.php'><input type = "button" value="Vissza a főoldalra"  id='fooldalra' name="fooldalra"></a>
    <script>
        let gomb =document.getElementById('fooldalra');
        console.log('GOMB:');
        console.log(gomb);
        gomb.addEventListener('click', () =>{
            localStorage.removeItem('termekek');
            
        })
        let szamla =document.getElementById('nyomtatas');
        szamla.addEventListener('click', () => {
            szamla.style.display = "none";
        })
        let vissza =document.getElementById('vissza');
        vissza.addEventListener('click', () => {
            localStorage.removeItem('termekek');
            
        })
    </script>
        </div>  
    </form>
    
    <!-- <script src="js/index.js"></script> -->
    <script src="js/gombPosta.js"></script>
    
</body>
</html>