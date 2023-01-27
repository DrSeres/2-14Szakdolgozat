<?php

include 'kapcsolat.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($connect, $_POST['name']);
   $email = mysqli_real_escape_string($connect, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['passwordAgain']);

   $select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

   $eredmeny = mysqli_query($connect, $select);
   if(mysqli_num_rows($eredmeny) > 0){
      $hibak[] = 'Létezik már egy olyan felhasználó!';
   }else{
      if($pass != $cpass) {
         $hibak[] = "Nem egyezik meg a két jelszó!";
      }
      else {
         $insert = "INSERT INTO users(name, email, password) VALUES('$name','$email','$pass')";
         mysqli_query($connect, $insert);
         header('location:login.php');
      }
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
   <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="register.css">

</head>
<body>
<div class="login_form">

   <form action="" method="post">
      <h3>Regisztráció</h3>
      <?php
      if(isset($hibak)){
         foreach($hibak as $hibak){
            echo '<span class="hibauzenet">'.$hibak.'</span>';
         };
      };
      ?>
      <div class="textbox">

      
            <label for="name" style="color: white;">Név: </label>
            <input type="text" name="name" id="name" placeholder="Írja be a nevét">
            </div>
            <div class="textbox">

            
            <label for="email" style="color: white;">E-mail cím:</label>
            <input type="email" name="email" id="email" placeholder="Írja be az Email címét">
            </div>
            <div class="textbox">

            
            <label for="password" style="color: white;">Jelszó:</label>
            <input type="password" name="password" id="password" placeholder="Írja be a jelszavát">
            </div>
            <div class="textbox">

            
            <label for="passwordAgain" style="color: white;">Jelszó ismét:</label>
            <input type="password" name="passwordAgain" id="passwordAgain" placeholder="Írja be a jelszavát mégegyszer">
            </div>
            
            <button type="submit" name="submit" class="btn">Regisztráció</button><br>
   </form>

</div>

</body>
</html>