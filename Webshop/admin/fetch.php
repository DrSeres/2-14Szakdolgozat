<?php
//fetch.php
require("kapcsolat.php");

$output = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($dbconnect, $_POST["query"]);
    $query = "SELECT * FROM termek INNER JOIN gyartokategoria ON termek.gyartoKategoriaId=gyartokategoria.gyartoKategoriaId INNER JOIN gyarto ON gyartokategoria.gyartoId=gyarto.gyartoId INNER JOIN kategoria ON gyartokategoria.kategoriaID=kategoria.kategoriaID
    WHERE termek.termekNev LIKE '%{$search}%'
    OR gyarto.gyartoNev LIKE '%{$search}%'
    OR  kategoria.kategoriaNev LIKE '%{$search}%'";
} else {
    $query = "SELECT * FROM termek INNER JOIN gyartokategoria ON termek.gyartoKategoriaId=gyartokategoria.gyartoKategoriaId INNER JOIN gyarto ON gyartokategoria.gyartoId=gyarto.gyartoId INNER JOIN kategoria ON gyartokategoria.kategoriaID=kategoria.kategoriaID ORDER BY termek.id";    
}
$result = mysqli_query($dbconnect, $query);
if (mysqli_num_rows($result) > 0) {
    $kimenet = "<div class='tableContainer'>
    <table class='kategoriaTable'>
    <tr>
        <th>Kép</th>
        <th>Kategória</th>
        <th>Gyártó</th>
        <th>Termék</th>
        <th class='tableAr'>Ár</th>
        <th>Raktáron</th>
        <th>Műveletek</th>
    </tr>
 ";
    while ($sor = mysqli_fetch_array($result)) {
        $raktaron = ($sor['darab'] == 0) ? "color:red" : "";
        $kimenet .= "<tr>
        <td><img src=\"../img/termekekuj/{$sor['foto']}\" alt=\"pro\"></td>
        <td style='$raktaron'>{$sor['kategoriaNev']}</td>
        <td style='$raktaron'>{$sor['gyartoNev']}</td>
        <td style='$raktaron'>{$sor['termekNev']}</td>
        <td style='$raktaron'>" . number_format($sor['ar'], 0, ',', ' ') ." Ft</td>
        <td style='$raktaron'>{$sor['darab']} darab</td>
        <td class='muveletek'><a href=\"torles.php?id={$sor['id']}\" class=\"gomboks\" style='$raktaron'>Törlés</a>  <a href=\"modositas.php?id={$sor['id']}\" class=\"gomboks\" style='$raktaron' >Módosítás</a>  <a href=\"reszletek.php?id={$sor['id']}\" class=\"gomboks\" style='$raktaron'>Részletek</a></td>
  ";
    }
    $kimenet .= "</table>";
    $kimenet .= "<div>";
    echo $kimenet;
} else {
    $kimenet = "<table>
    <tr>
        <th style='padding:10px'>Nem található az Ön által keresett termék</th>
    </tr>";
    echo $kimenet;
}
