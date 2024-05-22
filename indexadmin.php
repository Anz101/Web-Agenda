<?php
session_start();

include 'script.php';

if(isset($_SESSION['admin'])) {
    if(time() - $_SESSION['admin_login_time'] > 1800) { 
        logout(); 
    } else {
        $_SESSION['admin_login_time'] = time();
    }
} else {
    header("Location: loginadmin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    logout();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Organisasi XXX (Admin)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Agenda Organisasi XXX (Admin)</h1>
    
    <div id="app">
        <div style="position: absolute; top: 10px; right: 10px;">
            <?php echo $_SESSION['admin']; ?>
            <form method="post" style="display:inline;">
                <button type="submit" name="logout">Logout</button>
            </form>
        </div>
        
        <a href="create.php" style="float: right; margin-right: 10px;">Create</a>
        <a href="createuser.php" style="float: right; margin-right: 10px;">Create User</a>
        
        <form method="post">
            <label for="monthSelect">Select Month:</label>
            <select name="monthSelect" id="monthSelect">
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
            <input type="submit" value="Load Data">
        </form>

        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['logout'])) {
            $selectedMonth = $_POST["monthSelect"];
            $result = ambilDataJadwal($selectedMonth);

            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Judul Agenda</th><th>Tanggal</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $judul = $row["judul"];

                    echo "<tr>";
                    echo "<td><a href='isiadmin.php?id=$id'>$judul</a></td>"; 
                    echo "<td>" . $row["tanggal"] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "Tidak ada data ditemukan.";
            }
        }
        $koneksi->close();
        ?>
    </div>
</body>
</html>
