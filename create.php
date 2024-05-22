<?php
session_start();

if(isset($_SESSION['admin'])) {
    if(time() - $_SESSION['admin_login_time'] > 1800) { 
        logout(); 
        exit;
    } else {
        $_SESSION['admin_login_time'] = time();
    }
} else {
    header("Location: loginadmin.php");
    exit;
}

include 'script.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST["judul"];
    $isi = $_POST["isi"];
    $tanggal = $_POST["tanggal"];
    $keterangan = $_POST["keterangan"]; 
    $username = $_SESSION['admin']; // Menyimpan username admin yang sedang login
    
    // Menggunakan parameter terikat untuk mencegah SQL injection
    $sql = "INSERT INTO agenda (judul, isi, tanggal, keterangan) VALUES (?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssss", $judul, $isi, $tanggal, $keterangan);
    
    if ($stmt->execute()) {
        $agenda_id = $koneksi->insert_id; // Mengambil ID agenda yang baru saja ditambahkan
        // Memanggil fungsi untuk menambahkan keterangan agenda
        tambahKeteranganAgenda($agenda_id, $keterangan, $username);
        echo "Agenda berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
    $stmt->close(); // Tutup statement
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Agenda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Create Agenda</h1>
    
    <div id="app">
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
        
        <a href="indexadmin.php">Back</a>
    </div>
</body>
</html>