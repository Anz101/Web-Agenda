<?php
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "dataagenda"; 

$koneksi = new mysqli($host, $username, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}


function ambilDataJadwal($selectedMonth) {
    global $koneksi;

    $sql = "SELECT * FROM agenda WHERE MONTH(tanggal) = $selectedMonth";
    $result = $koneksi->query($sql);

    if (!$result) {
        die("Kesalahan query: " . $koneksi->error);
    }

    return $result;
}
?>









