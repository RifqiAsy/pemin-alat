<?php
require_once __DIR__ . '/../app/config/auth.php';
require_role(['peminjam']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Peminjam</title>
</head>
<body>
    <h1>Dashboard Peminjam</h1>
    <p>Lihat alat tersedia dan ajukan peminjaman.</p>
    <a href="/logout.php">Logout</a>
</body>
</html>
