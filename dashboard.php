<?php
session_start();
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location.href="login.php";</script>';
        exit; // Ensure script stops execution after redirect
    }

    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HERMAS CELL</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <header>
            <div class="container">
                <h1><a href="dashboard.php">HERMASS CELL</a></h1>
                <ul>
                    <li><a href="profil.php">profil</a></li>
                    <li><a href="data-kategori.php">data kategori</a></li>
                    <li><a href="data-produk.php">data produk</a></li>
                    <li><a href="keluar.php">keluar</a></li>
                </ul>
            </div>
        </header>
        <div class="section">
            <div class="container">
                <div class="box">
                    <h4>Selamat datang</h4>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <small>PSI 3B &copy; 2023 SEMANGAT PSI</small>
            </div>
        </footer>
    </body>
    </html>
