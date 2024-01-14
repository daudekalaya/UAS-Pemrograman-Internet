<?php
include('koneksi.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];

    $queryTambahAnggota = "INSERT INTO peminjam (NamaPeminjam, Alamat, NoTelepon) VALUES ('$nama', '$alamat', '$no_telepon')";

    if (mysqli_query($koneksi, $queryTambahAnggota)) {
        header("Location: daftar_anggota.php");
        exit();
    } else {
        echo "Error: " . $queryTambahAnggota . "<br>" . mysqli_error($koneksi);
    }
} else {
    header("Location: tambah_anggota.php");
    exit();
}
?>
