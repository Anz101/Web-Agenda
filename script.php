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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedMonth = $_POST["monthSelect"];

    $sql = "SELECT * FROM agenda WHERE MONTH(tanggal) = $selectedMonth";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Tanggal</th><th>Judul Pengumuman</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["tanggal"] . "</td>";
            echo "<td>" . $row["judul"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Tidak ada data ditemukan.";
    }
}

// Menutup koneksi setelah selesai
$koneksi->close();
?>







