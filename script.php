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

$sql = "SELECT * FROM agenda";
$result = $koneksi->query($sql);
if ($result->num_rows > 0) {
    $announcements = [];
    while ($row = $result->fetch_assoc()) {
        $announcements[] = $row;
    }
}

?>

<script>
    function loadData() {
        const selectedMonth = document.getElementById('monthSelect').value;
        // Implementasi untuk mengambil data pengumuman dari database sesuai bulan yang dipilih
        // Tampilkan data di dalam kalender
        const calendar = document.getElementById('calendar');
        // Hapus semua elemen anak dari kalender
        while (calendar.firstChild) {
            calendar.removeChild(calendar.firstChild);
        }
        // Tambahkan tanggal ke dalam kalender
        const lastDay = new Date(2024, selectedMonth, 0).getDate();
        for (let i = 1; i <= lastDay; i++) {
            const dateDiv = document.createElement('div');
            dateDiv.classList.add('date');
            dateDiv.textContent = i;
            // Implementasi untuk menampilkan pengumuman sesuai tanggal
            // Gunakan data dari database
            const announcementDiv = document.createElement('div');
            announcementDiv.textContent = 'Pengumuman di sini'; // Gantilah dengan data sesuai kebutuhan
            dateDiv.appendChild(announcementDiv);
            calendar.appendChild(dateDiv);
        }
    }

    // Load data pertama kali halaman dimuat
    window.onload = loadData;
</script>

<?php
// Menutup koneksi setelah selesai
$koneksi->close();
?>






