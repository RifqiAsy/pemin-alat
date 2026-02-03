<?php
require_once __DIR__ . '/../app/config/auth.php';

if (is_logged_in()) {
    $role = $_SESSION['user']['role'];
    header("Location: /dashboard-{$role}.php");
    exit;
}

header('Location: /login.php');
exit;
