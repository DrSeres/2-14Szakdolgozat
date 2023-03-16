<?php

require("kapcsolat.php");
session_start();
$select = "SELECT kedvenctermekek.id, termek.termekNev, termek.ar FROM kedvenctermekek INNER JOIN termek ON kedvenctermekek.termekid=termek.id INNER JOIN users ON kedvenctermekek.usersId= users.id WHERE usersId = users.id";
$eredmeny = mysqli_query($dbconnect, $select);

if (mysqli_num_rows($eredmeny) > 0) {
    $kimenet = "<table>
    <tr>
        <th>Termék neve</th>
        <th>Termék ára</th>
        <th>Művelet</th>
    </tr>
 ";
    while ($sor = mysqli_fetch_array($eredmeny)) {
        $kimenet .= "<tr>
        <td>{$sor['termekNev']}</td>
        <td>{$sor['ar']}</td>
        <td><a href=\"torles.php?id={$sor['id']}\" id=\'torles\'>Törlés</a></td>
        </tr>
  ";
    }
    $kimenet .= "</table>";
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
    <title>Kedvenc termék</title>
    <link rel="stylesheet" href="../css/kedvencek.css">
</head>

<body>

<header>
        <nav>
            <ul>
                <li><a href="index.php">Főoldal</a></li>
            </ul>
        </nav> 
        
       
    </header>
<h1>Az Ön által kedvelt termék:</h1>
<?php echo $kimenet?>
</body>

</html>