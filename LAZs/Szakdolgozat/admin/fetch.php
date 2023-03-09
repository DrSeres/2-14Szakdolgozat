<?php
//fetch.php
require("kapcsolat.php");
$output = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($dbconn, $_POST["query"]);
    $query = "SELECT termek.id, gyarto.gyartoNev, termek.termekNev, termek.foto, termek.leiras, termek.ar, kategoria.kategoriaNev FROM `kategoria`
    INNER JOIN gyarto ON kategoria.kategoriaID = gyarto.kategoriaID
    INNER JOIN termek ON gyarto.gyartoId = termek.markaId
    WHERE termek.termekNev LIKE '%{$search}%'
    OR kategoria.kategoriaNev LIKE '%{$search}%'";
} else {
    $query = "SELECT termek.id, gyarto.gyartoNev, termek.termekNev, termek.foto, termek.leiras, termek.ar, kategoria.kategoriaNev FROM `kategoria`
    INNER JOIN gyarto ON kategoria.kategoriaID = gyarto.kategoriaID
    INNER JOIN termek ON gyarto.gyartoId = termek.markaId ORDER BY termek.id;
 ";
}
$result = mysqli_query($dbconn, $query);
if (mysqli_num_rows($result) > 0) {
    $kimenet = "<table>
    <tr>
        <th>Kép</th>
        <th>Kategória</th>
        <th>Márka</th>
        <th>Modell</th>
        <th>Ár</th>
        <th></th>
    </tr>
 ";
    while ($sor = mysqli_fetch_array($result)) {
        $kimenet .= "<tr>
        <td><img src=\"../img/termekek/{$sor['foto']}\" alt=\"pro\"></td>
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
        <th>Kép</th>
        <th>Kategória</th>
        <th>Márka</th>
        <th>Modell</th>
        <th>Ár</th>
        <th></th>
    </tr>";
    echo $kimenet;
}
