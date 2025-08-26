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
  <h2 style="margin-top:0;">Tambah — Menu Makanan</h2>
  <form method="post">
    <div class="grid">

      <div>
        <label>Hari</label>
        <select name="hari" class="input" required>
          <?php include_once(__DIR__ . '/_hari.php'); options_hari(isset($data['hari'])?$data['hari']:''); ?>
        </select>
      </div>
      <div>
        <label>Makan Pagi</label>
        <input type="text" name="makan_pagi" class="input" value="<?php echo htmlspecialchars($data['makan_pagi'] ?? ''); ?>" required>
      </div>
      <div>
        <label>Makan Siang</label>
        <input type="text" name="makan_siang" class="input" value="<?php echo htmlspecialchars($data['makan_siang'] ?? ''); ?>" required>
      </div>
      <div>
        <label>Makan Malam</label>
        <input type="text" name="makan_malam" class="input" value="<?php echo htmlspecialchars($data['makan_malam'] ?? ''); ?>" required>
      </div>
      <div>
        <label>Ekstra</label>
        <input type="text" name="ekstra" class="input" value="<?php echo htmlspecialchars($data['ekstra'] ?? ''); ?>">
      </div>
    
    </div>
    <br>
    <button class="btn" type="submit">Simpan</button>
    <a class="btn secondary" href="menu.php">Batal</a>
  </form>
  <?php
    if ($_SERVER['REQUEST_METHOD']==='POST') {
      $hari = $_POST['hari']; $pagi=$_POST['makan_pagi']; $siang=$_POST['makan_siang']; $malam=$_POST['makan_malam']; $ekstra=$_POST['ekstra'];
      $stmt = $conn->prepare("INSERT INTO menu_makanan (hari,makan_pagi,makan_siang,makan_malam,ekstra) VALUES (?,?,?,?,?)");
      $stmt->bind_param('sssss',$hari,$pagi,$siang,$malam,$ekstra);
      if ($stmt->execute()) echo "<p class='badge success'>Tersimpan!</p>";
      echo "<script>location.href='menu.php';</script>";
    }
  ?>
</div>

  </div>
  <div class="footer">© 2025 Ponpes — PHP Native CRUD</div>
</body>
</html>
