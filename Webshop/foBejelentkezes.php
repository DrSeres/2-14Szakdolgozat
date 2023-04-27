<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'kapcsolat.php';
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Webshop oldal</title>

    <meta name="description" content="Bejelentkező és regisztrációs oldal"> <!--Keresőmotor optimalizáláshoz kellenek ezen kódsorok -->
    <meta name="keywords" content="PC Webshop, Számítógép Webshop, Számítógépes Webshop, Számítógép szaküzlet">
    <meta name="author" content="Laczka Adrián Zsolt, Seres Szabolcs">

    <link rel="stylesheet" href="css/FoBejelentkezes.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- NAVBAR CREATION -->
    <header class="header">
        <nav class="navbar">
            <a href="index.php">Főoldal</a>
        </nav>
    </header>
    <!-- LOGIN FORM CREATION -->
    <div class="background"></div>
    <div class="container">
        <div class="item">
            <h2 class="logo"><i class='bx bxl-xing'></i>Seres és Társa.Kft</h2>
            <div class="text-item">
                <h2>Üdvözöllek! <br><span>
                        A Webshopon
                    </span></h2>
                <p></p>
                <div class="social-icon">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                    <a href="#"><i class='bx bxl-youtube'></i></a>
                    <a href="#"><i class='bx bxl-instagram'></i></a>
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                </div>
            </div>
        </div>
        <div id='error-message'>&nbsp;</div>
        <div class="login-section">
            <div class="form-box login">
                <form action="login.php" id='login-form' method="post" onsubmit="event.preventDefault();">
                    <input name="action" id="action" type="hidden" value="login" readonly disabled>
                    <h2>Bejelentkezés</h2>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-envelope'></i></span>
                        <input type="email" id="login-email" name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                        <input type="password" id="login-password" name="password" required>
                        <label>Jelszó</label>
                    </div>
                    <div class="remember-password">
                        <label for="elfelejtett-jelszo"><input id="elfelejtett-jelszo" name="elfelejtett-jelszo" type="checkbox">Emlékezz rám</label>
                        <a href="#">Elfelejtett jelszó</a>
                    </div>
                    <button class="btn" id="be" type="submit">Bejelentkezés</button>
                    <div class="create-account">
                        <p>Nincs fiókod? <a href="#" class="register-link">Regisztrálj most</a></p>
                    </div>
                </form>
            </div>
            <div class="form-box register">
                <form action="register.php" id="reg-form" method="post" onsubmit="event.preventDefault();">
                    <input name="action" id="action" type="hidden" value="register" readonly disabled>
                    <h2>Regisztráció</h2>
                    <div class="input-box">

                        <span class="icon"><i class='bx bxs-user'></i></span>
                        <input type="text" id="name" name="name" required>
                        <label>Felhasználónév</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-envelope'></i></span>
                        <input type="email" id="reg-email" name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                        <input type="password" id="reg-password" name="password">
                        <label>Jelszó</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                        <input type="password" id="passwordAgain" name="passwordAgain" >
                        <label>Jelszó megerősítése</label>
                    </div>
                    <div class="remember-password">
                        <!-- <button onclick="myFunction()">Try it</button> -->
                        <label for="egyetertek"><input type="checkbox" id="egyetertek" required>Egyetértek a <span onclick="myFunction()" style="text-decoration:underline; cursor:pointer"> szerződési feltételekkel</span> </label>
                    </div>
                    <button class="btn" id="re" type="submit">Regisztráció</button>
                    <div class="create-account">
                        <p>Már van fiókod? <a href="#" class="login-link">Jelentkezz be</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- SIGN UP FORM CREATION -->
    <script type="text/javascript">
        localStorage.clear();

        function myFunction() {
            var myWindow = window.open("aszf.html", "", "width=600,height=800");
        }
    </script>
    <script src="js/FoBejelentkezes.js"></script>
</body>

</html>