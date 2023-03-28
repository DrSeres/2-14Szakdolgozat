<?php

require("kapcsolat.php");
session_start();

$sql = "SELECT * FROM users WHERE name = '{$_SESSION['name']}'";

$eredmeny = mysqli_query($dbconn, $sql);
$sor = mysqli_fetch_array($eredmeny);
$usersid = $sor['id'];


$select = "SELECT * FROM users";
$eredmeny = mysqli_query($dbconn, $select);



if (mysqli_num_rows($eredmeny) > 0) {
    $kimenet = "<table>
    <tr>
        
        <th>Felhasználó neve</th>
        <th>Jogosultsága</th>
        <th>Művelet</th>
    </tr>
 ";
    while ($sor = mysqli_fetch_array($eredmeny)) {
        $kimenet .= "<tr>
        <td>{$sor['name']}</td>
        <td>{$sor['user_type']}</td>
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

    <meta name="description" content="Free Web tutorials"> <!--Keresőmotor optimalizáláshoz kellenek ezen kódsorok-->
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta name="author" content="John Doe">

    <title>Kedvenc termék</title>
    <link rel="stylesheet" href="../admin/css/felhasznalok.css">
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