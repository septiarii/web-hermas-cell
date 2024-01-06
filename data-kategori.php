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
            <h3>kategori</h3>
            <div class="box">
                <p><a href="tambah-kategori.php">tambah kategori</a></p>
                <table border="1" cellpadding="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>kategori</th>
                            <th width="150px">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                        if(mysqli_num_rows($kategori) > 0) {
                            while ($row = mysqli_fetch_array($kategori)) {
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['category_name']; ?></td>
                                    <td>
                                        <a href="edit-kategori.php?id=<?php echo $row['category_id']; ?>">edit</a> || <a href="hapus-barang.php?idk=<?php echo $row['category_id']; ?>" onclick="return confirm('yakin ingin menghapus')">hapus</a>
                                        
                                    </td>
                                </tr>
                                <?php
                            }
                        } else { 
                            ?>
                            <tr>
                                <td colspan="3">tidak ada data</td>
                            </tr> 
                            <?php  
                        } 
                        ?>
                    </tbody>
                </table>
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
