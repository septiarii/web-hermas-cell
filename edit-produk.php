<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location.href="login.php";</script>';
    exit; // Ensure script stops execution after redirect
}
$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
if(mysqli_num_rows($produk) == 0){
    echo '<script>window.location="data-produk.php"</script>';

}
$p = mysqli_fetch_object($produk);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HERMAS CELL</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://cdn.ckeditor.com/4.23.0-lts/standard/ckeditor.js"></script>
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
            <h3>edit produk</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select class="input-control" name="kategori" required>
                        <option value="">---pilih---</option>
                        <?php
                        $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                        while ($r = mysqli_fetch_assoc($kategori)) {
                            ?>
                            <option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->category_id) ? 'selected' : ''; ?>><?php echo $r['category_name'] ?></option>
                        <?php } ?>
                    </select>

                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $p->product_name ?>" required>
                    <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->product_price ?>" required>
                    <img src="produk/<?php echo $p->product_image ?>" width="100px">
                    <input type="hidden" name="poto" value="<?php echo $p->product_image ?>">
                    <input type="file" name="gambar" class="input-control">
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->product_description ?></textarea>
                    <select class="input-control" name="status">
                        <option value=""> ---pilih---</option>
                        <option value="1" <?php echo ($p->product_status == 1) ? 'selected' : ''; ?>>tersedia</option>
                        <option value="0" <?php echo ($p->product_status == 0) ? 'selected' : ''; ?>>tidak tersedia</option>
                    </select>
                    <input type="submit" name="submit" value="submit" class="btn">
                </form>
                <?php 
                if(isset($_POST['submit'])){
                    $kategori = $_POST['kategori'];
                    $nama = ucwords($_POST['nama']);
                    $harga = $_POST['harga'];
                    $deskripsi = $_POST['deskripsi'];
                    $status = $_POST['status'];
                    $poto = $_POST['poto'];

                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    $type1 = explode('.', $filename);
                    $type2 = end($type1);

                    $newname = 'produk'.time().'.'.$type2;

                    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

                    if($filename != ''){
                        if(!in_array($type2, $tipe_diizinkan)){
                            echo '<script>alert("format file tidak di izinkan")</script>';
                        } else {
                            unlink('./produk/'.$poto);
                            move_uploaded_file($tmp_name, './produk/'.$newname);
                            $namagambar = $newname;
                        }
                    } else {
                        $namagambar = $poto;
                    }

                    $update = mysqli_query($conn, "UPDATE tb_product SET
                        category_id = '".$kategori."',
                        product_name = '".$nama."',
                        product_price = '".$harga."',
                        product_description = '".$deskripsi."',
                        product_status = '".$status."',
                        product_image = '".$namagambar."'
                        WHERE product_id = '".$p->product_id."' ");

                    if($update){
                        echo '<script>alert("ubah data berhasil")</script>';
                        echo '<script>window.location="data-produk.php"</script>';
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
    <textarea name="editor1"></textarea>
    <script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>
