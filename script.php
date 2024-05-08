<?php
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "dataagenda"; 

$koneksi = new mysqli($host, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

// Fungsi untuk mengambil data agenda berdasarkan bulan
function ambilDataJadwal($selectedMonth) {
    global $koneksi;

    $sql = "SELECT * FROM agenda WHERE MONTH(tanggal) = $selectedMonth";
    $result = $koneksi->query($sql);

    if (!$result) {
        die("Kesalahan query: " . $koneksi->error);
    }

    return $result;
}

// Fungsi untuk menghapus agenda berdasarkan ID
function deleteAgenda($id_agenda) {
    global $koneksi;

    $sql_delete = "DELETE FROM agenda WHERE id=$id_agenda";
    
    if ($koneksi->query($sql_delete) === TRUE) {
        return true; 
    } else {
        return false; 
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $id_agenda = $_POST["id"];

    if (deleteAgenda($id_agenda)) {
        echo "<br>Agenda berhasil dihapus.";
    } else {
        echo "<br>Error: Gagal menghapus agenda.";
    }
}

function simpanadminBaru($username, $password) {
    global $koneksi;

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO admins (username, password) VALUES ('$username', '$password_hash')";
    if ($koneksi->query($sql) === TRUE) {
        return true; 
    } else {
        return false; 
    }
}

function simpanuserBaru($username, $password) {
    global $koneksi;

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password_hash')";
    if ($koneksi->query($sql) === TRUE) {
        return true; 
    } else {
        return false; 
    }
}

?>








