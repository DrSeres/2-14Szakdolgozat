<?php

include 'kapcsolat.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($connect, $_POST['name']);
   print_r($name);
   $email = mysqli_real_escape_string($connect, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['passwordAgain']);

   $select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' && name = '$name'";

   $eredmeny = mysqli_query($connect, $select);
  
   if(empty($name))
   {
      $hibak[] = 'Nem adott meg nevet!';
   }
   if(empty($email))
   {
      $hibak[] = 'Nem adott meg emailt!';
   }
   if($pass == null || $cpass == null) 
   {
      $hibak[] = "Nem adott meg jelszót";
   }
   
   if($pass != $cpass) 
   {
         $hibak[] = "Nem egyezik meg a két jelszó!";
   }
   if(mysqli_num_rows($eredmeny) > 0){
      $hibak[] = 'Létezik már egy olyan felhasználó!';
   }
   else
   if(!empty($name) && !empty($email) && $pass != null && $cpass != null)
    {
      $insert = "INSERT INTO users(name, email, password) VALUES('$name','$email','$pass')";
      mysqli_query($connect, $insert);
      header('location:login.php');
   }


   


};

?>

<!DOCTYPE html>
<html lang="hu">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">
   <link rel="stylesheet" href="../css/register.css">

</head>
<body>
<div class="login_form">

<form method="post" class="login-form" autocomplete="off">
        <h1>Regisztráció</h1>
        <?php
        if(isset($hibak))
        {
          foreach ($hibak as $hibak) {
            echo '<p class="hibauzenet">'.$hibak.'</p>';
          }
        }
      
      ?>
        <div class="textbox">
            <label for="name">Neved:</label>
            <input type="text" name="name" id="name" placeholder="Írd be a nevet">

        </div>
        <div class="textbox">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" placeholder="Írd be az emailt">
        </div>
        <div class="textbox">
            <label for="password">Jelszó:</label>
            <input type="password" name="password" id="password" placeholder="Írd be a jelszót">
        </div>
        <div class="textbox">
            <label for="passwordAgain">Jelszó mégegyszer:</label>
            <input type="password" name="passwordAgain" id="passwordAgain" placeholder="Írd be a jelszót mégegyszer">
        </div>
        <button type="submit" name="submit" id="submit" class="btn">Regisztráció</button>
        Van fiókja <a href="login.php" style="text-decoration: none; font-size: 1.2rem;"><span style="color: red; padding: 10px;"> Jelentkezzen be!</span></a>
</form>

        

</div>

</body>
</html>