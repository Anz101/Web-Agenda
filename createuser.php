<?php
session_start();

include 'script.php';

if(isset($_SESSION['admin'])) {
    if(time() - $_SESSION['admin_login_time'] > 1800) { 
        logout(); 
        exit;
    } else {
        $_SESSION['admin_login_time'] = time();
    }
} else {
    header("Location: loginadmin.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    if(simpanuserBaru($username, $password)) {
        $success_message = "Akun user berhasil dibuat.";
    } else {
        $error_message = "Gagal membuat akun user.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun User Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Buat Akun User Baru</h1>
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
        
        <a href="indexadmin.php">Back</a>
    </div>
</body>
</html>
