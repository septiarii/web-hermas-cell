<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location.href="login.php";</script>';
    exit; // Ensure script stops execution after redirect
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <h3>produk</h3>
            <div class="box">
                <p><a href="tambah-produk.php">tambah produk</a></p>
                <table border="1" cellpadding="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>kategori</th>
                            <th>nama produk</th>
                            <th>harga</th>
                            
                            <th>gambar</th>
                            <th>status</th>
                            <th width="150px">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING(category_id) ORDER BY product_id DESC");
                        if(mysqli_num_rows($produk) > 0){
                            while ($row = mysqli_fetch_array($produk)) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['category_name'] ?></td>
                                    <td><?php echo $row['product_name'] ?></td>
                                    <td><?php echo number_format($row['product_price']) ?></td>
                                    
                                    <td><img src="produk/<?php echo $row['product_image'] ?>" alt="Product Image" width="50px"></td>
                                    <td><?php echo ($row['product_status'] == 0) ? 'tidak tersedia' : 'tersedia' ?></td>
                                    <td>
                                        <a href="edit-produk.php?id=<?php echo $row['product_id'] ?>">edit</a> || <a href="hapus-barang.php?idp=<?php echo $row['product_id']; ?>" onclick="return confirm('yakin ingin menghapus')">hapus</a>
                                    </td>
                                </tr>
                                <?php 
                            }
                        } else { 
                            ?>
                            <tr>
                                <td colspan="8">tidak ada data</td>
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
