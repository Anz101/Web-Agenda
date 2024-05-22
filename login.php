<?php
session_start();

include 'script.php';

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Inisialisasi percobaan login jika belum ada
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['last_login_attempt'] = time();
    }

    // Memeriksa apakah ada percobaan login terlalu sering
    if ($_SESSION['login_attempts'] >= 5 && time() - $_SESSION['last_login_attempt'] < 300) {
        $error = "Anda telah mencoba login terlalu sering. Silakan coba lagi nanti.";
    } else {
        // Melakukan pencegahan SQL Injection dengan menggunakan parameter terikat
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Mengecek apakah hasil query menghasilkan data
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Memverifikasi password
            if (password_verify($password, $row['password'])) {
                $_SESSION['user'] = $username;
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_login_time'] = time();
                // Reset percobaan login setelah berhasil login
                $_SESSION['login_attempts'] = 0;
                header("Location: index.php");
                exit;
            } else {
                $error = "Username atau password salah.";
                $_SESSION['login_attempts']++;
            }
        } else {
            $error = "Username atau password salah.";
            $_SESSION['login_attempts']++;
        }

        // Memperbarui timestamp percobaan login terakhir
        $_SESSION['last_login_attempt'] = time();

        // Reset percobaan login jika waktu tunggu telah berlalu
        if (time() - $_SESSION['last_login_attempt'] >= 300) {
            $_SESSION['login_attempts'] = 1;
            $_SESSION['last_login_attempt'] = time();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Login User</h1>
    <div id="app">
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <form method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
