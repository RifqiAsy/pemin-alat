<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function is_logged_in(): bool
{
    return isset($_SESSION['user']);
}

function current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function require_login(): void
{
    if (!is_logged_in()) {
        header('Location: /login.php');
        exit;
    }
}

function require_role(array $roles): void
{
    require_login();

    $user = current_user();
    if (!in_array($user['role'], $roles, true)) {
        header('Location: /forbidden.php');
        exit;
    }
}
