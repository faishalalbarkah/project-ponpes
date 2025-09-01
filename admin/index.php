<?php require_once(__DIR__ . '/../config/db.php'); ?>
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
  <title>Ponpes — Menu & Gizi</title>
    <style>
    /* body { font-family: Arial, sans-serif; background: #f4f4f4; } */
    /* .container { max-width: 400px; margin: 80px auto; padding: 20px; background: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); } */
    h2 { text-align: center; }
    input[type=text], input[type=password] {
      width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px;
    }
    button {
      width: 100%; padding: 10px; background: #28a745; color: #fff; border: none; border-radius: 4px;
      cursor: pointer;
    }
    button:hover { background: #218838; }
    .alert {
      padding: 10px; border-radius: 4px; margin-bottom: 15px;
    }
    .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
  </style>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <div class="header">
    <div class="container">

      
      <h1>Ponpes — Menu Makanan Mingguan</h1>
      <div class="nav">
        <a class="btn secondary" href="../client/index.php">Halaman Client</a>
        <a class="btn secondary" href="./index.php">Dashboard Admin</a>
        <a class="btn secondary" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
  <div class="container">

    <div class="card">
      <?php if (isset($_GET['success'])): ?>
        <div class="alert success">✅ <?= htmlspecialchars($_GET['success']) ?></div>
      <?php endif; ?>
      <h2 style="margin-top:0;">Dashboard Admin</h2>
      <div class="grid">
        <a class="btn" href="menu.php">Kelola Menu Makanan</a>
        <a class="btn" href="gizi.php">Kelola Analisa Gizi</a>
        <a class="btn" href="link.php">Kelola Link Sosmed</a>
        <a class="btn" href="users.php">Kelola Users</a>
      </div>

    </div>

  </div>
  <div class="footer">© 2025 Ponpes</div>
</body>

</html>