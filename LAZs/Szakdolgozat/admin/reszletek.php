<?php

//Űrlap feldolgozása

require("kapcsolat.php");
// $sql = "SELECT * FROM kategoria
//         INNER JOIN gyarto ON kategoria.kategoriaID = gyarto.kategoriaID";



$id = (int)$_GET['id'];
$sql = "SELECT*
        FROM termek
        WHERE id = {$id}";
$eredmeny = mysqli_query($dbconn, $sql);
$sor = mysqli_fetch_assoc($eredmeny);


$leiras = $sor['leiras'];
$ar = $sor['ar'];



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/felv_mod.css">
    <link rel="stylesheet" href="css/table.css">
    <title> <?php print $cim ?></title>
    <script src="ckeditor.js"></script>
</head>

<body>
    <div class="container">
        
        <form method="post" enctype="multipart/form-data">

           <textarea name="leiras" id="editor" cols="30" rows="10"><?php print $leiras;?></textarea>
            <p><a href="kategoria.php">Vissza az oldalra</a></p>
        </form>
    </div>
<script>
    CKEDITOR.replace('editor');
</script>
</body>

</html>