<?php

require("kapcsolat.php");
session_start();

$sql = "SELECT * FROM users WHERE name = '{$_SESSION['name']}'";

$eredmeny = mysqli_query($dbconnect, $sql);
$sor = mysqli_fetch_array($eredmeny);
$usersid = $sor['id'];


$select = "SELECT kedvenctermekek.id, termek.termekNev, termek.ar, termek.foto FROM kedvenctermekek INNER JOIN termek ON kedvenctermekek.termekid=termek.id INNER JOIN users ON kedvenctermekek.usersId= users.id WHERE kedvenctermekek.usersId = {$usersid}";
$eredmeny = mysqli_query($dbconnect, $select);



if (mysqli_num_rows($eredmeny) > 0) {
    $kimenet = "<div class='tableContainer'>
    <table>
    <tr>
        <th>Fotó</th>
        <th>Termék neve</th>
        <th>Termék ára</th>
        <th>Művelet</th>
    </tr>
 ";
    while ($sor = mysqli_fetch_array($eredmeny)) {
        $kimenet .= "<tr>
        <td><img src='img/termekekuj/{$sor['foto']}'></td>
        <td>{$sor['termekNev']}</td>
        <td>{$sor['ar']}</td>
        <td><a href=\"torles.php?id={$sor['id']}\" id=\'torles\'>Törlés</a></td>
        </tr>
  ";
    }
    $kimenet .= "</table>";
    $kimenet .= "</div>";
}else{
    $kimenet = "";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Free Web tutorials"> <!--Keresőmotor optimalizáláshoz kellenek ezen kódsorok-->
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="John Doe">

    <title>Kedvenc termék</title>
    <link rel="stylesheet" href="css/kedvencek.css">
</head>

<body>

<header>
        <nav>
            <ul>
                <li><a href="index.php">Főoldal</a></li>
            </ul>
        </nav> 
        
       
    </header>
<h1>Az Ön által kedvelt termék(ek):</h1>
<?php echo $kimenet?>
</body>

</html>