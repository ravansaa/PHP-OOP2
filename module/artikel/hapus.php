<?php
include '../../class/koneksi.php';
$id = $_GET['id'];
$query = "DELETE FROM mahasiswa WHERE nim = '$id'";
$result = mysqli_query($conn, $query);
if ($result) {
  header('location:  http://localhost/lab6_oop/home/');
} else {
  echo "Data tidak berhasil dihapus.";
}
