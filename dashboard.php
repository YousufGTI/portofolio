<?php
require 'cek_session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Selamat datang, <?php echo $_SESSION['username']; ?>!</h1>
    <p>Role kamu: <?php echo $_SESSION['role']; ?></p>
    <a href="profil.php">Lihat Profil</a> | 
    <a href="dashboard_project.php">Project</a>
     <a href="logout.php">Logout</a>
</body>
</html>