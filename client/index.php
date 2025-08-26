<?php require_once(__DIR__ . '/../config/db.php'); ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Menu Makanan Pondok Pesantren</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <header class="header">
    <div class="container">
      <h1>Menu Makanan Pondok Pesantren</h1>
    </div>
  </header>

  <main class="container">
    <!-- Menu Mingguan -->
    <section class="card">
      <h2>Menu Mingguan</h2>
      <div class="table-responsive">
        <table class="styled-table">
          <thead>
            <tr>
              <th>Hari</th>
              <th>Makan Pagi</th>
              <th>Makan Siang</th>
              <th>Makan Malam</th>
              <th>Ekstra</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $res = $conn->query("SELECT * FROM menu_makanan ORDER BY FIELD(hari,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')");
              while ($row = $res->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.htmlspecialchars($row['hari']).'</td>';
                echo '<td>'.nl2br(htmlspecialchars($row['makan_pagi'])).'</td>';
                echo '<td>'.nl2br(htmlspecialchars($row['makan_siang'])).'</td>';
                echo '<td>'.nl2br(htmlspecialchars($row['makan_malam'])).'</td>';
                echo '<td>'.nl2br(htmlspecialchars($row['ekstra'])).'</td>';
                echo '</tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Analisa Gizi -->
    <section class="card">
      <h2>Analisa Kandungan Gizi</h2>
      <div class="table-responsive">
        <table class="styled-table">
          <thead>
            <tr>
              <th>Hari</th>
              <th>Makan Pagi</th>
              <th>Makan Siang</th>
              <th>Makan Malam</th>
              <th>Ekstra</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $res = $conn->query("SELECT * FROM kandungan_gizi ORDER BY FIELD(hari,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')");
              while ($row = $res->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.htmlspecialchars($row['hari']).'</td>';
                echo '<td>'.nl2br(htmlspecialchars($row['makan_pagi'])).'</td>';
                echo '<td>'.nl2br(htmlspecialchars($row['makan_siang'])).'</td>';
                echo '<td>'.nl2br(htmlspecialchars($row['makan_malam'])).'</td>';
                echo '<td>'.nl2br(htmlspecialchars($row['ekstra'])).'</td>';
                echo '</tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Sosial Media -->
    <section class="card">
      <h3>Ikuti Kami</h3>
      <div class="social-grid">
        <?php
          $links = $conn->query("SELECT * FROM link_sosmed WHERE status=1 ORDER BY id DESC");
          while ($l = $links->fetch_assoc()) {
            $logo = !empty($l['logo']) ? '../assets/images/uploads/'.basename($l['logo']) : '';
            echo '<a class="social-link" href="'.htmlspecialchars($l['url']).'" target="_blank">';
            if ($logo && file_exists(__DIR__.'/../assets/images/uploads/'.basename($l['logo']))) {
              echo '<img src="'.$logo.'" alt="logo">';
            }
            echo '<span>'.htmlspecialchars($l['nama']).'</span></a>';
          }
        ?>
      </div>
    </section>
  </main>

  <footer class="footer">© 2025 Ponpes — Halaman Client</footer>
</body>
</html>
