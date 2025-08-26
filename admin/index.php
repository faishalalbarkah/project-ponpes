<?php require_once(__DIR__ . '/../config/db.php'); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ponpes — Menu & Gizi</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <div class="header">
    <div class="container">
      <h1>Ponpes — Menu Makanan Mingguan</h1>
      <div class="nav">
        <a class="btn secondary" href="../client/index.php">Halaman Client</a>
        <a class="btn secondary" href="./index.php">Dashboard Admin</a>
      </div>
    </div>
  </div>
  <div class="container">

<div class="card">
  <h2 style="margin-top:0;">Dashboard Admin</h2>
  <div class="grid">
    <a class="btn" href="menu.php">Kelola Menu Makanan</a>
    <a class="btn" href="gizi.php">Kelola Analisa Gizi</a>
    <a class="btn" href="link.php">Kelola Link Sosmed</a>
  </div>
 
</div>

  </div>
  <div class="footer">© 2025 Ponpes</div>
</body>
</html>
