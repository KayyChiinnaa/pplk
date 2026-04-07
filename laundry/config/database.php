<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // Default XAMPP
$db   = 'laundry';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Set agar error ditampilkan saat pengembangan
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Fetch mode ke associative array (opsional tapi memudahkan)
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
