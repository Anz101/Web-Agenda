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

    // Hapus keterangan terkait agenda
    $sql_delete_keterangan = "DELETE FROM agenda_keterangan WHERE agenda_id=$id_agenda";
    $result_delete_keterangan = $koneksi->query($sql_delete_keterangan);

    if (!$result_delete_keterangan) {
        die("Error deleting agenda keterangan: " . $koneksi->error);
    }

    // Hapus agenda
    $sql_delete_agenda = "DELETE FROM agenda WHERE id=$id_agenda";
    $result_delete_agenda = $koneksi->query($sql_delete_agenda);

    if (!$result_delete_agenda) {
        die("Error deleting agenda: " . $koneksi->error);
    }

    return true;
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $id_agenda = $_POST["id"];

    if (deleteAgenda($id_agenda)) {
        echo "<br>Agenda berhasil dihapus.";
    } else {
        echo "<br>Error: Gagal menghapus agenda.";
    }
}

function simpanuserBaru($username, $password) {
    global $koneksi;

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $koneksi->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt === false) {
        return false;
    }
    $stmt->bind_param("ss", $username, $password_hash);
    $result = $stmt->execute();
    if ($result === true) {
        return true;
    } else {
        return false;
    }
}



// Fungsi untuk mengambil data agenda berdasarkan ID
function getAgendaById($id_agenda) {
    global $koneksi;

    $sql = "SELECT * FROM agenda WHERE id = $id_agenda";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Fungsi untuk mengambil data keterangan agenda berdasarkan ID agenda
function getKeteranganByAgendaId($id_agenda) {
    global $koneksi;

    $keterangan_data = array();

    $sql = "SELECT * FROM agenda_keterangan WHERE agenda_id = $id_agenda ORDER BY created_at DESC";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $keterangan_data[] = $row;
        }
    }

    return $keterangan_data;
}


// Fungsi untuk menambahkan keterangan pada agenda
function tambahKeteranganAgenda($id_agenda, $keterangan, $username) {
    global $koneksi;

    $sql = "INSERT INTO agenda_keterangan (agenda_id, keterangan, user_id) VALUES (?, ?, (SELECT id FROM admins WHERE username = ?))";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("iss", $id_agenda, $keterangan, $username);
    $result = $stmt->execute();
    
    $stmt->close();
    return $result;
}


// Fungsi untuk logout
function logout() {
    session_start();
    session_unset();
    session_destroy();
    header("Location: loginadmin.php");
    exit;
}

function out() {
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}



?>










