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
        $muvelet = ($sor['engedelyezes'] == 1) ? 'Kitiltás' : 'Engedélyezés';
        $kimenet .= "<tr>
        <td>{$sor['name']}</td>
        <td>{$sor['user_type']}</td>
        <td><button class='felhasznaloKezeles' name='felhasznaloKezeles' value = '{$muvelet}' data-id='{$sor['id']}'>{$muvelet}</button></td>
        </tr>
  ";
    }
    $kimenet .= "</table>";
}else{
    $kimenet = "";
}


// $btn = document.querySelectorAll(".felhasznaloKezeles");
// console.log(btn);
// let i = 0;
// btn.forEach((elem) => {
//     elem.addEventListener(('click'), () => {
//             if (elem.value == "Kitiltás") {
//             elem.value = "Engedélyezés";
//             elem.innerHTML = "Engedélyezés";
//         }
//         else {
//             elem.value = "Kitiltás";
//             elem.innerHTML = "Kitiltás";
//         }
//     })
// });







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
<h1>Felhasználók kezelése</h1>
<?php echo $kimenet?>


<script src="../admin/js/felhasznalok.js"></script>
</body>

</html>