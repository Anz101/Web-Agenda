<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

include 'script.php';

$id_agenda = null;

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id_agenda = $_GET["id"];
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id_agenda = $_POST["id"];
}

if ($id_agenda !== null) {
    $agenda_data = getAgendaById($id_agenda);

    if ($agenda_data !== null) {
        echo "<h2>Judul Agenda: " . $agenda_data["judul"] . "</h2>";
        echo "<p>Tanggal: " . $agenda_data["tanggal"] . "</p>";
        echo "<p>Isi Agenda: " . $agenda_data["isi"] . "</p>";

        $keterangan_data = getKeteranganByAgendaId($id_agenda);

        if (!empty($keterangan_data)) {
            echo "<h3>Keterangan:</h3>";
            foreach ($keterangan_data as $keterangan) {
                echo "<p>" . $keterangan["created_at"] . ": " . $keterangan["keterangan"] . "</p>";
            }
        } else {
            echo "<p>Tidak ada keterangan.</p>";
        }

        echo "<form method='post'>";
        echo "<input type='hidden' name='id' value='$id_agenda'>"; 
        echo "<label for='keterangan'>Tambah Keterangan Baru:</label><br>";
        echo "<input type='text' id='keterangan' name='keterangan' required><br><br>";
        echo "<input type='submit' value='Simpan Keterangan'>";
        echo "</form>";

        echo "<br><a href='index.php'>Back</a>";
    } else {
        echo "Agenda tidak ditemukan.";
    }
} else {
    echo "ID Agenda tidak valid.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id_agenda = $_POST["id"];
    $keterangan = $_POST["keterangan"];

    $success = tambahKeteranganAgenda($id_agenda, $keterangan);

    if ($success) {
        echo "<br>Keterangan berhasil ditambahkan.";
    } else {
        echo "<br>Error: Gagal menambahkan keterangan.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Agenda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="app"></div>
</body>
</html>

