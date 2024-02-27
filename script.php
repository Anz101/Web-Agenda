<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

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

// Contoh query
$sql = "SELECT * FROM jadwal";
$result = $koneksi->query($sql);

// Menampilkan hasil query
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Senin</th><th>Selasa</th><th>Rabu</th><th>Kamis</th><th>Jumat</th><th>Sabtu</th><th>Minggu</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Senin"] . "</td>";
        echo "<td>" . $row["Selasa"] . "</td>";
        echo "<td>" . $row["Rabu"] . "</td>";
        echo "<td>" . $row["Kamis"] . "</td>";
        echo "<td>" . $row["Jumat"] . "</td>";
        echo "<td>" . $row["Sabtu"] . "</td>";
        echo "<td>" . $row["Minggu"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data ditemukan.";
}

// Menutup koneksi setelah selesai
$koneksi->close();
?>


