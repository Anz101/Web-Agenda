<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Organisasi XXX</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function loadData() {
            const selectedMonth = document.getElementById('monthSelect').value;

            // Menggunakan fetch untuk mengambil data JSON dari script.php
            fetch('script.php')
                .then(response => response.json())
                .then(data => {
                    const calendar = document.getElementById('calendar');
                    while (calendar.firstChild) {
                        calendar.removeChild(calendar.firstChild);
                    }

                    const lastDay = new Date(2024, selectedMonth, 0).getDate();
                    for (let i = 1; i <= lastDay; i++) {
                        const dateDiv = document.createElement('div');
                        dateDiv.classList.add('date');
                        dateDiv.textContent = i;

                        const announcementDiv = document.createElement('div');
                        // Cari pengumuman sesuai tanggal dan bulan di data JSON
                        const announcement = data.find(item => {
                            const itemDate = new Date(item.tanggal);
                            return itemDate.getMonth() + 1 == selectedMonth && itemDate.getDate() == i;
                        });

                        if (announcement) {
                            announcementDiv.textContent = `${announcement.judul} (${announcement.tanggal})`;
                        }

                        dateDiv.appendChild(announcementDiv);
                        calendar.appendChild(dateDiv);
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Load data pertama kali halaman dimuat
        window.onload = loadData;
    </script>
</head>
<body>
    <div id="app">
        <select id="monthSelect" onchange="loadData()">
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>

        <div id="calendar" class="calendar"></div>
    </div>
</body>
</html>
