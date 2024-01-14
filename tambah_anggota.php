<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Tambah Anggota</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <div class="form-container">
            <!-- Formulir Tambah Data Anggota -->
            <form action="proses_tambah_anggota.php" method="POST" class="add-form">
                <div class="form-group">
                    <label for="nama">Nama Anggota:</label>
                    <input type="text" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" name="alamat">
                </div>
                <div class="form-group">
                    <label for="no_telepon">Nomor Telepon:</label>
                    <input type="text" id="no_telepon" name="no_telepon">
                </div>
                <button type="submit">Tambah</button>
            </form>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>
