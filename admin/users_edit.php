<?php
require_once __DIR__ . "/../config/db.php";

if (!isset($conn)) {
  die("Koneksi database tidak ditemukan, cek file db.php");
}

if (!isset($_GET['id'])) {
  die("ID user tidak ditemukan.");
}

$id = (int) $_GET['id'];
$user = $conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();

if (!$user) {
  die("User tidak ditemukan.");
}

if (isset($_POST['update'])) {
  $username = $_POST['username'];
  $email    = $_POST['email'];
  $status   = $_POST['status'];

  if (!empty($_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $conn->query("UPDATE users 
                    SET username='$username', email='$email', 
                        password='$password', status='$status' 
                  WHERE id=$id");
  } else {
    $conn->query("UPDATE users 
                    SET username='$username', email='$email', 
                        status='$status' 
                  WHERE id=$id");
  }

  // redirect dengan query string
  header("Location: users.php?status=success_edit");
  exit;
}
?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php?error=Silakan login dulu");
  exit;
}
?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ponpes — Edit User</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <div class="header">
    <div class="container">
      <h1>Ponpes — Edit User</h1>
      <div class="nav">
        <a class="btn secondary" href="../client/index.php">Halaman Client</a>
        <a class="btn secondary" href="./index.php">Dashboard Admin</a>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="card">
      <h2 style="margin-top:0;">Edit Users</h2>
      <form method="post">
        <div class="grid">
          <div>
            <label>Username</label>
            <input type="text" name="username" class="input" value="<?= htmlspecialchars($user['username']) ?>" required>
          </div>
          <div>
            <label>Email</label>
            <input type="email" name="email" class="input" value="<?= htmlspecialchars($user['email']) ?>" required>
          </div>
          <div>
            <label>Password (kosongkan jika tidak ganti)</label>
            <input type="password" name="password" class="input">
          </div>
          <div>
            <label>Status</label>
            <select name="status" class="input">
              <option value="1" <?= $user['status'] == 1 ? "selected" : "" ?>>Aktif</option>
              <option value="0" <?= $user['status'] == 0 ? "selected" : "" ?>>Nonaktif</option>
            </select>
          </div>
        </div>
        <br>
        <button class="btn" type="submit" name="update">Simpan</button>
        <a class="btn secondary" href="users.php">Batal</a>
      </form>
    </div>
  </div>

  <div class="footer">© 2025 Ponpes </div>
</body>

</html>
