<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; }
    .container { max-width: 400px; margin: 80px auto; padding: 20px; background: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
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
</head>
<body>
  <div class="container">
    <h2>Login</h2>

    <?php if (isset($_GET['error'])): ?>
      <div class="alert error">❌ <?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['success'])): ?>
      <div class="alert success">✅ <?= htmlspecialchars($_GET['success']) ?></div>
    <?php endif; ?>

    <form action="login_action.php" method="post">
      <label>Username</label>
      <input type="text" name="username" required>

      <label>Password</label>
      <input type="password" name="password" required>

      <button type="submit" name="login">Login</button>
    </form>
  </div>
</body>
</html>
