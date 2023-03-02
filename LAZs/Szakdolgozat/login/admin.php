<?php

session_start();

if(!isset($_SESSION['admin_name'] ) || !isset($SESSION['user_name']))
{
    header('location:login.php');
};
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
</head>
<body>
    <?php

    echo $_SESSION['admin_name'];

    ?>

    <h1>szia</h1>

    <a href="logout.php">Kilepés</a>
</body>
</html>