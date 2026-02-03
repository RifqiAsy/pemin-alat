<?php
require_once __DIR__ . '/../app/config/auth.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Akses Ditolak</title>
</head>
<body>
    <h1>403 - Akses Ditolak</h1>
    <p>Anda tidak memiliki hak akses ke halaman ini.</p>
    <?php if (is_logged_in()): ?>
        <a href="/dashboard-<?php echo htmlspecialchars($_SESSION['user']['role']); ?>.php">Kembali ke dashboard</a>
    <?php else: ?>
        <a href="/login.php">Login</a>
    <?php endif; ?>
</body>
</html>
