<?php
include 'db.php';
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1"); 
$a = mysqli_fetch_object($kontak); 

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
                <li><a href="produk.php">Produk</a></li>
            </ul>
        </div>
    </header>

    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="cari produk">
                <input type="submit" name="cari" value="cari produk" class="btn">
            </form>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <h3>kategori</h3>
            <div class="box">
                <?php 
                $kategori = mysqli_query($conn, "SELECT * FROM tb_category");
                if(mysqli_num_rows($kategori) > 0 ){
                    while($k = mysqli_fetch_array($kategori)){
                        ?>
                        <a href="produk.php?kat=<?php echo $k['category_id'] ?>">
                            <div class="col-5">
                                <img src="img/logo.jpg" width="50px" style="margin-bottom: 5px;">
                                <p><?php echo $k['category_name'] ?></p>
                            </div>
                        </a>
                    <?php }} else{ ?>
                        <p>kategori tidak ada</p>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="container">
                <h3>produk terbaru</h3>
                <div class="box">
                    <?php 
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8");
                    if(mysqli_num_rows($produk) > 0 ){
                        while($p = mysqli_fetch_array($produk)){
                            ?>
                            <a href="ditail-produk.php?id=<?php echo $p['product_id'] ?>">
                                <div class="col-4">
                                    <img src="produk/<?php echo $p['product_image'] ?>">
                                    <p class="nama"><?php echo substr($p['product_name'], 0, 20) ?></p>
                                    <p class="harga">Rp. <?php echo number_format( $p['product_price']) ?> </p>  
                                </div>
                            <?php }} else{ ?>
                                <p>produk tidak ada</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <footer>
                <div class="footer">
                    <div class="container">
                        <h4>alamaat</h4>
                        <p><?php echo $a->admin_address ?></p>

                        <h4>email</h4>
                        <p><?php echo $a->admin_email ?></p>

                        <h4>No hp</h4>
                        <p><?php echo $a->admin_telp ?></p>

                        <small>PSI 3B &copy; 2023 SEMANGAT PSI</small>
                    </div>
                </div>
            </footer>
        </body>
        </html>
