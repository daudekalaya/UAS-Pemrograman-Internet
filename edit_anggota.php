<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Edit Anggota</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <?php
        include('koneksi.php');
        $peminjamID = $_GET['id'];
        $queryEditAnggota = "SELECT * FROM peminjam WHERE PeminjamID = $peminjamID";
        $resultEditAnggota = mysqli_query($koneksi, $queryEditAnggota);
        if (mysqli_num_rows($resultEditAnggota) == 1) {
            $rowEditAnggota = mysqli_fetch_assoc($resultEditAnggota);
        ?>
            <!-- Formulir Edit Data Anggota -->
            <form action="proses_edit_anggota.php" method="POST" class="edit-form">
                <input type="hidden" name="peminjamID" value="<?php echo $rowEditAnggota['PeminjamID']; ?>">
                <div class="form-group">
                    <label for="nama">Nama Anggota:</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $rowEditAnggota['NamaPeminjam']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" name="alamat" value="<?php echo $rowEditAnggota['Alamat']; ?>">
                </div>
                <div class="form-group">
                    <label for="no_telepon">Nomor Telepon:</label>
                    <input type="text" id="no_telepon" name="no_telepon" value="<?php echo $rowEditAnggota['NoTelepon']; ?>">
                </div>
                <div><br></div>
                <div>
                    <button type="submit">Simpan Perubahan</button>
                </div>
            </form>
        <?php
        } else {
            echo "Data anggota tidak ditemukan.";
        }
        ?>
    </section>
    <script src="script.js"></script>
</body>
</html>
