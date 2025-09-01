<?php
require_once("../config/db.php");

if (!isset($conn)) {
  die("Koneksi database gagal.");
}

if (isset($_GET['id'])) {
  $id = (int) $_GET['id']; // amankan biar integer
  $conn->query("DELETE FROM users WHERE id=$id");

  // redirect ke users.php dengan status sukses hapus
  header("Location: users.php?status=deleted");
  exit;
} else {
  header("Location: users.php?status=error");
  exit;
}
