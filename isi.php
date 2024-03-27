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

$id_agenda = null; 

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id_agenda = $_GET["id"];
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id_agenda = $_POST["id"];
}


if ($id_agenda !== null) {
    $sql = "SELECT * FROM agenda WHERE id = $id_agenda";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo "<h2>Judul Agenda: " . $row["judul"] . "</h2>";
        echo "<p>Tanggal: " . $row["tanggal"] . "</p>";
        echo "<p>Isi Agenda: " . $row["isi"] . "</p>";
        echo "<p>Keterangan: " . $row["keterangan"] . "</p>";

        
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

    
    $sql = "UPDATE agenda SET keterangan='$keterangan' WHERE id=$id_agenda";
    if ($koneksi->query($sql) === TRUE) {
        echo "<br>Keterangan berhasil ditambahkan.";
    } else {
        echo "<br>Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
?>

    </div>
</body>
</html>
