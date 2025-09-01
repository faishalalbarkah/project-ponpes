<?php
require_once("../config/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $status   = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO users (username, email, password, status) VALUES (?,?,?,?)");
    $stmt->bind_param("sssi", $username, $email, $password, $status);
    if ($stmt->execute()) {
        header("Location: users.php?status=success_add");
    } else {
        echo "<p class='badge error'>Gagal menambah user!</p>";
    }
    $stmt->close();
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
    <title>Ponpes — Tambah User</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="header">
        <div class="container">
            <h1>Ponpes — Tambah User</h1>
            <div class="nav">
                <a class="btn secondary" href="../client/index.php">Halaman Client</a>
                <a class="btn secondary" href="./index.php">Dashboard Admin</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <h2 style="margin-top:0;">Tambah — User Baru</h2>
            <form method="post">
                <div class="grid">
                    <div>
                        <label>Username</label>
                        <input type="text" name="username" class="input" required>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" class="input" required>
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="password" class="input" required>
                    </div>
                    <div>
                        <label>Status</label>
                        <select name="status" class="input">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>
                <br>
                <button class="btn" type="submit">Simpan</button>
                <a class="btn secondary" href="users.php">Batal</a>
            </form>
        </div>
    </div>

    <div class="footer">© 2025 Ponpes </div>
</body>

</html>