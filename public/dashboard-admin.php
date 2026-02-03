<?php
require_once __DIR__ . '/../app/config/auth.php';
require_role(['admin']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Dashboard Admin</h1>
    <p>Kelola user, alat, kategori, peminjaman, pengembalian, dan log aktivitas.</p>
    <a href="/logout.php">Logout</a>
</body>
</html>
