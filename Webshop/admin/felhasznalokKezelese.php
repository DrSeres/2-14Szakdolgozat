<?php

require("kapcsolat.php");
session_start();

$sql = "SELECT * FROM users WHERE user_type = 'user'";
$eredmeny = mysqli_query($dbconn, $sql);


if (mysqli_num_rows($eredmeny) > 0) {
    $kimenet = "<table>
    <tr>
        
        <th>Felhasználó neve</th>
        <th>Jogosultsági szint</th>
        <th>Művelet</th>
    </tr>
 ";
    while ($sor = mysqli_fetch_array($eredmeny)) {
        $muvelet = ($sor['engedelyezes'] == 1) ? 'Kitiltás' : 'Engedélyezés';
        $szin = ($muvelet == "Kitiltás") ? 'background-color:red' : 'background-color:green';
        $kimenet .= "<tr>
        <td>{$sor['name']}</td>
        <td>{$sor['user_type']}</td>
        <td><button class='felhasznaloKezeles' name='felhasznaloKezeles' value = '{$muvelet}' data-id='{$sor['id']}' style={$szin}>{$muvelet}</button></td>
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
    <link rel="stylesheet" href="../admin/css/felhasznalok.css">
</head>

<body>

<header>
        <nav>
            <ul>
                <li><a href="kategoria.php">Főoldal</a></li>
            </ul>
        </nav> 
        
       
    </header>
<h1>Felhasználók kezelése</h1>
<?php echo $kimenet?>


<script src="../admin/js/felhasznalok.js"></script>
</body>

</html>