<?php

session_start();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elfejettett jelszó</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="login_form">
        <h3 class="be">Jelszó megváltoztatása</h3>
        <form method="post">
        <?php
      if(isset($hibak)){
         foreach($hibak as $hibak){
            echo '<span class="hibauzenet">'.$hibak.'</span>';
         };
      };
      ?>
            <input type="email" name="email" id="email" placeholder="Írja be E-mail címét">
            <div class="left-button">
            <button type="submit" name="submit" id="bejelentkezes">Elküld</button><br>
        </div>
        </form>
       
    </div>
</body>
</html>