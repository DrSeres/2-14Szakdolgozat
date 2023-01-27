<?php

session_start();

if(!isset($_SESSION['admin_name']))
{
    header('location:../admin/login.php');
};
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER page</title>
</head>
<body>
    <?php

    echo $_SESSION['user_name'];

    ?>

    <h1>szia</h1>

    <a href="../admin/logout.php">Kilepés</a>
</body>
</html>