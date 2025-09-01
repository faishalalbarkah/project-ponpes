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
        <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] == 'deleted'): ?>
                <div style="padding:10px; background:#d4edda; color:#155724; border:1px solid #c3e6cb; border-radius:5px; margin-bottom:15px;">
                    ✅ User berhasil dihapus.
                </div>
            <?php elseif ($_GET['status'] == 'success_edit'): ?>
                <div style="padding:10px; background:#d1ecf1; color:#0c5460; border:1px solid #bee5eb; border-radius:5px; margin-bottom:15px;">
                    ✏️ User berhasil diedit.
                </div>
            <?php elseif ($_GET['status'] == 'success_add'): ?>
                <div style="padding:10px; background:#fff3cd; color:#856404; border:1px solid #ffeeba; border-radius:5px; margin-bottom:15px;">
                    ➕ User berhasil ditambahkan.
                </div>
            <?php elseif ($_GET['status'] == 'error'): ?>
                <div style="padding:10px; background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; border-radius:5px; margin-bottom:15px;">
                    ❌ Terjadi kesalahan.
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="card">
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <h2 style="margin:0;">Users Admin</h2>
                <a class="btn" href="users_tambah.php">Tambah</a>
            </div>
            <table>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $res = $conn->query("SELECT * FROM users ORDER BY id DESC");
                while ($row = $res->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . nl2br(htmlspecialchars($row['username'])) . '</td>';
                    echo '<td>' . nl2br(htmlspecialchars($row['email'])) . '</td>';
                    echo '<td>' . ($row['status'] == 1 ? 'Active' : 'Tidak Aktif') . '</td>';
                    echo '<td class="actions">';
                    echo '<a class="btn secondary" href="users_edit.php?id=' . $row['id'] . '">Edit</a> ';
                    echo '<a class="btn danger" href="users_delete.php?id=' . $row['id'] . '" onclick="return confirm(\'Hapus data ini?\')">Hapus</a>';
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