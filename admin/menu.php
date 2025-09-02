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

    <div class="card">
      <div style="display:flex;justify-content:space-between;align-items:center;">
        <h2 style="margin:0;">Menu Makanan Mingguan</h2>
        <a class="btn" href="menu_tambah.php">Tambah</a>
      </div>
      <table>
        <tr>
          <th>Hari</th>
          <th>Makan Pagi</th>
          <th>Makan Siang</th>
          <th>Makan Malam</th>
          <th>Ekstra</th>
          <th>Aksi</th>
        </tr>
        <?php
        $res = $conn->query("SELECT * FROM menu_makanan ORDER BY FIELD(hari,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')");
        while ($row = $res->fetch_assoc()) {
          echo '<tr>';
          echo '<td>' . nl2br(htmlspecialchars($row['hari'])) . '</td>';
          echo '<td>' . nl2br(htmlspecialchars($row['makan_pagi'])) . '</td>';
          echo '<td>' . nl2br(htmlspecialchars($row['makan_siang'])) . '</td>';
          echo '<td>' . nl2br(htmlspecialchars($row['makan_malam'])) . '</td>';
          echo '<td>' . nl2br(htmlspecialchars($row['ekstra'])) . '</td>';
          echo '<td class="actions">';
          echo '<a class="btn secondary" href="menu_edit.php?id=' . $row['id'] . '">Edit</a> ';
          echo '<a class="btn danger" href="menu_hapus.php?id=' . $row['id'] . '" onclick="return confirm(\'Hapus data ini?\')">Hapus</a>';
          echo '</td>';
          echo '</tr>';
        }
        ?>
      </table>
    </div>

  </div>
  <div class="footer">© 2025 Ponpes </div>
</body>

</html>