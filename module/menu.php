<?php
include 'Database.php';
$db = new Database();

// Cek koneksi database


// Tampilkan data mahasiswa
$data = $db->get('mahasiswa');
?>

<!DOCTYPE html>
<html>

<head>
  <title>Menu Database</title>
</head>

<body>
  <h1>Menu Database</h1>
  <ul>
    <li><a href="?action=lihat">Lihat Data Mahasiswa</a></li>
    <li><a href="?action=tambah">Tambah Data Mahasiswa</a></li>
    <li><a href="?action=edit">Edit Data Mahasiswa</a></li>
    <li><a href="?action=hapus">Hapus Data Mahasiswa</a></li>
  </ul>

  <?php
  // Tampilkan data mahasiswa jika menu Lihat Data Mahasiswa dipilih
  if (isset($_GET['action']) && $_GET['action'] == 'lihat') {
    echo '<h2>Data Mahasiswa</h2>';
    if ($data) {
      echo '<table>';
      echo '<tr><th>ID</th><th>Nama</th><th>Email</th><th>Telepon</th></tr>';
      foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['nama'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['telepon'] . '</td>';
        echo '</tr>';
      }
      echo '</table>';
    } else {
      echo 'Data tidak ditemukan.';
    }
  }

  // Tambah data mahasiswa jika menu Tambah Data Mahasiswa dipilih
  if (isset($_GET['action']) && $_GET['action'] == 'tambah') {
    if (isset($_POST['submit'])) {
      $data = array(
        'nama' => $_POST['nama'],
        'email' => $_POST['email'],
        'telepon' => $_POST['telepon']
      );
      if ($db->insert('mahasiswa', $data)) {
        echo 'Data mahasiswa berhasil ditambahkan.';
      } else {
        echo 'Data mahasiswa gagal ditambahkan.';
      }
    } else {
      echo '<h2>Tambah Data Mahasiswa</h2>';
      echo '<form method="post">';
      echo '<label>Nama:</label> <input type="text" name="nama"><br>';
      echo '<label>Email:</label> <input type="text" name="email"><br>';
      echo '<label>Telepon:</label> <input type="text" name="telepon"><br>';
      echo '<input type="submit" name="submit" value="Tambah">';
      echo '</form>';
    }
  }

  // Edit data mahasiswa jika menu Edit Data Mahasiswa dipilih
  if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    if (isset($_POST['submit'])) {
      $data = array(
        'nama' => $_POST['nama'],
        'email' => $_POST['email'],
        'nim' => $_POST['nim'],
        'jurusan' => $_POST['jurusan']
      );
      $where = "id = " . $_GET['id'];
      if ($db->update('mahasiswa', $data, $where)) {
        echo '<script>alert("Data berhasil diupdate.");window.location.href="index.php";</script>';
      } else {
        echo '<script>alert("Data gagal diupdate.");window.location.href="index.php";</script>';
      }
    } else {
      $id = $_GET['id'];
      $data = $db->get('mahasiswa', "id = $id");
  ?>
      <form action="" method="POST">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?php echo $data['nama']; ?>">
        <br><br>
        <label for="email">Email</label>
        <input type="text" id="email" name="email" value="<?php echo $data['email']; ?>">
        <br><br>
        <label for="nim">NIM</label>
        <input type="text" id="nim" name="nim" value="<?php echo $data['nim']; ?>">
        <br><br>
        <label for="jurusan">Jurusan</label>
        <input type="text" id="jurusan" name="jurusan" value="<?php echo $data['jurusan']; ?>">
        <br><br>
        <input type="submit" name="submit" value="Update Data">
      </form>
  <?php
    }
  }

  // Hapus data mahasiswa jika menu Hapus Data Mahasiswa dipilih
  if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $filter = "WHERE id = " . $id;
    if ($db->delete('mahasiswa', $filter)) {
      echo '<script>alert("Data berhasil dihapus.");window.location.href="index.php";</script>';
    } else {
      echo '<script>alert("Data gagal dihapus.");window.location.href="index.php";</script>';
    }
  }
  ?>

</body>

</html>