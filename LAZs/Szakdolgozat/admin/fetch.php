<?php
//fetch.php
require("kapcsolat.php");











$output = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($dbconn, $_POST["query"]);
    $query = "SELECT * FROM termek INNER JOIN gyartokategoria ON termek.gyartoKategoriaId=gyartokategoria.gyartoKategoriaId INNER JOIN gyarto ON gyartokategoria.gyartoId=gyarto.gyartoId INNER JOIN kategoria ON gyartokategoria.kategoriaID=kategoria.kategoriaID
    WHERE termek.termekNev LIKE '%{$search}%'
    OR gyarto.gyartoNev LIKE '%{$search}%'
    OR  kategoria.kategoriaNev LIKE '%{$search}%'";
} else {
    $query = "SELECT * FROM termek INNER JOIN gyartokategoria ON termek.gyartoKategoriaId=gyartokategoria.gyartoKategoriaId INNER JOIN gyarto ON gyartokategoria.gyartoId=gyarto.gyartoId INNER JOIN kategoria ON gyartokategoria.kategoriaID=kategoria.kategoriaID ORDER BY termek.id";

    
}
$result = mysqli_query($dbconn, $query);
if (mysqli_num_rows($result) > 0) {
    $kimenet = "
    <table class='kategoriaTable'>
    <tr>
        <th>Kép</th>
        <th>Kategória</th>
        <th>Gyártó</th>
        <th>Termék</th>
        <th>Ár</th>
        <th>Műveletek</th>
    </tr>
 ";
    while ($sor = mysqli_fetch_array($result)) {
        $kimenet .= "<tr>
        <td><img src=\"../img/termekekuj/{$sor['foto']}\" alt=\"pro\"></td>
        <td>{$sor['kategoriaNev']}</td>
        <td>{$sor['gyartoNev']}</td>
        <td>{$sor['termekNev']}</td>
        <td>{$sor['ar']}</td>
        <td><a href=\"torles.php?id={$sor['id']}\" class=\"gomboks\">Törlés</a> | <a href=\"modositas.php?id={$sor['id']}\" class=\"gomboks\">Módosítás</a> | <a href=\"reszletek.php?id={$sor['id']}\" class=\"gomboks\">Részletek</a></td>
  ";
    }
    $kimenet .= "</table>";
    echo $kimenet;
} else {
    $kimenet = "<table>
    <tr>
        <th style='padding:10px'>Nem található az Ön által keresett termék</th>
    </tr>";
    echo $kimenet;
}
