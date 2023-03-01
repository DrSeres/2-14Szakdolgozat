<?php

//Űrlap feldolgozása
if (isset($_POST['rendben'])) {
    $kategoriaID = $_POST['kategoriaID'];
    $gyartoNev = strip_tags(trim($_POST['gyartoNev']));
    $termekNev = strip_tags(trim($_POST['termekNev']));
    $leiras = $_POST['leiras'];
    $ar = $_POST['ar'];
    $darab = $_POST['darab'];

    //változók visszaadása

    $mine = array("image/jpeg", "image/gif", "image/png");
    if (empty($gyartoNev)) {
        $hibak[] = "Nem adott meg márkát!";
    }
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

    $foto = date('U') . $kit;
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
                ('{$kategoriaID}', '{$gyartoNev}')";
        
        $sql .= "INSERT INTO `termek`(`termekNev`, `foto`, `leiras`, `darab`, `ar`)
                VALUES ('{$termekNev}','{$foto}','{$leiras}','{$darab}','{$ar}')";
        mysqli_query($dbconn, $sql);

        //kép mozgatása a végleges helyére
        move_uploaded_file($_FILES['foto']['tmp_name'], "../../img/{$foto}");
        header("location: processzor.php");
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
    <title>Új adat hozzáadása</title>
</head>

<body>
    <div class="container">
        <h1>Új adaz hozzáadása</h1>
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

            <p><label for="termekNev">Modell*: </label>
                <input type="text" name="termekNev" id="termekNev" value="">
            </p>

            <p><label for="leiras">Leírás*: </label>
                <textarea name="leiras" id="leiras" cols="50" rows="15"></textarea>
            </p>

            <p><label for="ar">Ára (Ft)*: </label>
                <input type="number" name="ar" id="ar" value="">
            </p>
            
            <p><label for="darab">Darab*: </label>
                <input type="number" name="darab" id="darab" value="">
            </p>




            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
            <p><label for="foto">Fotó feltöltése</label>
                <input type="file" name="foto" id="foto">
            </p>




            <p>A*-gal jelölt mezők kitöltése kötelező.</p>

            <!--Elküldés és reset-->
            <input type="submit" value="Rendben" id="rendben" name="rendben">
            <p><a href="processzor.php">Vissza az oldalra</a></p>
        </form>
    </div>

</body>

</html>