<?php
require_once __DIR__ . '/../app/config/auth.php';
require_role(['petugas']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Petugas</title>
</head>
<body>
    <h1>Dashboard Petugas</h1>
    <p>Setujui atau tolak peminjaman dan pantau pengembalian.</p>
    <a href="/logout.php">Logout</a>
</body>
</html>
