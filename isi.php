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

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
            $id_agenda = $_GET["id"];

            $sql = "SELECT * FROM agenda WHERE id = $id_agenda";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                echo "<h2>" . $row["judul"] . "</h2>";
                echo "<p>Tanggal: " . $row["tanggal"] . "</p>";
                echo "<p>Isi Agenda: " . $row["isi"] . "</p>";

                echo "<a href='index.php'>Back</a>";
            } else {
                echo "Agenda tidak ditemukan.";
            }
        } else {
            echo "ID Agenda tidak valid.";
        }

        $koneksi->close();
        ?>
    </div>
</body>
</html>

