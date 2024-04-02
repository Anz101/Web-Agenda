<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Agenda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Detail Agenda</h1>
    
    <div id="app">
        <?php
        include 'script.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $judul = $_POST["judul"];
            $isi = $_POST["isi"];
            $tanggal = $_POST["tanggal"];
            $keterangan = $_POST["keterangan"]; 
            
            $sql = "INSERT INTO agenda (judul, isi, tanggal, keterangan) VALUES ('$judul', '$isi', '$tanggal', '$keterangan')";
            if ($koneksi->query($sql) === TRUE) {
                echo "Agenda berhasil ditambahkan.";
            } else {
                echo "Error: " . $sql . "<br>" . $koneksi->error;
            }
        }
        ?>
        
        <form method="post">
            <label for="judul">Judul Agenda:</label><br>
            <input type="text" id="judul" name="judul" required><br><br>

            <label for="tanggal">Tanggal:</label><br>
            <input type="date" id="tanggal" name="tanggal" required><br><br>

            <label for="isi">Isi Agenda:</label><br>
            <textarea id="isi" name="isi" rows="4" cols="50"></textarea><br><br>

            <label for="keterangan">Keterangan:</label><br>
            <input type="text" id="keterangan" name="keterangan" required><br><br>

            <input type="submit" value="Simpan">
        </form>
        
        <a href="indexadmin.php">Kembali ke Daftar Agenda</a>
    </div>
</body>
</html>
