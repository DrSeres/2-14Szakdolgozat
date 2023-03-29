<?php

//Űrlap feldolgozása

require("kapcsolat.php"); 

// if(!isset($_SESSION['user_type']) == 'admin'){
//   header("location:false.php");
// }




// $sql = "SELECT * FROM kategoria
//         INNER JOIN gyarto ON kategoria.kategoriaID = gyarto.kategoriaID";



$id = (int)$_GET['id'];
$sql = "SELECT*
        FROM termek
        INNER JOIN gyartokategoria ON termek.gyartoKategoriaId=gyartokategoria.gyartoKategoriaId
        INNER JOIN gyarto ON gyartokategoria.gyartoId=gyarto.gyartoId
        INNER JOIN kategoria ON gyartokategoria.kategoriaID=kategoria.kategoriaID
        WHERE id = {$id}";
$eredmeny = mysqli_query($dbconn, $sql);
$sor = mysqli_fetch_assoc($eredmeny);

$cim = $sor['termekNev'];
$termek = $sor['gyartoNev'] . " " . $sor['termekNev'];
$leiras = $sor['leiras'];
$ar = $sor['ar'];
$foto = $sor['foto'];



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/felv_mod.css">
    <link rel="stylesheet" href="css/reszletei.css">
    <link rel="stylesheet" href="css/table.css">
    <title> <?php print $cim ?></title>
    <script src="ckeditor.js"></script>
</head>

<body>
    <div class="container">
        <h1><?php print $termek ?> adatai</h1>
        <img src="../img/termekekuj/<?php print $foto;?>" alt="">
        <form method="post" enctype="multipart/form-data">
            <?php print $leiras; ?>
            <p><a href="kategoria.php">Vissza az oldalra</a></p>
        </form>
    </div>
</body>

</html>