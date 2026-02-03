<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/auth.php';

class AuthController
{
    public static function login(string $username, string $password): bool
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT id, nama, username, password_hash, role, status FROM users WHERE username = :username LIMIT 1');
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || $user['status'] !== 'aktif') {
            return false;
        }

        if (!password_verify($password, $user['password_hash'])) {
            return false;
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'nama' => $user['nama'],
            'username' => $user['username'],
            'role' => $user['role']
        ];

        return true;
    }

    public static function logout(): void
    {
        session_destroy();
        header('Location: /login.php');
        exit;
    }
}
