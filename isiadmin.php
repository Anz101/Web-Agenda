<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Agenda (Admin)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Detail Agenda (Admin)</h1>
    
    <div id="app">
    <?php
    include 'script.php';

    $id_agenda = null; 

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $id_agenda = $_GET["id"];
    } else {
            echo "ID Agenda tidak valid.";
             exit; 
    }

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
        echo "<input type='submit' name='delete' value='Hapus Agenda'>";
        echo "</form>";

        echo "<br><a href='indexadmin.php'>Back</a>";
    } else {
        echo "Agenda tidak ditemukan.";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
        $id_agenda = $_POST["id"];
    
        
        if (deleteAgenda($id_agenda)) {
            echo "<br>Agenda berhasil dihapus.";
            echo "<script>window.location.href = 'indexadmin.php';</script>";
            exit;
        } else {
            echo "<br>Error: Gagal menghapus agenda.";
        }
    }
    
    ?>
    </div>
</body>
</html>
