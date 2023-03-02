<?php 

$Data = "<script>document.write(localStorage.getItem('ans'));</script>";

require("../kapcsolat.php");
echo `<pre>`;
print_r($Data);
echo `</pre>`;



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<script>
let order= JSON.parse(localStorage.getItem('ans'));
console.log("küldés utáni állapot stragebe érkezett");
console.log(order);
 <?php   $sql = "INSERT INTO megrendeles (nev) VALUES('2', '{order}')" ?>
</script>
</body>
</html>
