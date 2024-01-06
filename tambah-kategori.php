<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location.href="login.php";</script>';
    exit; // Ensure script stops execution after redirect
}

$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."'");
$d = mysqli_fetch_object($query);
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
            <h3>tambah data kategori</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="nama kategori" class="input-control" required>
                    <input type="submit" name="submit" value="submit" class="btn">
                </form>
                <?php 
                if(isset($_POST['submit'])){
                    $nama = ucwords($_POST['nama']);
                    $insert = mysqli_query($conn, "INSERT INTO tb_category (category_name) VALUES (
                        '".$nama."') ");
                    if($insert){
                        echo '<script>alert("tambah data berhasil")</script>';
                        echo '<script>window.location="data-kategori.php"</script>';
                    }else{
                        echo 'gagal' . mysqli_error($conn);
                    }
                }
                ?>
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
