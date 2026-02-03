<?php
require_once __DIR__ . '/../config/auth.php';

function allow_roles(array $roles): void
{
    require_role($roles);
}
