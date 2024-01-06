<?php
session_start();
include 'db.php';

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location.href="login.php";</script>';
    exit; // Ensure script stops execution after redirect
}

if(isset($_GET['id'])) {
    $kategori_id = $_GET['id'];
    $kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_id = '".$kategori_id."'");
    $k = mysqli_fetch_object($kategori);
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
            <h3>Edit kategori</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="nama kategori" class="input-control" value="<?php echo $k->category_name; ?>" required>
                    <input type="submit" name="submit" value="submit" class="btn">
                </form>

                <?php 
                if(isset($_POST['submit'])){
                    $nama = ucwords($_POST['nama']);
                    
                    $update = mysqli_query($conn, "UPDATE tb_category SET
                        category_name = '".$nama."'
                        WHERE category_id = '".$kategori_id."'");

                    if($update){
                        echo '<script>alert("update data berhasil")</script>';
                        echo '<script>window.location="data-kategori.php"</script>';
                    } else {
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
