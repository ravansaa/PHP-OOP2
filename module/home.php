<?php require('../template/header.php'); ?>

<?php
// Koneksi ke database
include_once '../class/koneksi.php';

// Query untuk menampilkan data mahasiswa
$sql = "SELECT * FROM mahasiswa";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/lab6_oop/template/style.css">

</head>

<body>
    <table border="1">
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php
        include '../class/koneksi.php';
        $query = "SELECT * FROM mahasiswa";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['nim'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['alamat'] . "</td>";
            echo "<td><a href='http://localhost/lab6_oop/hapus?id=" . $row['nim'] . "'>Hapus</a>   <a href='http://localhost/lab6_oop/ubah/?id=" . $row['nim'] . "'>Ubah</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>
<?php require('../template/footer.php'); ?>