<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'kapcsolat.php';

$message = '';



$content = trim(file_get_contents("php://input"));
$data = json_decode($content, true);

echo "<pre>";
print_r($data);
echo '</pre>';
/*
if($data['c'] == 'regisztracioValidalas') {
    $name = mysqli_real_escape_string($dbconnect, $data['name']);
    $email = mysqli_real_escape_string($dbconnect, $data['email']);
    $pass = sha1($data['password']);
    $cpass = sha1($data['passwordAgain']);

    $select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

    $eredmeny = mysqli_query($dbconnect, $select);
    if (mysqli_num_rows($eredmeny) > 0) {
        $message = 'Létezik már egy olyan felhasználó!';
    } else {
        if ($pass != $cpass) {
            $message = "Nem egyezik meg a két jelszó!";
        }
    }
    
    $result = array(
        'message' => $message,
    );

    return json_encode($result);
}


if($data['c'] == 'loginValidalas') {

    $email = mysqli_real_escape_string($dbconnect, $data['email']);
    var_dump($email);
    $pass = sha1($data['password']);
    var_dump($pass);
    
    $select = "SELECT * FROM users WHERE email = '$email' AND password = '$pass' ";
    print($select);
    
    $result = mysqli_query($dbconnect, $select);
    $eredmeny = mysqli_fetch_array($result);
    
    
    echo" az eredmény: <pre>";
    print_r(count($eredmeny));
    echo"</pre>";
    
    if (count($eredmeny) == 0) {
        $message = 'Rossz felhasználói név / jelszó';
    } 

    $result = array(
        'message' => $message,
    );

    return json_encode($result);
}*/
?>