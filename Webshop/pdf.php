<?php
require_once 'vendor/autoload.php';
session_start();
use Dompdf\Dompdf;

$dbconnect = new PDO('mysql:host=localhost;dbname=Webshopv3', 'root', '');

$sql = "SELECT megrendeles.id AS 'megrendeles', gyarto.gyartoNev, termek.termekNev, megrendeles.raktaron, termek.ar, users.name FROM termek
INNER JOIN megrendeles ON termek.id = megrendeles.termekId
INNER JOIN gyartokategoria ON termek.gyartoKategoriaId=gyartokategoria.gyartoKategoriaId
INNER JOIN gyarto ON gyartokategoria.gyartoId=gyarto.gyartoId
INNER JOIN users ON users.id= megrendeles.usersId WHERE users.name = '{$_SESSION['name']}';
";

$stmt = $dbconnect->prepare($sql);
$id = $dbconnect->lastInsertId();
$stmt->execute();
$sorok = $stmt->fetchAll(PDO::FETCH_ASSOC);
$gt = 0;
$i = 1;
$date = date("Y.m.d H:i:s");
$szamla = 0001;
function add_leading_zero($value, $threshold = 2) {
    return sprintf('%0' . $threshold . 's', $value);
}



$bizonylat = 'SZ'. date( add_leading_zero(1, 5) .'/'."Y");


$html = '
<!DOCTYPE html>
<html lang="hun">
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
</style>
</head>

<body>
<h1>Számla bizonylat</h1>

<h2>Bizonylat sorszáma: <span class="right"> '. $bizonylat . '</span></h2>
<hr>
<h3>Kinyomtatás dátuma: '. $date .'</h3>
<table class="headerTable">
    <thead>
        <tr>
            <th class="th">Szállító</th>
            <th class="th">Vásárló</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="szallitoVevo"><b>Seres Kft</b></td>
            <td class="szallitoVevo"><b>'. $id .'</b></td>
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
            <th>Termék azonosító</th>
            <th>Termék</th>
            <th>Darab</th>
            <th>Ár</th>
        </tr>
    </thead>
    <tbody>';

foreach ($sorok as $sor) {
    $html .= '
                <tr>
                    <td>' . $sor['megrendeles'] .'</td>
                    <td>' . $sor['gyartoNev'] . ' ' . $sor['termekNev'] . '</td>
                    <td>' . $sor['raktaron'] . '</td>
                    <td>' . $sor['ar'] * $sor['raktaron'] . '</td>
                </tr>';
    $gt += $sor['ar'] * $sor['raktaron'];
    $i++;
}
$html .= '
        </tbody>
            <tr>
                <th colspan="3" class="vegossz">Végösszeg</th>
                <td>' . $gt . '</td>
            </tr>
        </table>
        </body>
    </html>';

$dompdf = new Dompdf;
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('szamla.pdf');
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
    </style>
</head>

<body>
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