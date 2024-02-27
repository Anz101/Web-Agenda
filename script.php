<?php
// Informasi koneksi ke database
$host = "localhost"; // Sesuaikan dengan host database Anda
$username = "root"; // Sesuaikan dengan username database Anda
$password = ""; // Sesuaikan dengan password database Anda
$database = "dataagenda"; // Sesuaikan dengan nama database Anda

// Membuat koneksi
$koneksi = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

$sql = "SELECT * FROM agenda";
$result = $koneksi->query($sql);
if ($result->num_rows > 0) {
    $announcements = [];
    while ($row = $result->fetch_assoc()) {
        $announcements[] = $row;
    }

    // Outputkan sebagai JSON
    header('Content-Type: application/json');
    echo json_encode($announcements);
}

// Menutup koneksi setelah selesai
$koneksi->close();
?>







