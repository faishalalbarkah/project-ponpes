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

<?php $id=intval($_GET['id']??0); $data=$conn->query("SELECT * FROM link_sosmed WHERE id=$id")->fetch_assoc(); ?>
<div class="card">
  <h2 style="margin-top:0;">Edit — Link Sosial Media</h2>
  <form method="post" enctype="multipart/form-data">
    <div class="grid">
      <div><label>Nama</label><input class="input" name="nama" value="<?php echo htmlspecialchars($data['nama']??''); ?>" required></div>
      <div><label>URL</label><input class="input" name="url" value="<?php echo htmlspecialchars($data['url']??''); ?>" required></div>
      <div><label>Logo (biarkan kosong jika tidak ganti)</label><input class="input" type="file" name="logo"></div>
      <div><label>Status</label>
        <select class="input" name="status">
          <option value="1" <?php echo (($data['status']??0)==1)?'selected':''; ?>>Aktif</option>
          <option value="0" <?php echo (($data['status']??0)==0)?'selected':''; ?>>Nonaktif</option>
        </select>
      </div>
    </div><br>
    <button class="btn" type="submit">Update</button>
    <a class="btn secondary" href="link.php">Batal</a>
  </form>
  <?php
    if ($_SERVER['REQUEST_METHOD']==='POST') {
      $nama=$_POST['nama']; $url=$_POST['url']; $status=intval($_POST['status']);
      $logoName = $data['logo'];
      if (!empty($_FILES['logo']['name'])) {
        $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $allowed = ['png','jpg','jpeg','gif','webp'];
        if (in_array(strtolower($ext), $allowed) && $_FILES['logo']['size'] <= 1024*1024) {
          $logoName = time().'_'.preg_replace('/[^a-zA-Z0-9_.-]/','',$_FILES['logo']['name']);
          move_uploaded_file($_FILES['logo']['tmp_name'], __DIR__.'/../assets/images/'.$logoName);
        }
      }
      $stmt = $conn->prepare("UPDATE link_sosmed SET nama=?, logo=?, url=?, status=? WHERE id=?");
      $stmt->bind_param('sssii',$nama,$logoName,$url,$status,$id);
      if ($stmt->execute()) echo "<p class='badge success'>Tersimpan!</p>";
      echo "<script>location.href='link.php';</script>";
    }
  ?>
</div>

  </div>
  <div class="footer">© 2025 Ponpes </div>
</body>
</html>
