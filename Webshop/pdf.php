<?php
require_once 'vendor/autoload.php';
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("kapcsolat.php");

// $szamlaSorszamaSql = "SELECT COUNT(id) AS 'Sorszam' FROM megrendeles";
// $szamlaSorszamQuery = mysqli_query($dbconnect, $szamlaSorszamaSql);
// $beolvasas = mysqli_fetch_assoc($szamlaSorszamQuery);
// $sorszam = $beolvasas['Sorszam'];
$szamlaSorszamaSql = "SELECT sorszam FROM megrendeles ORDER BY sorszam DESC LIMIT 1";
$szamlaSorszamQuery = mysqli_query($dbconnect, $szamlaSorszamaSql);
$beolvasas = mysqli_fetch_assoc($szamlaSorszamQuery);
$sorszam = $beolvasas['sorszam'];


switch(strlen((string)$sorszam)) {
    case 1:
      $szamHossz =  "0000";
      break;
    case 2:
        $szamHossz = "000";
        break;
    case 3:
     $szamHossz = "00";
      break;
    case 4:
       $szamHossz = "0";
        break;
    
    default:
       $szamHossz = "";
  }




require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

$dbconnect = new PDO('mysql:host=mysql.omega;dbname=webshopv3', 'webshopv3', 'Szuperbat01');
$felhasznalo = $_SESSION['name'];




//A megrendelő adatainak kikeresése
$sqlSQL = "SELECT megrendeles.id AS 'megrendeles', gyarto.gyartoNev, termek.termekNev, megrendeles.raktaron, termek.id AS 'termekid', termek.ar, users.name, users.vezetekNev, users.keresztNev, users.kartyaszam, megrendeles.utcaNev, megrendeles.hazszam, users.email, telepulesek.irsz, telepulesek.nev, megrendeles.telepules, megrendeles.telepules FROM termek
INNER JOIN megrendeles ON termek.id = megrendeles.termekId
INNER JOIN gyartokategoria ON termek.gyartoKategoriaId=gyartokategoria.gyartoKategoriaId
INNER JOIN gyarto ON gyartokategoria.gyartoId=gyarto.gyartoId
INNER JOIN users ON users.id= megrendeles.usersId 
INNER JOIN telepulesek ON megrendeles.telepules = telepulesek.id
WHERE users.name = '{$felhasznalo}' AND megrendeles.szamlazva = 0;
";



$email = "";
$veznev = "";
$kernev = "";
$kartyaszam = "";
$utcaNev = "";
$hazszam = "";
$telepulesIranyitoszam = "";
$telepules = "";


$stmt = $dbconnect->prepare($sqlSQL);
$id = $dbconnect->lastInsertId();
$stmt->execute();
$sor = $stmt->fetch(PDO::FETCH_ASSOC);
$email = $sor["email"];
$veznev = $sor["vezetekNev"];
$kernev = $sor["keresztNev"];
$kartyaszam = $sor["kartyaszam"];
$utcaNev = $sor['utcaNev'];
$hazszam = $sor['hazszam'];
$telepulesIranyitoszam = $sor['irsz'];
$telepules = $sor['nev'];






//az adatok fetchAll-al kiíratása

$sql = "SELECT megrendeles.id AS 'megrendeles', gyarto.gyartoNev, termek.termekNev, megrendeles.raktaron, termek.id AS 'termekid', termek.ar, users.name, users.vezetekNev, megrendeles.utcaNev, megrendeles.hazszam, megrendeles.telepules, telepulesek.id FROM termek
INNER JOIN megrendeles ON termek.id = megrendeles.termekId
INNER JOIN gyartokategoria ON termek.gyartoKategoriaId=gyartokategoria.gyartoKategoriaId
INNER JOIN gyarto ON gyartokategoria.gyartoId=gyarto.gyartoId
INNER JOIN telepulesek ON megrendeles.telepules = telepulesek.id
INNER JOIN users ON users.id= megrendeles.usersId WHERE users.name = '{$felhasznalo}' AND megrendeles.szamlazva = 0 AND megrendeles.telepules = telepulesek.id;
";

$stmt = $dbconnect->prepare($sql);
$id = $dbconnect->lastInsertId();
$stmt->execute();
$sorok = $stmt->fetchAll(PDO::FETCH_ASSOC);


$gt = 0;
$i = 1;
$date = date("Y.m.d H:i:s");




$bizonylat = 'SZ'. $szamHossz. $sorszam . "/" . date("Y");


$html = '
<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Számla</title>
<style>
    h1 {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        text-align: center;
    }
    * {
        font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
    }
    .bodyTable {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-top: 60px;

    }

    .bodyTable td,
    th {
        border: 1px solid #444;
        padding: 13px;
        font-size: 1.2rem;
        text-align:center;
    }
    .bodyTable th{
        background: #4682B4;
        color: white;
        text-align:center;
    }

    .vegossz {
        text-align: right;
    }

    img {
        max-width: 150px;
    }

    .kep {
        text-align: center;
    }
    .headerTable{
        margin-bottom: 30px;
        text-align: left;
        width: 100%;
    }
    .headerTable th, td{
        border: 0;
        font-size: 1.1rem;
        text-align:left;
    }
    hr{
        width: 70%;
    }
    h2{
        background: #4682B2;
        padding: 10px;
        border-radius: 10px;
        border: 2px solid black;
    }
    .right{
        float: right;
    }
    .headerTable .th {
        font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
        font-size: 1.3rem;
    }
    .szallitoVevo {
        font-size: 2.3rem;
    }
    h3{
        text-align:center;
    }
    .ar{
        width:100px;
    }
    .kapcsolat{
        text-align: right;
        display: flex;
        flex-direction: column;
    }
    .kapcsolat p{
        font-size: 1.1rem;
    }
    .kapcsolatHr{
        width: 100%;
    }
</style>
</head>

<body>
<div class="kapcsolat">
        <p>Kapcsolat: +36 20 527 7829 <br>
        onlinePcWebshop2023@gmail.com</p>
    </div>
    <hr class="kapcsolatHr">
<h1>Számla bizonylat</h1>

<h2>Bizonylat sorszáma: <span class="right"> '. $bizonylat . '</span></h2>
<hr>
<h3>Kinyomtatás dátuma: '. $date .'</h3>
<table class="headerTable">
    <thead>
        <tr>
            <th class="th">Cég</th>
            <th class="th">Vásárló</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="szallitoVevo"><b>Seres és Társa KFT</b></td>
            <td class="szallitoVevo"><b>'. $veznev .' '. $kernev .'</b></td>
        </tr>
        <tr>
            <td>Bankszámlaszám: 123456789-123456789-123456789</td>
            <td>Bankszámlaszám: '. $kartyaszam .'</td>
        </tr>
        <tr>
            <td>Helyszín: 1022, Budapest I.kerület Domb utca 11.</td>
            <td>Helyszín:  '. $telepulesIranyitoszam .', '. $telepules . ', '. $utcaNev . ' utca ' . $hazszam .'</td>
        </tr>
        <tr>
            <td>E-mail cím: onlinePcWebshop2023@gmail.com</td>
            <td>E-mail cím: '. $email .'</td>
        </tr>
    </tbody>
   
</table>
<hr>
<table class="bodyTable">
    <thead>
        <tr>
            <th>Termék cikkszáma</th>
            <th style="width:100px">Termék neve</th>
            <th>Darab</th>
            <th>Eredeti Ár</th>
            <th>Akciós Ár</th>
            <th>Akció</th>
        </tr>
    </thead>
    <tbody>';

foreach ($sorok as $sor) {
    /*
    Ha a termék id-ja = a $_SESSION[deal] -ben szereplő id-val, akkor szorozza fel 0.*-al az árat.
    if(in_array($sor["id"],$_SESSION["deal"]));
    */
    $akcio = number_format($sor['ar'] * 0.8, '0', '.', '');
    $ArFormazas = intval($sor['ar']);
        $akciosAr = (in_array($sor['termekid'], $_SESSION['deal'])) ? " {$akcio} " :  "$ArFormazas";
        $termekAkcio = (in_array($sor['termekid'], $_SESSION['deal'])) ? " 20 % " :  "0 %";
   $html .= '
                <tr>
                    <td class="rendelesId">' . $sor['megrendeles'] .'</td>
                    <td style="font-size:15px">' . $sor['gyartoNev'] . ' ' . $sor['termekNev'] . '</td>
                    <td>' . $sor['raktaron'] . '</td>
                    <td class="ar">' .number_format($sor['ar'], 0, ',', ' ') . ' Ft</td>
                    <td class="ar">' . number_format($akciosAr * $sor['raktaron'], 0, ',', ' ') . ' Ft</td>
                    
                    <td class="ar">' . $termekAkcio . '</td>
                </tr>';
    $gt += number_format($akciosAr * $sor['raktaron'], 0, '.', '');
    $i++;
}
$html .= '
        </tbody>
            <tr>
                <th colspan="5" class="vegossz">Végösszeg</th>
                <td>' . number_format($gt, 0, ',', ' ') . ' Ft</td>
            </tr>
        </table>
        </body>
    </html>';



    $dompdf = new Dompdf;
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('PCszamla.pdf');




echo $update = "UPDATE megrendeles INNER JOIN users ON megrendeles.usersId = users.id SET megrendeles.szamlazva ='1' WHERE megrendeles.szamlazva = 0 AND users.name = '{$felhasznalo}' AND megrendeles.status = 1";
$stmt = $dbconnect->prepare($update);
$stmt->execute();

echo "<script>localStorage.removeItem('termekek')</script>";

?>



<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Számla</title>
    <style>
        h1 {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            text-align: center;
        }
        * {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        .bodyTable {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            margin-top: 60px;

        }

        .bodyTable td,
        th {
            border: 1px solid #444;
            padding: 13px;
            font-size: 1.2rem;

        }
        .bodyTable th{
            background: #4682B4;
            color: white;
            
        }

        .vegossz {
            text-align: right;
        }

        img {
            max-width: 150px;
        }

        .kep {
            text-align: center;
        }
        .headerTable{
            margin-bottom: 30px;
            text-align: center;
            width: 100%;
        }
        .headerTable th, td{
            border: 0;
            font-size: 1.4rem;
        }
        hr{
            width: 70%;
        }
        h2{
            background: #4682B2;
            padding: 10px;
            border-radius: 10px;
            border: 2px solid black;
        }
        .right{
            float: right;
        }
        .headerTable .th {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 1.3rem;
        }
        .szallitoVevo {
            font-size: 2.3rem;
        }
        .kapcsolat{
            text-align: right;
            display: flex;
            flex-direction: column;
        }
        .kapcsolat p{
            font-size: 1.1rem;
        }
        .kapcsolatHr{
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="kapcsolat">
        <p>Kapcsolat: +36 20 527 7829 <br>
        onlinePcWebshop2023@gmail.com</p>
    </div>
    <hr class="kapcsolatHr">
    <h1>Számla bizonylat</h1>
    
    <h2>Bizonylat sorszáma: <span class="right"></span></h2>
    <hr>
    <table class="headerTable">
        <thead>
            <tr>
                <th class="th">Szállító</th>
                <th class="th">Vevő</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="szallitoVevo"><b>Seres Kft</b></td>
                <td class="szallitoVevo"><b></b></td>
            </tr>
            <tr>
                <td>Bankszámlaszám: 888888-8888-8888-8888</td>
                <td>Bankszámlaszám: 88888-88888-8888-8888</td>
            </tr>
            <tr>
                <td>Adószám: 12345678-2-41</td>
                <td>Adószám: </td>
            </tr>
        </tbody>
       
    </table>
    <hr>
    <table class="bodyTable">
        <thead>
            <tr>
                <th>Termék fotója</th>
                <th>Termék</th>
                <th>Darab</th>
                <th>Ár</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
        <tr>
            <th colspan="3" class="vegossz">Végösszeg</th>
            <td></td>
        </tr>
    </table>
</body>

</html>