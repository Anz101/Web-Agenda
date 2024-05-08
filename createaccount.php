<?php
session_start();

include 'script.php';

if(isset($_SESSION['admin'])) {
    header("Location: indexadmin.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Memanggil fungsi simpanPasswordBaru() untuk menyimpan akun admin baru
    if(simpanakunBaru($username, $password)) {
        $success_message = "Akun admin berhasil dibuat. Silakan login.";
    } else {
        $error_message = "Gagal membuat akun admin.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun Admin Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Buat Akun Admin Baru</h1>
    <div id="app">
        <?php if(isset($error_message)) echo "<p>$error_message</p>"; ?>
        <?php if(isset($success_message)) echo "<p>$success_message</p>"; ?>
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br><br>
            <input type="submit" value="Buat Akun">
        </form>
    </div>
</body>
</html>
