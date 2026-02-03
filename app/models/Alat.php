<?php
require_once __DIR__ . '/../config/database.php';

class Alat
{
    public static function all(): array
    {
        global $pdo;
        $stmt = $pdo->query('SELECT alat.*, kategori.nama AS kategori_nama FROM alat JOIN kategori ON alat.kategori_id = kategori.id');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id): ?array
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM alat WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $alat = $stmt->fetch(PDO::FETCH_ASSOC);
        return $alat ?: null;
    }

    public static function create(array $data): bool
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO alat (kategori_id, nama, kode, stok, kondisi, deskripsi) VALUES (:kategori_id, :nama, :kode, :stok, :kondisi, :deskripsi)');
        return $stmt->execute($data);
    }

    public static function update(int $id, array $data): bool
    {
        global $pdo;
        $data['id'] = $id;
        $stmt = $pdo->prepare('UPDATE alat SET kategori_id = :kategori_id, nama = :nama, kode = :kode, stok = :stok, kondisi = :kondisi, deskripsi = :deskripsi WHERE id = :id');
        return $stmt->execute($data);
    }

    public static function delete(int $id): bool
    {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM alat WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
