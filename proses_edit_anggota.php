<?php
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $peminjamID = $_POST['peminjamID'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    $queryUpdateAnggota = "UPDATE peminjam SET NamaPeminjam = '$nama', Alamat = '$alamat' WHERE PeminjamID = $peminjamID";

    if (mysqli_query($koneksi, $queryUpdateAnggota)) {
        header("Location: daftar_anggota.php");
        exit();
    } else {
        echo "Error: " . $queryUpdateAnggota . "<br>" . mysqli_error($koneksi);
    }
} else {
    header("Location: edit_anggota.php?anggotaID=" . $_POST['peminjamID']);
    exit();
}
?>
