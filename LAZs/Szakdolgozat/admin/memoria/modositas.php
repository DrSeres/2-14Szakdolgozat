<?php

//Űrlap feldolgozása

require("../kapcsolat.php");

if (isset($_POST['rendben'])) {
    $marka = strip_tags(trim($_POST['marka']));
    $tipus = strip_tags(trim($_POST['tipus']));
    $kapacitas = $_POST['kapacitas'];
    $kiszereles = $_POST['kiszereles'];
    $memoria_tipus = $_POST['memoria_tipus'];
    $leiras = $_POST['leiras'];
    $ar = $_POST['ar'];

    //változók visszaadása

    $mine = array("image/jpeg", "image/gif", "image/png");
    if (empty($marka)) {
        $hibak[] = "Nem adott meg márkát!";
    }
    if (empty($tipus)) {
        $hibak[] = "Nem adott meg modelt!";
    }
    if (empty($kapacitas)) {
        $hibak[] = "Nem adott meg kapacitást!";
    }
    if (empty($kiszereles)) {
        $hibak[] = "Nem adott meg kiszerelést!";
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

    $foto = date('U') . $kit;
    //Hibaüzenet összeállítása
    if (isset($hibak)) {
        $kimenet = "<ul>\n";
        foreach ($hibak as $hiba) {
            $kimenet .= "<li>{$hiba}</li>";
        }
        $kimenet .= "</ul>\n";
    } else {
        $id = (int)$_GET['id'];
        $sql = "UPDATE ram
                SET marka = '{$marka}', tipus = '{$tipus}', kapacitas = '{$kapacitas}', kiszereles = '{$kiszereles}', memoria_tipus = '{$memoria_tipus}', leiras = '{$leiras}', ar = '{$ar}', foto = '{$foto}'
                WHERE id = {$id}";
        mysqli_query($dbconn, $sql);

        //kép mozgatása a végleges helyére
        move_uploaded_file($_FILES['foto']['tmp_name'], "../../img/memoria/{$foto}");
        header("location: tapegyseg.php");
    }
}
else {
    $id = (int)$_GET['id'];
    $sql = "SELECT*
            FROM ram
            WHERE id = {$id}";
    $eredmeny = mysqli_query($dbconn, $sql);
    $sor = mysqli_fetch_assoc($eredmeny);

    $marka = $sor['marka'];
    $tipus = $sor['tipus'];
    $kapacitas = $sor['kapacitas'];
    $kiszereles = $sor['kiszereles'];
    $memoria_tipus = $sor['memoria_tipus'];
    $leiras = $sor['leiras'];
    $ar = $sor['ar'];
    $foto = ($sor['foto']) != "nincskep.png" ? $sor['foto'] : "nincskep.png";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/felv_mod.css">
    <title><?php print $marka;?> <?php print $modell;?> módosítása</title>
</head>

<body>
    <div class="container">
        <h1><?php print $marka;?> <?php print $modell;?> módosítása</h1>
        <form method="post" enctype="multipart/form-data">

            <?php if (isset($kimenet)) print $kimenet; ?>

            <p><label for="marka">Márka*: </label>
                <input type="text" name="marka" id="marka" value="<?php print $marka;?>">
            </p>
            
            <p><label for="tipus">Modell*: </label>
                <input type="text" name="tipus" id="tipus" value="<?php print $tipus;?>">
            </p>

            <p><label for="kapacitas">Kapacitás*: </label>
                <input type="number" name="kapacitas" id="kapacitas" value="<?php print $kapacitas;?>">
            </p>

            <p><label for="kiszereles">Kiszerelés*: </label>
                <input type="text" name="kiszereles" id="kiszereles" value="<?php print $marka;?>">
            </p>
            
            <p><label for="memoria_tipus">Memória Típusa*: </label>
                <select id="memoria_tipus" name="memoria_tipus">
                    <option value="<?php print $marka;?>">Marad: <?php print $marka;?></option>
                    <option value="DDR">DDR</option>
                    <option value="DDR2">DDR2</option>
                    <option value="DDR3">DDR3</option>
                    <option value="DDR4">DDR4</option>
                    <option value="DDR5">DDR5</option>
                    <option value="SDRAM">SDRAM</option>
                </select>
            </p>

            <p><label for="leiras">Leírás*: </label>
                <input type="text" name="leiras" id="leiras" value="<?php print $leiras;?>">
            </p>

            <p><label for="ar">Ára (Ft)*: </label>
                <input type="number" name="ar" id="ar" value="<?php print $ar;?>">
            </p>




            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
            <img src="../../img/tapegyseg/<?php print $foto;?>">
            <p><label for="foto">Fotó feltöltése</label>
                <input type="file" name="foto" id="foto">
            </p>




            <p>A*-gal jelölt mezők kitöltése kötelező.</p>

            <!--Elküldés és reset-->
            <input type="submit" value="Módosítás" id="rendben" name="rendben">
            <p><a href="tapegyseg.php">Vissza az oldalra</a></p>
        </form>
    </div>

</body>

</html>