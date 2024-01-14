<?php
// Sertakan file koneksi.php
include('koneksi.php');

// Ambil data dari formulir
$peminjamID = $_POST['peminjamID'];
$tanggalPinjam = $_POST['tanggalPinjam'];
$tanggalKembali = $_POST['tanggalKembali'];

// Insert peminjaman ke tabel peminjaman
$queryPeminjaman = "INSERT INTO peminjaman (PeminjamID, TanggalPinjam, TanggalKembali) VALUES ('$peminjamID', '$tanggalPinjam', '$tanggalKembali')";
mysqli_query($koneksi, $queryPeminjaman);

// Ambil ID peminjaman yang baru saja dibuat
$peminjamanID = mysqli_insert_id($koneksi);

// Ambil data buku dari tabel sementara
if (isset($_POST['bukuIDs'])) {
  $bukuIDs = $_POST['bukuIDs'];

  // Insert detail peminjaman ke tabel detailpeminjaman
  foreach ($bukuIDs as $bukuID) {
    $queryDetail = "INSERT INTO detailpeminjaman (PeminjamanID, BukuID) VALUES ('$peminjamanID', '$bukuID')";
    mysqli_query($koneksi, $queryDetail);
  }
}

// Kirim respons JSON ke klien
header('Content-Type: application/json');
echo json_encode(['success' => true]);
exit();
?>
