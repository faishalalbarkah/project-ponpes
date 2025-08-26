<?php
// Ubah kredensial ini sesuai database Anda.
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'ponpes_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
mysqli_set_charset($conn, 'utf8mb4');
?>
