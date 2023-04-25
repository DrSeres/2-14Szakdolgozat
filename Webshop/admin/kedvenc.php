<?php 

require("kapcsolat.php");
session_start();
if(isset($_SESSION['user_type'])){
    if($_SESSION['user_type'] != 'admin'){
        header("location:false.php");
    }
}


$query = "SELECT termek.termekNev, termek.foto, termek.darab, termek.ar, COUNT(termek.termekNev) AS 'kedveles' FROM `kedvenctermekek` INNER JOIN termek ON kedvenctermekek.termekId=termek.id GROUP BY termek.termekNev;";
$result = mysqli_query($dbconnect, $query);

if (mysqli_num_rows($result) > 0) {
    $kimenet = "<div class='tableContainer'>
    <table>
    <tr>
        <th>Kép</th>
        <th>Termék neve</th>
        <th>Raktáron</th>
        <th>Ár</th>
        <th>Kedvelések száma</th>
    </tr>
 ";
    while ($sor = mysqli_fetch_array($result)) {
      $raktaron = ($sor['darab'] == 0) ? "color:red" : "";
        $kimenet .= "<tr>
        <td><img src=\"../img/termekekuj/{$sor['foto']}\" alt=\"pro\"></td>
        <td style='$raktaron'>{$sor['termekNev']}</td>
        <td style='$raktaron'>{$sor['darab']}</td>
        <td style='$raktaron'>{$sor['ar']}</td>
        <td style='$raktaron'>{$sor['kedveles']}</td>
  ";
    }
    $kimenet .= "</table>";
    $kimenet .= "</div>";
    
} else{
  $kimenet = "";
}






?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kedvenc termékek</title>
    <link rel="stylesheet" href="css/kedvencTermek.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
    
    <h2 id="kategoria">Kedvenc termékek</h2>
    <p class="gombok"><a href="kategoria.php"><button>Vissza a főoldalra</button></a></p>
    <div class="main">
      <div class="flexbox-container" id="result">
    <?php echo $kimenet?>   
      </div>
    </div>
</body>
</html>