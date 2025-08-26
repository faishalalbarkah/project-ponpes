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
  <h2 style="margin-top:0;">Tambah — Link Sosial Media</h2>
  <form method="post" enctype="multipart/form-data">
    <div class="grid">
      <div><label>Nama</label><input class="input" name="nama" required></div>
      <div><label>URL</label><input class="input" name="url" required></div>
      <div><label>Logo (PNG/JPG, maks 1MB)</label><input class="input" type="file" name="logo"></div>
      <div><label>Status</label>
        <select class="input" name="status"><option value="1">Aktif</option><option value="0">Nonaktif</option></select>
      </div>
    </div><br>
    <button class="btn" type="submit">Simpan</button>
    <a class="btn secondary" href="link.php">Batal</a>
  </form>
  <?php
    if ($_SERVER['REQUEST_METHOD']==='POST') {
      $nama=$_POST['nama']; $url=$_POST['url']; $status=intval($_POST['status']);
      $logoName='';
      if (!empty($_FILES['logo']['name'])) {
        $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $allowed = ['png','jpg','jpeg','gif','webp'];
        if (in_array(strtolower($ext), $allowed) && $_FILES['logo']['size'] <= 1024*1024) {
          $logoName = time().'_'.preg_replace('/[^a-zA-Z0-9_.-]/','',$_FILES['logo']['name']);
          move_uploaded_file($_FILES['logo']['tmp_name'], __DIR__.'/../assets/images/uploads/'.$logoName);
        }
      }
      $stmt = $conn->prepare("INSERT INTO link_sosmed (nama, logo, url, status) VALUES (?,?,?,?)");
      $stmt->bind_param('sssi',$nama,$logoName,$url,$status);
      if ($stmt->execute()) echo "<p class='badge success'>Tersimpan!</p>";
      echo "<script>location.href='link.php';</script>";
    }
  ?>
</div>

  </div>
  <div class="footer">© 2025 Ponpes — PHP Native CRUD</div>
</body>
</html>
