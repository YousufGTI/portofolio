<?php
// Konfigurasi database
$host = 'localhost';
$db = 'portofolio';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
 PDO::ATTR_EMULATE_PREPARES => false,
];
try {
 $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
 // Jangan tampilkan detail error asli ke pengunjung
 error_log($e->getMessage());
 die('Koneksi database gagal. Silakan coba lagi nanti.');}