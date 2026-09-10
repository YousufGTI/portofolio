<?php
require 'cek_session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profil Pengguna</title>
</head>
<body>
    <h2>Profil Pengguna</h2>
    <ul>
        <li><strong>Username:</strong> <?php echo $_SESSION['username']; ?></li>
        <li><strong>Role:</strong> <?php echo $_SESSION['role']; ?></li>
    </ul>
    
    <a href="dashboard.php">Kembali ke Dashboard</a> | 
    <a href="logout.php">Logout</a>
</body>
</html>