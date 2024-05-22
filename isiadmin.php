<?php
session_start();

if(isset($_SESSION['admin'])) {
    if(time() - $_SESSION['admin_login_time'] > 1800) { 
        session_unset();
        session_destroy();
        header("Location: loginadmin.php?error=session_expired");
        exit;
    } else {
        $_SESSION['admin_login_time'] = time();
    }
} else {
    header("Location: loginadmin.php");
    exit;
}

include 'script.php';

$id_agenda = null;

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id_agenda = $_GET["id"];
} else {
    header("Location: indexadmin.php");
    exit;
}

$sql = "SELECT * FROM agenda WHERE id = $id_agenda";
$result = $koneksi->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $id_agenda = $_POST["id"];

    if (deleteAgenda($id_agenda)) {
        header("Location: indexadmin.php");
        exit;
    } else {
        echo "<br>Error: Gagal menghapus agenda.";
    }
}

?>

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
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            echo "<h2>Judul Agenda: " . $row["judul"] . "</h2>";
            echo "<p>Tanggal: " . $row["tanggal"] . "</p>";
            echo "<p>Isi Agenda: " . $row["isi"] . "</p>";

            $sql_keterangan = "SELECT * FROM agenda_keterangan WHERE agenda_id = $id_agenda ORDER BY created_at DESC";
            $result_keterangan = $koneksi->query($sql_keterangan);

            if ($result_keterangan->num_rows > 0) {
                echo "<h3>Keterangan:</h3>";
                while ($row_keterangan = $result_keterangan->fetch_assoc()) {
                    // Ambil waktu keterangan
                    $created_at = $row_keterangan["created_at"];
                    // Ambil username pengguna yang menambahkan keterangan
                    $user_id = $row_keterangan["user_id"];
                    $sql_username = "SELECT username FROM admins WHERE id = $user_id";
                    $result_username = $koneksi->query($sql_username);
                    if ($result_username->num_rows > 0) {
                        $row_username = $result_username->fetch_assoc();
                        $username = $row_username["username"];
                    } else {
                        $username = "Unknown";
                    }

                    echo "<p>$created_at oleh $username: " . $row_keterangan["keterangan"] . "</p>";
                }
            } else {
                echo "<p>Tidak ada keterangan.</p>";
            }

            echo "<form method='post'>";
            echo "<input type='hidden' name='id' value='$id_agenda'>";
            echo "<input type='submit' name='delete' value='Hapus Agenda'>";
            echo "</form>";

            echo "<br><a href='indexadmin.php'>Back</a>";
        } else {
            echo "Agenda tidak ditemukan.";
        }

        $koneksi->close();
        ?>
    </div>
</body>
</html>
