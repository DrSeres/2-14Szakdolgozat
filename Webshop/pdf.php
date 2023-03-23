<?php
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

$dbconnect = new PDO('mysql:host=localhost;dbname=Webshopv3', 'root', '');

$sql = "SELECT * FROM termek INNER JOIN megrendeles ON termek.id = megrendeles.termekId";

$stmt = $dbconnect->prepare($sql);
$stmt->execute();
$sorok = $stmt->fetchAll(PDO::FETCH_ASSOC);
$gt = 0;
$i = 1;

$html = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1 {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            text-align: center;
        }

        table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
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
    </style>
</head>

<body>
    <h1>Számla</h1>
    <table>
        <thead>
            <tr>
                <th>Termék fotója</th>
                <th>Termék</th>
                <th>Darab</th>
                <th>Ár</th>
            </tr>
        </thead>
        <tbody>';

foreach ($sorok as $sor) {
    $html .= '
                <tr>
                    <td class="kep"><img src="../LAZs/Szakdolgozat//img//termekekuj/' . $sor['foto'] . '" alt=""></td>
                    <td>' . $sor['termekNev'] . '</td>
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1 {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            text-align: center;
        }

        table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
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
    </style>
</head>

<body>
    <h1>Számla</h1>
    <table>
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