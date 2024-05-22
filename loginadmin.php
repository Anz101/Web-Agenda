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

    // Mengecek ke database
    $sql = "SELECT * FROM admins WHERE username='$username'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Memverifikasi password
        if(hash('sha256', $password) === $row['password']) {
            $_SESSION['admin'] = $username;
            header("Location: indexadmin.php");
            exit;
        } else {
            $error = "Username atau password salah.";
        }
    } else {
        $error = "Username atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Login Admin</h1>
    <div id="app">
        <?php if(isset($error)) echo "<p>$error</p>"; ?>
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
