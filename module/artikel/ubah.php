<?php require('../../template/header.php'); ?>
<?php
error_reporting(E_ALL);
include_once '../../class/koneksi.php';

if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    $stmt = $conn->prepare("UPDATE mahasiswa SET nama=?, alamat=? WHERE nim=?");
    $stmt->bind_param("sss", $nama, $alamat, $nim);
    $result = $stmt->execute();

    if ($result) {
        header('location: http://localhost/lab6_oop/home/');
        exit;
    } else {
        echo "Terjadi kesalahan saat mengubah data";
    }
}

if (isset($_GET['id'])) {
    $nim = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE nim=?");
    $stmt->bind_param("s", $nim);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        header('location: http://localhost/lab6_oop/home/');
        exit;
    }
} else {
    header('location: http://localhost/lab6_oop/home/');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="#" rel="#" type="text/css" />
    <title>Ubah Mahasiswa</title>
</head>

<body>
    <div class="container">
        <h1>Ubah Mahasiswa</h1>
        <div class="main">
            <form method="post" action="">
                <input type="hidden" name="nim" value="<?php echo $data['nim']; ?>">
                <div class="input">
                    <label>NIM</label>
                    <input type="text" name="nim" value="<?php echo $data['nim']; ?>" style="margin-left: 55px;" readonly />
                </div>
                <br>
                <div class="input">
                    <label>Nama</label>
                    <input type="text" name="nama" value="<?php echo $data['nama']; ?>" style="margin-left: 40px;" />
                </div>
                <br>
                <div class="input">
                    <label>Alamat</label>
                    <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>" style="margin-left: 33px;" />
                </div>
                <br>
                <div class="submit">
                    <input type="submit" name="submit" value="Simpan" />
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<?php require('../../template/footer.php'); ?>