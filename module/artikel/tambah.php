<?php require('../../template/header.php'); ?>

<?php
include_once '../../class/koneksi.php';
$error_nim = '';
$error_nama = '';
$error_alamat = '';
$nim = '';
$nama = '';
$alamat = '';

if (isset($_POST['submit'])) {
    // Cek apakah NIM diisi atau tidak
    if (empty($_POST['nim'])) {
        $error_nim = 'NIM tidak boleh kosong';
    } else {
        $nim = mysqli_real_escape_string($conn, $_POST['nim']);
        // Cek apakah NIM sudah ada di database atau belum
        $sql = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $error_nim = 'NIM sudah terdaftar';
        }
    }

    // Cek apakah Nama diisi atau tidak
    if (empty($_POST['nama'])) {
        $error_nama = 'Nama tidak boleh kosong';
    } else {
        $nama = mysqli_real_escape_string($conn, $_POST['nama']);
        // Hanya diperbolehkan memasukkan huruf dan spasi
        if (!preg_match('/^[a-zA-Z\s]+$/', $nama)) {
            $error_nama = 'Nama hanya boleh mengandung huruf dan spasi';
        }
    }

    // Cek apakah Alamat diisi atau tidak
    if (empty($_POST['alamat'])) {
        $error_alamat = 'Alamat tidak boleh kosong';
    } else {
        $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    }

    // Jika tidak ada error, simpan ke database
    if (empty($error_nim) && empty($error_nama) && empty($error_alamat)) {
        $sql = "INSERT INTO mahasiswa (nim, nama, alamat) VALUES ('$nim', '$nama', '$alamat')";
        if (mysqli_query($conn, $sql)) {
            header('location:  http://localhost/lab6_oop/home/?success=1');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Input Data Mahasiswa</title>
    <link href="http://localhost/lab6_oop/template/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
    <h1>Input Data Mahasiswa</h1>
    <?php if (isset($_GET['success'])) : ?>
        <p>Data berhasil disimpan</p>
    <?php endif; ?>
    <form method="post" action="">
        <table>
            <tr>
                <td>NIM</td>
                <td><input type="text" name="nim" value="<?php echo $nim; ?>"></td>
                <td><span style="color:red"><?php echo $error_nim; ?></span></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $nama; ?>"></td>
                <td><span style="color:red"><?php echo $error_nama; ?></span></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat"><?php echo $alamat; ?></textarea></td>
                <td><span style="color:red"><?php echo $error_alamat; ?></span></td>
            </tr>

            <tr>
                <td colspan="2" align="right"><input type="submit" name="submit" value="Simpan"></td>
            </tr>
        </table>
    </form>
</body>

</html>
<?php require('../../template/footer.php'); ?>