<?php
require_once __DIR__ . '/../../app/controllers/AlatController.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'kategori_id' => (int)($_POST['kategori_id'] ?? 0),
        'nama' => trim($_POST['nama'] ?? ''),
        'kode' => trim($_POST['kode'] ?? ''),
        'stok' => (int)($_POST['stok'] ?? 0),
        'kondisi' => $_POST['kondisi'] ?? 'baik',
        'deskripsi' => trim($_POST['deskripsi'] ?? ''),
    ];

    if (AlatController::store($data)) {
        $message = 'Alat berhasil ditambahkan.';
    } else {
        $message = 'Gagal menambahkan alat.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Alat</title>
</head>
<body>
    <h1>Tambah Alat (Admin)</h1>
    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Kategori ID</label><br>
        <input type="number" name="kategori_id" required><br><br>
        <label>Nama Alat</label><br>
        <input type="text" name="nama" required><br><br>
        <label>Kode</label><br>
        <input type="text" name="kode" required><br><br>
        <label>Stok</label><br>
        <input type="number" name="stok" required><br><br>
        <label>Kondisi</label><br>
        <select name="kondisi">
            <option value="baik">Baik</option>
            <option value="rusak">Rusak</option>
            <option value="perbaikan">Perbaikan</option>
        </select><br><br>
        <label>Deskripsi</label><br>
        <textarea name="deskripsi"></textarea><br><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
