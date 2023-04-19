<?php
$host = "localhost"; // Sesuaikan dengan host database Anda
$user = "root"; // Sesuaikan dengan user database Anda
$pass = ""; // Sesuaikan dengan password database Anda
$dbname = "db_mahasiswa"; // Sesuaikan dengan nama database Anda

// Buat koneksi ke database
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}
