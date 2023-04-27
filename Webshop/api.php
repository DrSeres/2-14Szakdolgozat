<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'kapcsolat.php';

$message = '';



$content = trim(file_get_contents("php://input"));
$data = json_decode($content, true);

if($data['c'] == 'regisztracioValidalas') {
    $name = mysqli_real_escape_string($dbconnect, $data['formData']['0']);
    $email = mysqli_real_escape_string($dbconnect, $data['formData']['1']);
    $pass = sha1($data['formData']['2']);
    $cpass = sha1($data['formData']['3']);

    $select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($dbconnect, $select);
    if (mysqli_num_rows($result) > 0) {
        $message = 'Létezik már egy olyan felhasználó!';
    } else if(empty($pass)){
        $message = "Nem adott meg jelszót!";
    } else if($pass != $cpass) {
        $message = "Nem egyezik meg a két jelszó!";
    } 
    
    if(empty($name)){
        $message = "Nem adott meg nevet!";
    }else
    if(empty($email)){
        $message = "Nem adott meg email címet!";
    }
    
    $result = array(
        'message' => $message,
    );

    echo json_encode($result);
}


if($data['c'] == 'loginValidalas') {

    //felhasználó adatainak beálltása
    $email = mysqli_real_escape_string($dbconnect, $data['formData'][0]);
    $pass = sha1($data["formData"][1]);
    
    //felhasználó lekérdezése
    $select = "SELECT * FROM users WHERE email = '$email' AND password = '$pass' ";    
    $result = mysqli_query($dbconnect, $select);
    
   
    
    //ha nincs felhaszná, akkor küldjön vissza hibaüzenetet
    if (mysqli_num_rows($result) == 0 ) {
        $message = 'Rossz felhasználói név / jelszó';
    }else{
        if(isset($_POST['elfelejtett-jelszo'])){
           echo $jelszo = "UPDATE `users` SET `jelszoemlekezteto`='1' WHERE jelszoemlekezteto = 0";
           echo $eremeny = mysqli_query($dbconnect, $jelszo);
        }
    }

    //üzenet visszaküldése
    $result = array(
        'message' => $message,
    );

    echo json_encode($result);

    

}
?>