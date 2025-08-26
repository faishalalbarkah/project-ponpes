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
              <?php include_once(__DIR__ . '/_hari.php');
              options_hari(isset($data['hari']) ? $data['hari'] : ''); ?>
            </select>
          </div>
          <div>
            <label>Makan Pagi</label>
            <textarea name="makan_pagi" class="input" required><?php echo htmlspecialchars($data['makan_pagi'] ?? ''); ?></textarea>
          </div>

          <div>
            <label>Makan Siang</label>
            <textarea name="makan_siang" class="input" required><?php echo htmlspecialchars($data['makan_siang'] ?? ''); ?></textarea>
          </div>

          <div>
            <label>Makan Malam</label>
            <textarea name="makan_malam" class="input" required><?php echo htmlspecialchars($data['makan_malam'] ?? ''); ?></textarea>
          </div>

          <div>
            <label>Ekstra</label>
            <textarea name="ekstra" class="input"><?php echo htmlspecialchars($data['ekstra'] ?? ''); ?></textarea>
          </div>


        </div>
        <br>
        <button class="btn" type="submit">Simpan</button>
        <a class="btn secondary" href="menu.php">Batal</a>
      </form>
      <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $hari  = $_POST['hari'];
        $pagi  = $_POST['makan_pagi'];
        $siang = $_POST['makan_siang'];
        $malam = $_POST['makan_malam'];
        $ekstra = $_POST['ekstra'];

        // Cek apakah hari sudah ada
        $check = $conn->prepare("SELECT COUNT(*) FROM menu_makanan WHERE hari = ?");
        $check->bind_param("s", $hari);
        $check->execute();
        $check->bind_result($count);
        $check->fetch();
        $check->close();

        if ($count > 0) {
          echo "<p class='badge error'>Hari <b>$hari</b> sudah ada, silakan pilih hari lain!</p>";
        } else {
          $stmt = $conn->prepare("INSERT INTO menu_makanan (hari, makan_pagi, makan_siang, makan_malam, ekstra) VALUES (?,?,?,?,?)");
          $stmt->bind_param("sssss", $hari, $pagi, $siang, $malam, $ekstra);
          if ($stmt->execute()) {
            echo "<p class='badge success'>Tersimpan!</p>";
            echo "<script>location.href='menu.php';</script>";
          } else {
            echo "<p class='badge error'>Gagal menyimpan data!</p>";
          }
          $stmt->close();
        }
      }
      ?>

    </div>

  </div>
  <div class="footer">© 2025 Ponpes </div>
</body>

</html>