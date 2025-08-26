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
  <div style="display:flex;justify-content:space-between;align-items:center;">
    <h2 style="margin:0;">Link Sosial Media</h2>
    <a class="btn" href="link_tambah.php">Tambah</a>
  </div>
  <table>
    <tr>
      <th>Nama</th><th>Logo</th><th>URL</th><th>Status</th><th>Aksi</th>
    </tr>
    <?php
      $res = $conn->query("SELECT * FROM link_sosmed ORDER BY id DESC");
      while ($row = $res->fetch_assoc()) {
        echo '<tr>';
        echo '<td>'.htmlspecialchars($row['nama']).'</td>';
        $logo = htmlspecialchars($row['logo']);
        $path = '../assets/images/uploads/'.basename($logo);
        echo '<td>' . ($logo ? '<img src="'.$path.'" style="width:40px;height:40px;object-fit:contain;">' : '-') . '</td>';
        echo '<td><a href="'.htmlspecialchars($row['url']).'" target="_blank">'.htmlspecialchars($row['url']).'</a></td>';
        echo '<td>'.($row['status'] ? '<span class="badge success">Aktif</span>' : '<span class="badge muted">Nonaktif</span>').'</td>';
        echo '<td class="actions">';
        echo '<a class="btn secondary" href="link_edit.php?id='.$row['id'].'">Edit</a> ';
        echo '<a class="btn danger" href="link_hapus.php?id='.$row['id'].'" onclick="return confirm(\'Hapus data ini?\')">Hapus</a>';
        echo '</td>';
        echo '</tr>';
      }
    ?>
  </table>
</div>

  </div>
  <div class="footer">© 2025 Ponpes — PHP Native CRUD</div>
</body>
</html>
