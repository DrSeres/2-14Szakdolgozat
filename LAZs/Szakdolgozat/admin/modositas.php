<?php

//Űrlap feldolgozása

require("kapcsolat.php");
$sql = "SELECT * FROM kategoria
        INNER JOIN gyarto ON kategoria.kategoriaID = gyarto.kategoriaID";

$eredmeny = mysqli_query($dbconn, $sql);


$kiir = "";
while($sor = mysqli_fetch_assoc($eredmeny)){
    $kiir.= "
    <option value=\"{$sor['gyartoId']}\">{$sor['gyartoNev']} ({$sor['kategoriaNev']})</option>";
}



if (isset($_POST['rendben'])) {
    $markaId = $_POST['markaId'];
    $termekNev = strip_tags(trim($_POST['termekNev']));
    $leiras = $_POST['leiras'];
    $ar = $_POST['ar'];
    $darab = $_POST['darab'];

    //változók visszaadása

    $mine = array("image/jpeg", "image/gif", "image/png");
    if (empty($termekNev)) {
        $hibak[] = "Nem adott meg modelt!";
    }
    if (empty($leiras)) {
        $hibak[] = "Nem adott meg leírást!";
    }
    if (empty($ar)) {
        $hibak[] = "Nem adott meg árat!";
    }


    if ($_FILES['foto']['error'] == 0 && $_FILES['foto']['size'] > 2000000) {
        $hibak[] = "A kép mérete nagyobb mint 2 MB!";
    }
    if ($_FILES['foto']['error'] == 0 && !in_array($_FILES['foto']['type'], $mine)) {
        $hibak[] = "A kép formátuma nem megfelelő!";
    }

    //Új fájlnév elkészítése
    switch ($_FILES['foto']['type']) {
        case "image/png":
            $kit = ".png";
            break;
        case "image/gif":
            $kit = ".gif";
            break;
        default:
            $kit = ".jpg";
    }

    $sql = "SELECT kategoria.kategoriaID FROM kategoria
        INNER JOIN gyarto ON kategoria.kategoriaID = gyarto.kategoriaID
        INNER JOIN termek ON gyarto.gyartoId = termek.markaId
        WHERE termek.markaId = {$markaId}";

    $eredmeny = mysqli_query($dbconn, $sql);

    $sor = mysqli_fetch_array($eredmeny);
    $kategoriaID = $sor['kategoriaID'];


    $foto = $kategoriaID . "_" . $termekNev . "_" . date('U') . $kit;
    //Hibaüzenet összeállítása
    if (isset($hibak)) {
        $kimenet = "<ul>\n";
        foreach ($hibak as $hiba) {
            $kimenet .= "<li>{$hiba}</li>";
        }
        $kimenet .= "</ul>\n";
    } else {
        //felvitel az adatbázisba
        $id = (int)$_GET['id'];
        
        $sql = "UPDATE termek
                SET markaId = '{$markaId}', termekNev = '{$termekNev}', foto = '{$foto}', leiras = '{$leiras}', darab = '{$darab}', ar = '{$ar}'
                WHERE id = {$id}";
        mysqli_query($dbconn, $sql);



        //kép mozgatása a végleges helyére
        move_uploaded_file($_FILES['foto']['tmp_name'], "../img/termekek/{$foto}");
        header("location: kategoria.php");
    }
}
else{
    $id = (int)$_GET['id'];
    $sql = "SELECT *
            FROM termek INNER JOIN gyarto ON gyarto.gyartoId = termek.markaId
            WHERE id = {$id}";
    $eredmeny = mysqli_query($dbconn, $sql);
    $sor = mysqli_fetch_assoc($eredmeny);

    $gyartoNev = $sor['gyartoNev'];
    $gyartoId = $sor['gyartoId'];
    $termekNev = $sor['termekNev'];
    $leiras = $sor['leiras'];
    $ar = $sor['ar'];
    $darab = $sor['darab'];
    $foto = ($sor['foto']) != "nincskep.png" ? $sor['foto'] : "nincskep.png";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/felv_mod.css">
    <title><?php print $gyartoNev . " " .$termekNev?></title>
</head>

<body>
    <div class="container">
        <h1> <?php print $gyartoNev . " " . $termekNev?> módosítása</h1>
        <form method="post" enctype="multipart/form-data">

            <?php if (isset($kimenet)) print $kimenet; ?>

            <p><label for="markaId">Kategória kiválasztása*: </label>
                <select id="markaId" name="markaId">
                    <option value="<?php print $gyartoId;?>"><?php print $gyartoId;?></option>
                    <?php print_r($kiir);?>
                </select>
            </p>

            <p><label for="termekNev">Modell*: </label>
                <input type="text" name="termekNev" id="termekNev" value="<?php print $termekNev;?>">
            </p>

            <p><label for="leiras">Leírás*: </label>
                <textarea name="leiras" id="leiras" cols="50" rows="15"><?php print $leiras;?></textarea>
            </p>

            <p><label for="ar">Ára (Ft)*: </label>
                <input type="number" name="ar" id="ar" value="<?php print $ar;?>">
            </p>
            
            <p><label for="darab">Darab*: </label>
                <input type="number" name="darab" id="darab" value="<?php print $darab;?>">
            </p>




            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
            <img src="../img/termekek/<?php print $foto;?>" id="termekFoto">
            <p><label for="foto">Fotó feltöltése</label>
                <input type="file" name="foto" id="foto">
            </p>




            <p>A*-gal jelölt mezők kitöltése kötelező.</p>

            <!--Elküldés és reset-->
            <input type="submit" value="Rendben" id="rendben" name="rendben">
            <p><a href="kategoria.php">Vissza az oldalra</a></p>
        </form>
    </div>

</body>

</html>