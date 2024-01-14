<?php
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $peminjamID = $_GET['id'];
    $queryHapusAnggota = "DELETE FROM peminjam WHERE PeminjamID = $peminjamID";

    if (mysqli_query($koneksi, $queryHapusAnggota)) {
        header("Location: daftar_anggota.php");
        exit();
    } else {
        echo "Error: " . $queryHapusAnggota . "<br>" . mysqli_error($koneksi);
    }
} else {
    header("Location: daftar_anggota.php");
    exit();
}
?>
