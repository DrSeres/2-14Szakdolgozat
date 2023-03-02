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
    <link rel="stylesheet" href="../css/FoBejelentkezes.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- NAVBAR CREATION -->
    <header class="header">
        <nav class="navbar">
            <a href="#">Főoldal</a>
        </nav>
        <form action="" class="search-bar">
            <input type="text" placeholder="Search...">
            <button><i class='bx bx-search'></i></button>
        </form>
    </header>
    <!-- LOGIN FORM CREATION -->
    <div class="background"></div>
    <div class="container">
        <div class="item">
            <h2 class="logo"><i class='bx bxl-xing'></i>SzA.Kft</h2>
            <div class="text-item">
                <h2>Üdvözöllek! <br><span>
                        A Webshopon
                    </span></h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit, repellendus?</p>
                <div class="social-icon">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                    <a href="#"><i class='bx bxl-youtube'></i></a>
                    <a href="#"><i class='bx bxl-instagram'></i></a>
                    <a href="#"><i class='bx bxl-linkedin'></i></a>
                </div>
            </div>
        </div>
        <div class="login-section">
            <div class="form-box login">
                <form action="login.php" method="post">
                    <input name="action" id="action" type="hidden" value="login" readonly disabled>
                    <h2>Bejelentkezés</h2>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-envelope'></i></span>
                        <input type="email" name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                        <input type="password" name="password" required>
                        <label>Jelszó</label>
                    </div>
                    <div class="remember-password">
                        <label for=""><input type="checkbox">Emlékezz rám</label>
                        <a href="#">Elfelejtett jelszó</a>
                    </div>
                    <button class="btn" id="be" type="submit">Bejelentkezés</button>
                    <div class="create-account">
                        <p>Nincs fiókod? <a href="#" class="register-link">Regisztrálj most</a></p>
                    </div>
                </form>
            </div>
            <div class="form-box register">
                <form action="register.php" method="post">
                    <input name="action" id="action" type="hidden" value="register" readonly disabled>
                    <h2>Regisztráció</h2>

                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-user'></i></span>
                        <input type="text" name="name" required>
                        <label>Felhasználónév</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-envelope'></i></span>
                        <input type="email" name="email" required>
                        <label>Email</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                        <input type="password" name="password" required>
                        <label>Jelszó</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><i class='bx bxs-lock-alt'></i></span>
                        <input type="password" name="passwordAgain" required>
                        <label>Jelszó megerősítése</label>
                    </div>
                    <div class="remember-password">
                        <label for=""><input type="checkbox">Egyetértek a szerződési feltételekkel</label>
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

    <script src="../js/FoBejelentkezes.js"></script>
</body>

</html>