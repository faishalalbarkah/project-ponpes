<?php
session_start();
require_once("../config/db.php");

if (!isset($conn)) {
  die("Koneksi database gagal.");
}

if (isset($_POST['login'])) {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  // cek user berdasarkan username
  $stmt = $conn->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // verifikasi password
    if (password_verify($password, $user['password'])) {
      // cek status aktif
      if ($user['status'] == 1) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header("Location: index.php?success=Login berhasil");
        exit;
      } else {
        header("Location: login.php?error=Akun tidak aktif");
        exit;
      }
    } else {
      header("Location: login.php?error=Password salah");
      exit;
    }
  } else {
    header("Location: login.php?error=Username tidak ditemukan");
    exit;
  }
}
