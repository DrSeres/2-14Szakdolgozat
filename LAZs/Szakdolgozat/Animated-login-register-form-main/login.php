<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'kapcsolat.php';

$email = mysqli_real_escape_string($dbconnect, $_POST['email']);
var_dump($email);
$pass = md5($_POST['password']);
var_dump($pass);

$select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

$eredmeny = mysqli_query($dbconnect, $select);

if (mysqli_num_rows($eredmeny) > 0) {
    $sor = mysqli_fetch_array($eredmeny);
    
    if ($sor['user_type'] == 'admin') {
        $_SESSION['admin_name'] = $sor['name'];
        header('location:admin.php');
    } else if ($sor['user_type'] == 'user') {
        $_SESSION['user_name'] = $sor['user'];
        header('location:user.php');
    }
} else {
    $hibak[] = "Nem jó felhasználónév vagy jelszó!";
}
?>