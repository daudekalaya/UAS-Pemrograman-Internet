<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Peminjaman Buku</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <header>
    <h1>Form Peminjaman Buku dan Detail Peminjaman</h1>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
      </ul>
    </nav>
  </header>
  <section>
    <form action="proses_peminjaman.php" method="POST" id="formPeminjaman">
      <!-- Input untuk data peminjaman -->
      <label for="peminjamID">Nama Peminjam:</label>
      <select name="peminjamID" id="peminjamID">
        <?php
        // Sertakan file koneksi.php
        include('koneksi.php');

        // Query untuk mendapatkan daftar anggota
        $queryAnggota = "SELECT * FROM peminjam";
        $resultAnggota = mysqli_query($koneksi, $queryAnggota);

        // Tampilkan opsi anggota dalam dropdown
        while ($rowAnggota = mysqli_fetch_assoc($resultAnggota)) {
          echo "<option value='" . $rowAnggota['PeminjamID'] . "'>" . $rowAnggota['NamaPeminjam'] . "</option>";
        }
        ?>
      </select>

      <label for="tanggalPinjam">Tanggal Pinjam:</label>
      <input type="date" name="tanggalPinjam" id="tanggalPinjam" required>

      <label for="tanggalKembali">Tanggal Kembali:</label>
      <input type="date" name="tanggalKembali" id="tanggalKembali" required>

      <!-- Input untuk memilih buku -->
      <label for="bukuID">Buku yang Dipinjam:</label>
      <select name="bukuID" id="bukuID">
        <?php
        // Query untuk mendapatkan daftar buku
        $queryBuku = "SELECT * FROM buku";
        $resultBuku = mysqli_query($koneksi, $queryBuku);

        // Tampilkan opsi buku dalam dropdown
        while ($rowBuku = mysqli_fetch_assoc($resultBuku)) {
          echo "<option value='" . $rowBuku['BukuID'] . "'>" . $rowBuku['Judul'] . "</option>";
        }
        ?>
      </select>

      <!-- Tombol untuk menambahkan buku ke tabel sementara -->
      <button type="button" onclick="tambahBuku()">Tambah Buku</button>

      <!-- Tabel sementara untuk menampilkan detail buku -->
      <table id="tabelDetailBuku" class="responsive-table">
        <tr>
          <th>No</th>
          <th>Judul Buku</th>
          <th>Aksi</th>
        </tr>
      </table>

      <!-- Tombol untuk submit formulir -->
      <button id="submitPinjam" type="submit">Pinjam Buku</button>
    </form>
  </section>

  <script src="script.js"></script>
  <script>
    // Fungsi untuk menambahkan buku ke tabel sementara
    function tambahBuku() {
      var bukuID = document.getElementById("bukuID").value;
      var judulBuku = document.getElementById("bukuID").options[document.getElementById("bukuID").selectedIndex].text;

      // Cek apakah buku sudah ada dalam tabel sementara
      var sudahAda = false;
      var tabel = document.getElementById("tabelDetailBuku");
      for (var i = 1; i < tabel.rows.length; i++) {
        if (tabel.rows[i].cells[1].innerHTML == judulBuku) {
          sudahAda = true;
          break;
        }
      }

      // Jika buku belum ada, tambahkan ke tabel sementara
      if (!sudahAda) {
        var row = tabel.insertRow(-1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);

        cell1.innerHTML = tabel.rows.length - 1;
        cell2.innerHTML = judulBuku;
        cell3.innerHTML = "<button type='button' onclick='hapusBuku(this)'>Hapus</button>";
      } else {
        alert("Buku sudah ada dalam daftar.");
      }
    }

    // Fungsi untuk menghapus buku dari tabel sementara
    function hapusBuku(button) {
      var row = button.parentNode.parentNode;
      row.parentNode.removeChild(row);

      // Update nomor urut setelah menghapus
      var tabel = document.getElementById("tabelDetailBuku");
      for (var i = 1; i < tabel.rows.length; i++) {
        tabel.rows[i].cells[0].innerHTML = i;
      }
    }

    // Fungsi untuk menangani submit formulir
    document.getElementById("formPeminjaman").addEventListener("submit", function (event) {
      event.preventDefault(); // Mencegah formulir untuk dikirimkan secara langsung

      // Menggunakan Fetch API untuk mengirim data formulir ke server
      fetch(this.action, {
        method: this.method,
        body: new URLSearchParams(new FormData(this)),
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        }
      })
        .then(response => response.json()) // Mengonversi respons ke objek JSON
        .then(data => {
          if (data.success) {
            alert("Peminjaman berhasil!");
            // Lakukan operasi lain jika diperlukan setelah peminjaman berhasil
          } else {
            alert("Peminjaman gagal. Silakan coba lagi.");
            // Lakukan operasi lain jika diperlukan setelah peminjaman gagal
          }
        })
        .catch(error => {
          console.error("Error:", error);
          alert("Terjadi kesalahan. Silakan coba lagi.");
        });
    });
  </script>
</body>

</html>
