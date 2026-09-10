<?php
session_start();

// Jika sudah login, langsung lempar ke dashboard
if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) {
    header('Location: dashboard.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Contoh verifikasi sederhana sesuai modul
    if ($username === 'admin' && $password === '12345') {
        $_SESSION['is_login'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'admin';

        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
</head>
<body>
    <h2>Form Login</h2>

    <?php 
    // Pesan jika pengguna terlempar karena belum login
    if (isset($_GET['pesan']) && $_GET['pesan'] === 'belum_login') {
        echo '<p style="color: orange;"><b>Silakan login terlebih dahulu.</b></p>';
    }

    // Pesan error jika salah password/username
    if (!empty($error)) {
        echo '<p style="color: red;">' . $error . '</p>';
    }
    ?>

    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>
</body>
</html>