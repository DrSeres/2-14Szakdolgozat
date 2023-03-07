<?php

require("kapcsolat.php");

$sql = "SELECT kategoria.kategoriaNev, gyarto.gyartoNev FROM `kategoria`
INNER JOIN gyarto ON kategoria.kategoriaID = gyarto.kategoriaID;";

$eredmeny = mysqli_query($dbconn, $sql);



$sorok = "<table>
<tr>
    <th>Gyártó</th>
    <th>Kategória</th>
</tr>";
while($sor = mysqli_fetch_assoc($eredmeny)) {
    $sorok.= "<tr>
    <td>{$sor['gyartoNev']}</td>
    <td>{$sor['kategoriaNev']}</td>";
}
$sorok.="</table>";










//Űrlap feldolgozása
if (isset($_POST['rendben'])) {
    $kategoriaID = $_POST['kategoriaID'];
    $gyartoNev = strip_tags(trim($_POST['gyartoNev']));

    //változók visszaadása

    $mine = array("image/jpeg", "image/gif", "image/png");
    if (empty($gyartoNev)) {
        $hibak[] = "Nem adott meg márkát!";
    }

    //Hibaüzenet összeállítása
    if (isset($hibak)) {
        $kimenet = "<ul>\n";
        foreach ($hibak as $hiba) {
            $kimenet .= "<li>{$hiba}</li>";
        }
        $kimenet .= "</ul>\n";
    } else {
        //felvitel az adatbázisba
        require("kapcsolat.php");
        $sql = "INSERT INTO gyarto
                (kategoriaID, gyartoNev)
                VALUES
                ('{$kategoriaID}', '{$gyartoNev}');";
        mysqli_query($dbconn, $sql);

        
        header("location: kategoria.php");
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/felv_mod.css">
    <title>Új gyártó hozzáadása</title>
</head>

<body>
    <div class="container">
        <h1>Új gyártó hozzáadása</h1>
        <form method="post" enctype="multipart/form-data">

            <?php if (isset($kimenet)) print $kimenet; ?>

            <p><label for="kategoriaID">Kategória kiválasztása*: </label>
                <select id="kategoriaID" name="kategoriaID">
                    <option value="2">Alaplap</option>
                    <option value="3">Gépház</option>
                    <option value="6">Memória (RAM)</option>
                    <option value="1">Processzor</option>
                    <option value="5">Processzor hűtő</option>
                    <option value="9">Rendszerhűtó</option>
                    <option value="7">SSD</option>
                    <option value="8">Tápegység</option>
                    <option value="4">Videókártya</option>
                </select>
            </p>

            <p><label for="gyartoNev">Márka / Gyártó*: </label>
                <input type="text" name="gyartoNev" id="gyartoNev" value="">
            </p>
            <p>A*-gal jelölt mezők kitöltése kötelező.</p>

            <!--Elküldés és reset-->
            <input type="submit" value="Rendben" id="rendben" name="rendben">
            <p><a href="kategoria.html">Vissza az oldalra</a></p>
            <?php if (isset($sorok)) print $sorok; ?>
        </form>
    </div>

</body>

</html>