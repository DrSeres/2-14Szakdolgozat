<?php

include 'kapcsolat.php';

session_start(); 

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($connect, $_POST['email']);
    print_r($email);
   $pass = md5($_POST['password']);
    print_r($pass);

   $select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

   $eredmeny = mysqli_query($connect, $select);

    if(mysqli_num_rows($eredmeny) > 0)
    {
        $sor = mysqli_fetch_array($eredmeny);
    
        if($sor['user_type'] == 'admin')
        {
            $_SESSION['admin_name'] = $sor['name'];
            header('location:admin.php');
        } else if($sor['user_type'] == 'user')
        {
            $_SESSION['user_name'] = $sor['user'];
            header('location:user.php');
        }
    } else {
        $hibak[] = "Nem jó felhasználónév vagy jelszó!";
    }

    
    
};


?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
        <form method="post" class="login-form" autocomplete="off">
        <h1>Bejelentkezés</h1>
        <?php
      if(isset($hibak)){
         foreach($hibak as $hibak){
            echo '<span class="hibauzenet">'.$hibak.'</span>';
         };
      };
      ?>
        <div class="textbox">
            <input type="email" name="email" id="email" placeholder="Írd be az E-mail címet">
        </div>
        <div class="textbox">
            
            <input type="password" name="password" id="password" placeholder="Írd be a jelszót">
        </div>
        <button type="submit" name="submit" class="btn">Bejelentkezés</button>
</form>
    
    
</body>
</html>