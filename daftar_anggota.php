<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Anggota</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <header>
    <h1>Daftar Anggota</h1>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
      </ul>
    </nav>
  </header>
  <section>
    <!-- Formulir Pencarian (Tambahkan sesuai kebutuhan) -->
    <form action="daftar_anggota.php" method="GET" class="search-form">
      <div class="search-container">
        <input type="text" id="search" name="search" placeholder="Nama Anggota" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
      </div>
      <button type="submit">Cari</button>
    </form>
    <!-- Tabel Daftar Anggota -->
    <table class="responsive-table">
      <tr>
        <th>PeminjamID</th>
        <th>Nama Peminjam</th>
        <th>Alamat</th>
        <th>No Telepon</th>
        <th>Aksi</th>
      </tr>
      <?php
      include('koneksi.php');
      // Logika Pencarian
      $search = isset($_GET['search']) ? $_GET['search'] : '';
      $query = "SELECT * FROM peminjam WHERE NamaPeminjam LIKE '%$search%'";
      $result = mysqli_query($koneksi, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['PeminjamID'] . "</td>";
        echo "<td>" . $row['NamaPeminjam'] . "</td>";
        echo "<td>" . $row['Alamat'] . "</td>";
        echo "<td>" . $row['NoTelepon'] . "</td>";
        echo "<td>";
        echo "<a href='edit_anggota.php?id=" . $row['PeminjamID'] . "'>Edit</a> | ";
        echo "<a href='#' onclick='hapusAnggota(" . $row['PeminjamID'] . ")'>Hapus</a>";
        echo "</td>";
        echo "</tr>";
      }
      ?>
    </table>
  </section>
  <script src="script.js"></script>
  <script>
    function hapusAnggota(peminjamID) {
      var konfirmasi = confirm("Apakah Anda yakin ingin menghapus anggota ini?");
      if (konfirmasi) {
        window.location.href = 'proses_hapus_anggota.php?id=' + peminjamID;
      }
    }
  </script>
</body>

</html>
