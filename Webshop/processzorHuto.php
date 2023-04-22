<?php
require("kapcsolat.php");
session_start();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("url.php");

$sql = "SELECT * FROM termek INNER JOIN gyartokategoria ON termek.gyartoKategoriaId=gyartokategoria.gyartoKategoriaId INNER JOIN gyarto ON gyartokategoria.gyartoId=gyarto.gyartoId WHERE gyartokategoria.kategoriaID = 5;";
$eredmeny = mysqli_query($dbconnect, $sql);
//szükséges adatok a számításhoz
$mennyit = 8; //ennyi kártyát akarok látni egy oldalon
$osszesen = mysqli_num_rows($eredmeny);
//print_r($osszesen);

$lapok = ceil($osszesen / $mennyit); //kerekítés
//print($lapok);

$aktualis = (isset($_GET['oldal'])) ? (int)$_GET['oldal'] : 1;

/** 
 * 0, 10 - gép számítása 0-tól 1-oltal
 * 10, 10
 * 20, 10 - 3ik oldal
*/

$honnan = ($aktualis -1) * $mennyit >= 1 ? ($aktualis -1) * $mennyit : 0;
//print_r($honnan);


//lapozó felépítése, hivatkozásoknak kell lennie
$lapozo = "<nav data-pagination>";
$lapozo .= "<ul class='pagination'>";
$lapozo .= ($aktualis != 1) ? "<a href=\"?oldal=1\">< Első</a> |" : "< Első |";

$lapozo .= ($aktualis > 1 && $aktualis <= $lapok) ? "<li><a href=\"?oldal=" .($aktualis-1)."\">Előző</a> | " : "Előző |";

//össszes oldalra el kell végezni a vizsgálatot, amin állsz az legyen link

for ($oldal=1; $oldal <= $lapok; $oldal++) { 
    $lapozo .= ($aktualis != $oldal) ? "<li><a href=\"?oldal={$oldal}\">{$oldal}</a> | " : $oldal." |";
}

$lapozo .= ($aktualis > 0 && $aktualis < $lapok) ? "<a href=\"?oldal=".($aktualis + 1)."\">Következő</a> | " : "Következő | ";

$lapozo .= ($aktualis != $lapok) ? "<li><a href=\"?oldal=".($lapok)."\">Utolsó</a> >" : "Utolsó >";

$lapozo .= "</ul>";
$lapozo .= "</nav>";


$sql = "SELECT * FROM termek INNER JOIN gyartokategoria ON termek.gyartoKategoriaId=gyartokategoria.gyartoKategoriaId INNER JOIN gyarto ON gyartokategoria.gyartoId=gyarto.gyartoId WHERE gyartokategoria.kategoriaID = 5 ORDER BY 1 ASC 
LIMIT {$honnan}, {$mennyit}";
$eredmeny = mysqli_query($dbconnect, $sql);



include("phptemplate.php");

?>
<?php include("template.php"); ?>