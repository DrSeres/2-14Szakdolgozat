<?php
$q = intval($_GET['q']);

require("kapcsolat.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$sql="SELECT * FROM users INNER JOIN megrendeles ON users.id = megrendeles.usersId INNER JOIN termek ON termek.id = megrendeles.termekId INNER JOIN telepulesek ON telepulesek.id = users.telepules WHERE users.id = '{$q}'";
$result = mysqli_query($dbconnect, $sql);





echo "<div class='tableContainer'>
    <table>
    <tr>
        <th>Sorszám</th>
        
        <th>Termék neve</th>
        <th>Mennyiség</th>
        <th>Statusz</th>
        <th>Címzett</th>
        <th>Összesen</th>
        
        <th>Számlázás</th>
        
    </tr>
 ";
 $i = 0;
while ($sor = mysqli_fetch_array($result)) {
    $i++;
    $status = ($sor['status'] == 1) ? "Kész" : "Nincs kész";
    $torles = ($sor['torles'] == 0) ? "Nincs törölve" : "";
    $szamlazva = ($sor['szamlazva'] == 1) ? "Számlázva" : "";
    $ar = number_format($sor['ar'] * $sor['raktaron'], 0, ",", " ");
    echo "<tr>";
    echo "<td>" . $i . "</td>";
    // echo "<td>" <img src=`../../Webshop/img/termekekuj/{$sor['foto']}`> "</td>";
    echo "<td>" . $sor['termekNev'] . "</td>";
    echo "<td>" . $sor['raktaron'] . " darab </td>";
    echo "<td>" . $status . "</td>";
    echo "<td>" . $sor['irsz'] ." ". $sor['nev'] .' '. $sor['kiszallitasiCim'] . "</td>";
    echo "<td style='font-size:18px'>" .  $ar ." Ft". "</td>";
    
    echo "<td>" . $szamlazva . "</td>";
    
    echo "</tr>";
}


?>